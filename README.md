# ZendSkeletonApplication

## Le projet

Cette application a été réalisée sur Zend Framework.
Elle utilise notamment Doctrine et s'appuye sur Docker pour la mise en place de son environnement de développement.

#### Le projet comprend notamment les fonctionnalités suivantes :
- Possibilité de créér des meetups
```
http://localhost:8080/meetups/new
```
- Affichage de la liste des meetups existants
```
http://localhost:8080/meetups/list
``` 
- Possibilité de modifier un meetup existant
```
http://localhost:8080/meetups/edit/{meetupId}
``` 
- Possibilité de supprimer un meetup existant
```
http://localhost:8080/meetups/delete/{meetupId}
``` 
- Possibilité de consulter le détail d'un meetup existant
```
http://localhost:8080/meetups/details/{meetupId}
```
- Possibilité de créer des organisateurs qui pourront être affectés à un ou plusieurs meetups
```
http://localhost:8080/meetups/new
http://localhost:8080/meetups/edit/{meetupId}
```
- Possibilité d'ajouter et de supprimer des organisateurs d'un meetup
```
http://localhost:8080/meetups/edit/{meetupId}
```
- Possibilité d'ajouter et de supprimer des participants d'un meetup
```
http://localhost:8080/meetups/edit/{meetupId}
```

## Installation

#### Pour installer le projet :

Démarrer l'environnement Docker
```
docker-compose up -d --build
```
Vérifier les requêtes de création de l'architecture de la base de données.
```
docker-compose exec zf php vendor/bin/doctrine-module orm:schema-tool:update
```
Lancer la création de l'architecture de la base de données.
```
docker-compose exec zf php vendor/bin/doctrine-module orm:schema-tool:update --force
```

## Base de données

Accès à PhpMyAdmin
```
http://localhost:9090/
```
#### Comptes Mysql
Root user
- login : `root`
- password : `aye4DzRW`
Application user
- login : `application`
- password : `fgWvFbhK`

