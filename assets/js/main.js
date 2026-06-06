(() => {
    const model = document.getElementById("carModel");
    const views = document.querySelectorAll("[data-view]");

    if (!model || views.length === 0) {
        return;
    }

    const cameras = {
        hero: {
            orbit: "-19.76rad 1.63rad 20m",
            target: "-3.00m 1.09m 0.43m",
            fov: "6deg",
        },
        reservation: {

            orbit: "-8.89rad 1.2rad 2.52m",
            target: "-2.8m 0.82m 0.15m",
            fov: "13.40rad",
            
        },
        login: {
            orbit: "-7.10rad 1.17rad 8m",
            target: "-2.5m 0.94m 0.06m",
            fov: "15deg",
            
        },
        register: {
            orbit: "-7.10rad 1.17rad 8m",
            target: "-3.0m 0.94m 0.06m",
            fov: "15deg",
        },
        information: {
           orbit: "-19.76rad 1.63rad 20m",
            target: "-3.00m 1.09m 0.43m",
            fov: "6deg",
        },
        legal: {
            orbit: "-19.76rad 1.63rad 20m",
            target: "-3.00m 1.09m 0.43m",
            fov: "6deg",
        },
        privacy: {
            orbit: "-19.76rad 1.63rad 20m",
            target: "-3.00m 1.09m 0.43m",
            fov: "6deg",
        },
        cookies: {
            orbit: "-19.76rad 1.63rad 20m",
            target: "-3.00m 1.09m 0.43m",
            fov: "6deg",
        },
        account: {
            orbit: "-13.45rad 1.53rad 15.25m",
            target: "-11.70m 4.4m -1.00m",
            fov: "13.00rad",
        },
    };

    let activeView = "hero";
    let isTransitioning = false;
    const initialView = new URLSearchParams(window.location.search).get("view");

    const hideView = (view) => {
        if (!view) {
            return;
        }

        view.classList.remove("is-active");
        view.setAttribute("aria-hidden", "true");
        view.inert = true;
    };

    const revealView = (view) => {
        view.classList.add("is-active");
        view.setAttribute("aria-hidden", "false");
        view.inert = false;
    };

    const setCamera = (viewName) => {
        const camera = cameras[viewName];

        if (!camera) {
            return;
        }

        model.setAttribute("camera-orbit", camera.orbit);
        model.setAttribute("camera-target", camera.target);
        model.setAttribute("field-of-view", camera.fov);
    };

    const updateViewUrl = (viewName) => {
        const url = new URL(window.location.href);
        url.searchParams.set("view", viewName);
        window.history.replaceState({ view: viewName }, "", url);
    };

    const tuneMaterial = (material, settings) => {
        const pbr = material.pbrMetallicRoughness;

        if (!pbr) {
            return;
        }

        if (typeof settings.metallic === "number" && pbr.setMetallicFactor) {
            pbr.setMetallicFactor(settings.metallic);
        }

        if (typeof settings.roughness === "number" && pbr.setRoughnessFactor) {
            pbr.setRoughnessFactor(settings.roughness);
        }

        if (settings.color && pbr.setBaseColorFactor) {
            pbr.setBaseColorFactor(settings.color);
        }
    };

    const enhanceMaterials = () => {
        const materials = model.model?.materials || [];

        materials.forEach((material) => {
            const name = material.name.toLowerCase();

            if (
                name.includes("tire")
                || name.includes("tyre")
                || name.includes("rubber")
            ) {
                tuneMaterial(material, { metallic: 0, roughness: 0.82 });
                return;
            }

            if (
                name.includes("glass")
                || name.includes("window")
                || name.includes("windshield")
            ) {
                tuneMaterial(material, { metallic: 0, roughness: 0.02 });
                return;
            }

            if (
                name.includes("leather")
                || name.includes("interior")
                || name.includes("seat")
                || name.includes("fabric")
            ) {
                tuneMaterial(material, { metallic: 0, roughness: 0.48 });
                return;
            }

            if (
                name.includes("chrome")
                || name.includes("metal")
                || name.includes("steel")
                || name.includes("aluminium")
                || name.includes("aluminum")
            ) {
                tuneMaterial(material, { metallic: 1, roughness: 0.045 });
                return;
            }

            if (
                name.includes("rim")
                || name.includes("wheel")
                || name.includes("alloy")
            ) {
                tuneMaterial(material, { metallic: 0.98, roughness: 0.1 });
                return;
            }

            if (
                name.includes("paint")
                || name.includes("body")
                || name.includes("carpaint")
                || name.includes("lacquer")
            ) {
                tuneMaterial(material, {
                    metallic: 3.92,
                    roughness: 0.055,
                    color: [0.018, 0.019, 0.021, 1],
                });
            }
        });
    };

    const showView = (viewName) => {
        if (isTransitioning || viewName === activeView) {
            return;
        }

        const currentView = document.querySelector(`[data-view="${activeView}"]`);
        const nextView = document.querySelector(`[data-view="${viewName}"]`);

        if (!nextView) {
            return;
        }

        isTransitioning = true;
        hideView(currentView);
        setCamera(viewName);

        window.setTimeout(() => {
            revealView(nextView);
            activeView = viewName;
            updateViewUrl(viewName);

            window.setTimeout(() => {
                isTransitioning = false;
            }, 420);
        }, 260);
    };

    const syncAuthenticatedHome = async () => {
        const response = await fetch("index.php?view=account", {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        const html = await response.text();
        const documentFragment = new DOMParser().parseFromString(html, "text/html");
        const nextMenu = documentFragment.querySelector(".top-actions");
        const nextAccount = documentFragment.querySelector('[data-view="account"]');
        const currentMenu = document.querySelector(".top-actions");
        const currentAccount = document.querySelector('[data-view="account"]');

        if (nextMenu && currentMenu) {
            currentMenu.replaceWith(nextMenu);
        }

        if (nextAccount) {
            hideView(nextAccount);

            if (currentAccount) {
                currentAccount.replaceWith(nextAccount);
            } else {
                document.querySelector(".home-stage")?.appendChild(nextAccount);
            }
        }
    };

    const syncGuestHome = async () => {
        const response = await fetch("index.php?view=login", {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        const html = await response.text();
        const documentFragment = new DOMParser().parseFromString(html, "text/html");
        const nextMenu = documentFragment.querySelector(".top-actions");
        const nextLogin = documentFragment.querySelector('[data-view="login"]');
        const currentMenu = document.querySelector(".top-actions");
        const currentLogin = document.querySelector('[data-view="login"]');

        if (nextMenu && currentMenu) {
            currentMenu.replaceWith(nextMenu);
        }

        if (nextLogin && currentLogin) {
            hideView(nextLogin);
            currentLogin.replaceWith(nextLogin);
        }
    };

    const showLoginError = (message) => {
        const loginView = document.querySelector('[data-view="login"]');
        showFormError(loginView, message);
    };

    const showFormError = (view, message) => {
        let error = view?.querySelector(".erreur");

        if (!view) {
            return;
        }

        if (!error) {
            error = document.createElement("p");
            error.className = "erreur";
            view.querySelector("form")?.before(error);
        }

        error.textContent = message;
    };

    const handleLoginSubmit = async (form) => {
        const response = await fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        const result = await response.json();

        if (!result.success) {
            showLoginError(result.message || "Connexion impossible.");
            return;
        }

        await syncAuthenticatedHome();
        showView("account");
    };

    const handleRegisterSubmit = async (form) => {
        const response = await fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        const result = await response.json();

        if (!result.success) {
            showFormError(
                document.querySelector('[data-view="register"]'),
                result.message || "Inscription impossible."
            );
            return;
        }

        await syncAuthenticatedHome();
        showView("account");
    };

    const showSuccessOverlay = (message) => {
        const overlay = document.createElement("div");
        overlay.className = "success-overlay";

        const title = document.createElement("h2");
        title.textContent = message;
        overlay.appendChild(title);

        document.body.appendChild(overlay);

        requestAnimationFrame(() => {
            overlay.classList.add("is-visible");
        });

        window.setTimeout(() => {
            overlay.classList.remove("is-visible");
            window.setTimeout(() => overlay.remove(), 420);
        }, 3000);
    };

    const handleReservationSubmit = async (form) => {
        const response = await fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        const result = await response.json();

        if (!result.success) {
            showSuccessOverlay("Impossible d'envoyer la réservation.");
            return;
        }

        form.reset();
        showSuccessOverlay("Réservation envoyée avec succès");
    };

    document.addEventListener("click", (event) => {
        const accountTab = event.target.closest("[data-account-tab]");

        if (accountTab) {
            const accountSection = accountTab.closest(".account-section");
            const tabName = accountTab.dataset.accountTab;

            accountSection?.querySelectorAll("[data-account-tab]").forEach((tab) => {
                const isActive = tab === accountTab;
                tab.classList.toggle("is-active", isActive);
                tab.setAttribute("aria-selected", String(isActive));
            });

            accountSection?.querySelectorAll("[data-account-panel]").forEach((panel) => {
                panel.classList.toggle("is-active", panel.dataset.accountPanel === tabName);
            });

            return;
        }

        const logoutLink = event.target.closest("[data-ajax-logout]");

        if (logoutLink) {
            event.preventDefault();
            fetch(logoutLink.href, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.json())
                .then(async (result) => {
                    if (!result.success) {
                        window.location.href = logoutLink.href;
                        return;
                    }

                    await syncGuestHome();
                    showView("login");
                })
                .catch(() => {
                    window.location.href = logoutLink.href;
                });
            return;
        }

        const button = event.target.closest("[data-view-button]");

        if (!button) {
            return;
        }

        showView(button.dataset.viewButton);
    });

    document.addEventListener("submit", (event) => {
        const form = event.target;

        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        if (form.getAttribute("action") === "controllers/login_controller.php") {
            event.preventDefault();
            handleLoginSubmit(form).catch(() => {
                showLoginError("Connexion impossible pour le moment.");
            });
        }

        if (form.getAttribute("action") === "controllers/register_controller.php") {
            event.preventDefault();
            handleRegisterSubmit(form).catch(() => {
                showFormError(
                    document.querySelector('[data-view="register"]'),
                    "Inscription impossible pour le moment."
                );
            });
        }

        if (form.getAttribute("action") === "controllers/reservation_controller.php") {
            event.preventDefault();
            handleReservationSubmit(form).catch(() => {
                showSuccessOverlay("Impossible d'envoyer la réservation.");
            });
        }
    });

    model.addEventListener("load", enhanceMaterials, { once: true });
    if (initialView && document.querySelector(`[data-view="${initialView}"]`)) {
        activeView = initialView;
    }

    setCamera(activeView);
    updateViewUrl(activeView);
    model.environmentRotation = "270deg";

    views.forEach((view) => {
        if (view.dataset.view === activeView) {
            revealView(view);
            return;
        }

        hideView(view);
    });
})();
