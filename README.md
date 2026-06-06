# JH Drivers Web

Application web PHP permettant aux clients de réserver une course avec chauffeur privé et de consulter leurs réservations.

Cette application constitue le client web destiné aux clients de JH Drivers.

---

## Fonctionnalités

- Création d'un compte client
- Authentification par email et mot de passe
- Réservation d'une course
- Consultation des informations du compte
- Consultation de l'historique des réservations
- Affichage du chauffeur et du statut de chaque course
- Navigation animée entre les sections sans rechargement complet
- Modèle 3D automobile en arrière-plan avec positions de caméra adaptées
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

## Installation

### Prérequis

- PHP avec l'extension PDO MySQL
- MySQL ou MariaDB
- Apache, Nginx ou le serveur PHP intégré
- Git

---

### Installation automatique sur Debian

Depuis le dossier `web` :

```bash
chmod +x install_web.sh
./install_web.sh
```

Le script installe PHP et MariaDB, crée la base, importe les données de démonstration et génère `config/database.php`.

Les paramètres peuvent être personnalisés :

```bash
DB_NAME="jhdrivers-e6" \
DB_USER="jhdrivers" \
DB_PASS="mot_de_passe" \
APP_PORT="8000" \
./install_web.sh
```

Lancez ensuite le site :

```bash
php -S 0.0.0.0:8000
```

Ouvrez :

```text
http://localhost:8000
```

---

### Installation locale avec XAMPP

1. Placez le dépôt dans le dossier `htdocs` de XAMPP.
2. Démarrez Apache et MySQL.
3. Importez `database/schema.sql` dans la base `jhdrivers-e6`.
4. Vérifiez les identifiants de connexion dans `config/database.php`.
5. Ouvrez l'URL correspondant au nom du dossier placé dans `htdocs`, par exemple `http://localhost/jhdrivers-web/`.

---

## Base de données

Le schéma complet et les données de démonstration sont disponibles dans `database/schema.sql`. Le projet web peut donc être installé indépendamment.

---

### Problèmes fréquents

**Erreur de connexion à la base** : vérifiez que MySQL est démarré et que `config/database.php` contient les bons identifiants.

**Le modèle 3D ne s'affiche pas** : vérifiez que le fichier GLB existe dans `assets/models/` et que le navigateur autorise le chargement du module `<model-viewer>`.

**Les styles ou scripts ne se chargent pas** : ouvrez le projet via Apache ou le serveur PHP plutôt que directement depuis le système de fichiers.
