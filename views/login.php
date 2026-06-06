<section class="home-content home-panel" data-view="login">
    <h2>Login</h2>
    <?php if (($_GET["login"] ?? "") === "error"): ?>
        <p class="erreur">Email ou mot de passe incorrect.</p>
    <?php endif; ?>
    <form method="POST" action="controllers/login_controller.php" class="form">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" required>

        <button type="submit">Se connecter</button>
    </form>
    <p class="panel-link">
        Vous n'avez pas de compte ? <button type="button" data-view-button="register">Inscription</button>
    </p>
</section>
