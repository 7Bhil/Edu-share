# Rapport de TP - Laravel Blog Web (EduShare)

**Étudiant :** {{ Votre Nom }}  
**N° Étudiant :** {{ Votre Numéro }}  
**Groupe / Section :** {{ Votre Groupe }}  

---

## 📌 Présentation du projet

EduShare est une plateforme de blog académique permettant aux utilisateurs de publier des articles classés par catégories, d'interagir via des commentaires et des mentions "J'aime". Le projet met l'accent sur une interface utilisateur premium et une expérience fluide en modes clair et sombre.

## 🛠 Choix techniques

- **Framework :** Laravel 12.53.0
- **Base de données :** SQLite (pour la portabilité et la légèreté).
- **Authentication :** Laravel Breeze (Blade/Tailwind).
- **Design :** Tailwind CSS avec un système de thèmes personnalisé (Light/Dark mode).
- **Typographie :** Syne (Modern), Playfair Display (Academic/Serif), DM Mono (Technical).

## 🏗 Architecture de l'application

### Modèles (Models)
- **User** : Gère les comptes, les rôles (enseignant/étudiant) et les relations.
- **Post** : Gère les articles, leur contenu (Markdown supporté), leur statut (brouillon/publié) et leur auteur.
- **Category** : Organisation des articles par thématiques.
- **Comment** : Système de réponses sous les articles avec possibilité de suppression par l'auteur.
- **Like** : Interaction sociale simple sur les articles.
- **Tag** : Mots-clés pour le référencement des articles.

### Contrôleurs (Controllers)
- **PostController** : CRUD complet des articles et filtrage par statut.
- **UserController** : Affichage des profils publics et navigation entre les auteurs.
- **CommentController** : Gestion de l'ajout et de la suppression sécurisée des commentaires.
- **ProfileController** : Gestion des paramètres personnels (Nom, Email, Mot de passe).

## 🚀 Fonctionnalités implémentées

- [x] **Système d'authentification** complet (Inscription, Connexion).
- [x] **Publication d'articles** avec gestion de catégories.
- [x] **Pagination** (5 articles par page) pour optimiser les performances.
- [x] **Filtrage** automatique pour n'afficher que les articles "publiés".
- [x] **Profils Publics** cliquables pour voir toutes les contributions d'un auteur.
- [x] **Interaction** via Commentaires (Ajout/Suppression) et Likes.
- [x] **Design Adaptatif** automatique (Mode Clair / Mode Sombre).

## 🧩 Difficultés rencontrées & Solutions

1. **Relation User-Posts** : Lors de la création de la page de profil, une erreur `BadMethodCallException` est survenue car la relation `posts()` n'était pas définie dans le modèle `User`. J'ai dû implémenter une relation `hasMany(Post::class)` pour corriger le problème.
2. **Design Adaptatif** : Certaines parties du design premium utilisaient des couleurs "hardcoded" qui ne changeaient pas en mode clair. J'ai refactorisé ces vues en utilisant les classes `dark:` de Tailwind.
3. **Pagination** : L'adaptation de la pagination Laravel par défaut au design personnalisé a nécessité l'ajout de conteneurs spécifiques dans `welcome.blade.php`.

## ✨ Améliorations apportées

- **Interface Premium** : Utilisation de dégradés, de micro-animations (transitions CSS) et de typographies soigneusement choisies pour un rendu professionnel.
- **UX Profils** : Ajout d'une barre de navigation rapide (Sticky Nav) dans les paramètres du profil pour une meilleure ergonomie.
- **Support Markdown léger** : Support du formatage de base pour les articles.

---
**Version PHP :** 8.3.6  
**Système d'exploitation :** Linux
