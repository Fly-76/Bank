# Projet AFPA - S19 : Application de gestion de comptes bancaires - version SYMFONY

## Objectif : 
Evolution de l'application Compte Bancaire - Mise en place du framework Symfony

## Compétences mises en oeuvre : 
- Comprendre le modèle requêtes/réponses
- Démarrer un projet Symfony via la CLI
- Gérer le routing de l’application
- Développer des controllers et associer des routes à des méthodes
- Utiliser le moteur de template twig pour l’affichage des vues
- Gérer sa base de données et ses entités avec l’orm Doctrine
- Créer des formulaires et gérer leur soumission
- Gérer ses utilisateurs et la sécurité de l’application
- Valider ses données
- Afficher des messages flash
- Peupler sa base à l’aide de fixtures
- Tester son application à l’aide des tests unitaires

## Description : 
- Dépot github, Usecase, Kanban
- L’application n’est accessible qu’aux seuls utilisateurs connectés
- Quand un utilisateur non connecté va sur l’application il est redirigé vers une page de connexionavec un formulaire
- Un utilisateur se connecte à l’aide d’une adresse mail et d’un mot de passe
- Un utilisateur connecté peut se déconnecter
- Une fois connecté, l’utilisateur voit uniquement ses comptes en banque personnels.
- Quand l’utilisateur clique sur un compte en banque, il arrive sur une page dédié au compte 
  où il voit les informations du compte mais aussi les dernières opérations effectuées sur le compte
- Via une page dédiée un utilisateur peut créer un nouveau compte personnel à l’aide d’un formulaire. 
  Une fois créé le compte apparaît sur la page d’accueil. 
  Le compte doit respecter les conditions minimum de création de compte (bon type et bon montant)
- L’utilisateur peut effectuer des dépôts ou des retraits sur le compte de son choix.  
  Le montant du compte est alors mis à jour et une nouvelle opération est enregistrée sur le compte.
- peupler la base de données à l’aide de fixtures
- valider les données rentrées dans les formulaires à l’aide du validator
- Ecrire quelques tests unitaires simples pour vérifier le fonctionnement de l’application
- Déployer votre application sur le service cloud Heroku afin d’en avoir une version en ligne
- L’utilisateur peut effectuer des transferts d’un compte à l’autre
- Des messages d’erreur sont éventuellement affichés sur les différents formulaires 
  quand ceux-ci sont mal remplis
- L’utilisateur peut supprimer les comptes qui lui appartiennent
- Sur la page d’accueil, pour chaque compte l’utilisateur voit la dernière opération sur ce compte
- A son arrivée sur l’accueil un layer s’affiche par dessus l’ensemble de la page et lui rappelle les règles de sécurité essentielles sur un site internet. 
  Les règles de sécurité sont stockées dans un fichier et récupérées par requête HTTP (AJAX).
- Sur une page de statistiques l’utilisateur accède à des informations bancaires comme les taux d’emprunt, 
  le cours de la bourse, etc... 
  Ces informations sont récupérées depuis un fichier via requête HTTP et présentées sous forme de tableau. 
  Ces informations sont stockées dans un fichier au format JSON.
- Une page de blog, qui affichera des articles récupérés depuis l’API suivante: 
  https://oc-jswebsrv.herokuapp.com/api/articles
