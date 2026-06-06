<section class="home-content home-panel" data-view="reservation">
    <h2>Réserver une course</h2>

    <form method="POST" action="controllers/reservation_controller.php" class="form">
        <label>Nom complet</label>
        <input
            type="text"
            name="nom_client"
            value="<?php echo h($client ? $client["prenom"] . " " . $client["nom"] : ""); ?>"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email_client"
            value="<?php echo h($client["email"] ?? ""); ?>"
            required
        >

        <label>Telephone</label>
        <input
            type="text"
            name="telephone"
            value="<?php echo h($client["telephone"] ?? ""); ?>"
            required
        >

        <label>Adresse de depart</label>
        <input type="text" name="adresse_depart" required>

        <label>Adresse d'arrivee</label>
        <input type="text" name="adresse_arrivee" required>

        <div class="form-row">
            <div>
                <label>Date</label>
                <input type="date" name="date_course" required>
            </div>
            <div>
                <label>Heure</label>
                <input type="time" name="heure_course" required>
            </div>
        </div>

        <button type="submit">Envoyer</button>
    </form>
</section>
