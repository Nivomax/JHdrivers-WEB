<section class="home-content home-panel" data-view="register">
    <h2>Créer votre compte</h2>
    <?php if (($_GET["register"] ?? "") === "exists"): ?>
        <p class="erreur">Un compte existe déjà avec cet email.</p>
    <?php endif; ?>
    <form method="POST" action="controllers/register_controller.php" class="form">
        <div class="form-row">
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom" required>
            </div>
            <div>
                <label>Nom</label>
                <input type="text" name="nom" required>
            </div>
        </div>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Téléphone</label>
        <input type="text" name="telephone" required>

        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" required>

        <button type="submit">Creer mon compte</button>
    </form>
    <p class="panel-link">
        Vous avez déjà un compte ? <button type="button" data-view-button="login">Connexion</button>
    </p>
</section>
