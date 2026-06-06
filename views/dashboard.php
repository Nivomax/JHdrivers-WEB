<?php if ($client): ?>
    <section class="home-content home-panel account-panel" data-view="account">
        <div class="account-section">
            <div class="account-tabs" role="tablist" aria-label="Mon compte">
                <button type="button" class="is-active" data-account-tab="info" role="tab" aria-selected="true">
                    Mon compte
                </button>
                <button type="button" data-account-tab="courses" role="tab" aria-selected="false">
                    Mes réservations
                </button>
                <a class="account-logout" href="controllers/logout_controller.php" data-ajax-logout>Déconnexion</a>
            </div>

            <div class="account-tab-panel is-active" data-account-panel="info" role="tabpanel">
                <dl>
                    <div>
                        <dt>Prénom</dt>
                        <dd><?php echo h($client["prenom"]); ?></dd>
                    </div>
                    <div>
                        <dt>Nom</dt>
                        <dd><?php echo h($client["nom"]); ?></dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd><?php echo h($client["email"]); ?></dd>
                    </div>
                    <div>
                        <dt>Téléphone</dt>
                        <dd><?php echo h($client["telephone"]); ?></dd>
                    </div>
                </dl>
            </div>

            <div class="account-tab-panel" data-account-panel="courses" role="tabpanel">
                <?php if (!$courses): ?>
                    <p class="empty-state">Aucune course réservée.</p>
                <?php else: ?>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Départ</th>
                                    <th>Arrivée</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course): ?>
                                    <tr>
                                        <td><?php echo h($course["date_course"]); ?></td>
                                        <td><?php echo h(substr($course["heure_course"], 0, 5)); ?></td>
                                        <td><?php echo h($course["adresse_depart"]); ?></td>
                                        <td><?php echo h($course["adresse_arrivee"]); ?></td>
                                        <td>
                                            <span class="status-pill <?php echo h(status_class($course["statut"])); ?>">
                                                <?php echo h($course["statut"]); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
