<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo APP_NAME; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script defer src="assets/js/main.js"></script>
</head>
<body class="home-page">
    <button type="button" class="site-logo" data-view-button="hero" aria-label="Retour a l'accueil">
        <img src="assets/images/logojh.png" alt="JH Drivers">
    </button>

    <nav class="top-actions">
        <button type="button" data-view-button="reservation">Réservation</button>
        <?php if ($client): ?>
            <button type="button" class="icon-nav" data-view-button="account" aria-label="Mon compte" title="Mon compte">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </button>
        <?php else: ?>
            <button type="button" class="icon-nav" data-view-button="login" aria-label="Connexion" title="Connexion">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </button>
        <?php endif; ?>
        <button type="button" class="icon-nav" data-view-button="information" aria-label="Information" title="Information">
            <svg aria-hidden="true" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 11v5"></path>
                <path d="M12 8h.01"></path>
            </svg>
        </button>
    </nav>

    <main class="home-stage">
        <model-viewer
            id="carModel"
            class="background-model"
            src="assets/models/mercedes-benz_maybach_2022.glb"
            alt="Modele 3D d'une voiture"
            min-camera-orbit="auto auto 0.1m"
            max-camera-orbit="auto auto 50m"
            min-field-of-view="1deg"
            max-field-of-view="45deg"
            environment-image="https://modelviewer.dev/shared-assets/environments/spruit_sunrise_1k_HDR.hdr"
            tone-mapping="aces"
            shadow-intensity="0"
            exposure="1"
            interpolation-decay="120"
        ></model-viewer>
