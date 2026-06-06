# JH Drivers Web

Application web PHP permettant aux clients de réserver une course avec chauffeur privé et de consulter leurs réservations.

Cette application constitue le client web destiné aux clients de JH Drivers.

URL : https://jhdrivers.alwaysdata.net/

<img src="./assets/images/homescreen.png">

---

## Fonctionnalités

- Création d'un compte client
- Authentification par email et mot de passe
- Réservation d'une course
- Consultation des informations du compte
- Consultation de l'historique des réservations
- Navigation animée entre les sections
- Modèle 3D automobile en arrière-plan
- Interface responsive pour ordinateur et mobile

---

## Stack technique

| Composant | Technologie |
|-----------|-------------|
| Frontend | HTML / CSS / JavaScript |
| Affichage 3D | Google `<model-viewer>` / GLB |
| Backend | PHP |
| Architecture | MVC (Model / View / Controller) |
| Base de données | MySQL / MariaDB |
| Accès BDD | PDO avec requêtes préparées |
| Serveur | Apache avec XAMPP ou serveur PHP intégré |
| Déploiement cible | VM Debian |
| Versionning | Git / GitHub |

---

## Démo locale

Avec XAMPP, l'application est accessible à l'adresse suivante :

```text
http://localhost/jhdrivers-web/
```

Pour tester l'espace client :

| Champ | Valeur |
|-------|--------|
| Email | alice.martin@example.com |
| Mot de passe | Demo2026* |

---

## Structure du projet

```text
.
├── index.php
├── README.md
├── config/
│   ├── database.php
│   └── config.php
├── models/
│   ├── user.php
│   ├── session.php
│   └── reservation.php
├── controllers/
│   ├── login_controller.php
│   ├── logout_controller.php
│   ├── register_controller.php
│   ├── dashboard_controller.php
│   └── reservation_controller.php
├── views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── home.php
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   ├── reservations.php
│   └── information.php
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   ├── images/
│   │   └── logojh.png
│   └── models/
│       └── mercedes-benz_maybach_2022.glb
├── database/
│   └── schema.sql
└── install_web.sh
```

---

## Base de données

Le schéma complet et les données de démonstration sont disponibles dans `database/schema.sql`. Le projet web peut donc être installé indépendamment.
