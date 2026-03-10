# 🎓 EduShare - Plateforme Blog Académique

EduShare est une application web de blog moderne développée avec Laravel, conçue pour permettre aux étudiants et enseignants de partager des articles, de collaborer via des commentaires et d'organiser du contenu par catégories.

---

## 🚀 Guide d'installation rapide

Suivez ces étapes pour installer et lancer le projet en toute sécurité sur votre machine locale.

### 1. Prérequis
Assurez-vous d'avoir installé les éléments suivants :
- **PHP** (>= 8.2)
- **Composer**, **Node.js & NPM**, **SQLite**

### 2. Récupération du projet
Clonez le dépôt GitHub sur votre machine :
```bash
git clone https://github.com/7Bhil/Edu-share.git
cd Edu-share
```

### 3. Installation des dépendances PHP
Lancer :
```bash
composer install
```

### 3. Installation des dépendances Frontend
```bash
npm install
```

### 4. Configuration de l'environnement
Copiez le fichier d'exemple pour créer votre propre fichier `.env` :
```bash
cp .env.example .env
```
*Note : Par défaut, le projet est configuré pour utiliser SQLite.*

### 5. Génération de la clé d'application
```bash
php artisan key:generate
```

### 6. Préparation de la base de données
Créez le fichier de base de données SQLite (si non présent) :
```bash
touch database/database.sqlite
```
Ensuite, lancez les migrations pour créer les tables :
```bash
php artisan migrate
```

### 7. Lancement du projet
Pour démarrer le serveur de développement :
```bash
php artisan serve
```
Pour compiler les assets en temps réel (nécessaire pour le design premium) :
```bash
npm run dev
```

L'application sera disponible sur [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 🛠️ Commandes utiles

- **Afficher les routes** : `php artisan route:list`
- **Rafraîchir la base de données** : `php artisan migrate:fresh --seed`
- **Nettoyer le cache** : `php artisan optimize:clear`

## 🛡️ Sécurité
- Assurez-vous que le dossier `storage` et `bootstrap/cache` ont les permissions d'écriture.
- Ne partagez jamais votre fichier `.env` en production (il contient vos clés secrètes).
- Le projet utilise les protections natives de Laravel contre les failles XSS, CSRF et injection SQL.

---
*Développé dans le cadre du TP Laravel - Blog Web.*
