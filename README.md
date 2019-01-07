# PHP-Final
## Cours 420-4W5-GG
## Auteurs
- Antoine Brassard Lahey
- Simon Boyer
- Michael John Sakellaropoulos

## Description

### Sommaire
Projet final pour le cours Programmation Web Serveur I. Le but du projet était de créer un système de gestion de documents à la Omnivox en PHP.

### MVC

N'ayant pas le droit d'utiliser de librairies externes lors du projet, nous avons décidé de d'implanter notre propre version d'un cadriciel Web MVC. 

Ce dernier inclut un module de routage qui permet, à l'aide de paramètres GET, de naviguer vers différentes actions de contrôleur. Il permet aussi à ces contrôleurs de retourner des vues au client auxquels il est possible de faire parvenir des données par un objet Modèle.

Semblablement, une librairie MVC a été implantée côté client permettant le *data-binding* dans HTML comme on le ferait dans Angular.
