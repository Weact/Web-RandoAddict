# Changelog
All notable changes to this project will be documented in this file.

## [0.1.0] - 2022-05-23
### Added
- Affichage de la liste des membres de manière dynamique.

## [0.0.10] - 2022-03-30
### Added
- Ajout de méthodes pour récupérer les Programmes passés ou à venir d'un Marcheur.
- Ajout d'une méthode pour récupérer le matériel nécessaire d'un Programme.

### Changed
- Méthodes selectTableByLabel modifié. Les requêtes incluent désormais un LIKE.

### HOTFIX
- Correction des require_once dans les classes Managers.
- Correction de ManagerProgramme.

## [0.0.9] - 2022-03-29
### Added
- Le mot de passe est hashé.
- Création automatique d'une escale lors de la création d'un programme

### Changed
- Les méthodes des Managers retournent un tableau.

### HOTFIX
- Correction d'erreurs dans les Managers.
- Correction d'une erreur dans les Objets.
- Correction sur les commentaires en HTML.
- Correction du chemin des includes dans les classes Managers.

## [0.0.8] - 2022-03-28
### HOTFIX
- Correction d'une erreur dans la requête d'insertion de la table Photo.
- Correction d'une erreur dans la requête d'insertion de la table Programme.

## [0.0.7] - 2022-03-28
### Added
- Ajout de l'entête pour tous les fichiers Managers.

### Changed
- cheminExcursion modifié en departExcursion & arriveeExcursion dans la classe Objet et le Manager, conformément à la BDD.

## [0.0.6] - 2022-03-28
### Changed
- Retours des méthodes dans les Managers.
- deleTerrainByLabel renommée en deleteTerrainByLabel.

### TO-DO
- Terminer le CRUD dans les tables de liaison.

## [0.0.5] - 2022-03-28
### Added
- Méthodes Update & Delete pour plus de Managers.

### Merge with develop

## [0.0.4] - 2022-03-25
### Added
- Méthodes Update & Delete pour les Managers de Terrain, Type, Programme, Photo.

### Changed
- Retours des méthodes dans les Managers Marcheur & Excursion sous format JSON.

### Project Management
- Revue avec Romain SCHLOTTER pour les principes du CRUD et de de la nomenclature des fichiers.

### TO-DO
- Terminer le CRUD.
- Terminer le changement du retour des méthodes sous format JSON. 

## [0.0.3] - 2022-03-24
### Added
- Création de tous les fichiers des classes Manager.

### TO-DO
- Faire une réunion pour déterminer comment gérer le mot de passe, et certaines tables.

## [0.0.2] - 2022-03-23
### Added
- Le dossier Managers créé à l'intérieur du dossier DBOperation. Il contient tous les managers nécessaire pour la communication avec la BDD.
- La classe Manager, dont tous les autres Manager héritent.
- Le ManagerExcursion & ManagerTerrain, utilisés pour la connexion entre la base de donnée et le PHP.

### Changed
- La nomenclature dans le changelog a été modifiée. Les guillemets ont été retirés.

### TO-DO
- Terminer les Managers
- Communiquer avec la partie Front & Back pour déterminer les requête utiles.


## [0.0.1] - 2022-03-22
### Added
- Le dossier Objects créé à l'intéreur du dossier DBOperation. Il contient tous les objets nécessaire pour la communication avec la BDD.
- PDO_Connect.php qui contient la fonction qui permet de se connecter à la BDD.
- Tous les objets, répliqués depuis le MLD, avec une fonction Hydrate & leurs accesseurs & mutateurs.