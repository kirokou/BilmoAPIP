# BilmoAPIP
[![Maintainability](https://api.codeclimate.com/v1/badges/c17172dc05e6b029f610/maintainability)](https://codeclimate.com/github/kirokou/BilmoAPIP/maintainability)

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/1aab65e69f19454291f439bd757dbe65)](https://www.codacy.com/manual/borgine/BileMoApi?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=kirokou/BileMoApi&amp;utm_campaign=Badge_Grade)

<p align="center">
<img src = "public/img/kirokou.png"  width="150" height="150"  title = "" alt = "kirokou">
<img src = "public/img/sf5.png"  width="150" height="150" title = "" alt = "sf5">
</p>

# About this project ? 

## Contexte
BileMo est une entreprise offrant toute une sélection de téléphones mobiles haut de gamme.

Vous êtes en charge du développement de la vitrine de téléphones mobiles de l’entreprise BileMo. Le business modèle de BileMo n’est pas de vendre directement ses produits sur le site web, mais de fournir à toutes les plateformes qui le souhaitent l’accès au catalogue via une API (Application Programming Interface). Il s’agit donc de vente exclusivement en B2B (business to business).

## Customer needs
Après une réunion dense avec le client, il a été identifié un certain nombre d’informations. Il doit être possible de :

- consulter la liste des produits BileMo ;
- consulter les détails d’un produit BileMo ;
- consulter la liste des utilisateurs inscrits liés à un client sur le site web ;
- consulter le détail d’un utilisateur inscrit lié à un client ;
- ajouter un nouvel utilisateur lié à un client ;
- supprimer un utilisateur ajouté par un client.
Seuls les clients référencés peuvent accéder aux API. Les clients de l’API doivent être authentifiés via OAuth ou JWT.

# How install this project ? 

## Prérequis
- Language => PHP 7.2
- Framework => Symfony
- Composer 
- Web Server  

# Install

## Download or clone the repository

    Git clone https://github.com/bpel/bilemo.git

## Download dependencies
    
    composer install

## Config .env

## Create database

    php bin/console doctrine:database:create

## Update Schema

    php bin/console d:s:u -f

## Load Fixtures

    php bin/console doctrine:fixtures:load

## Run server

    symfony server:start
    ou 
    symfony serve
    ou
    php -S 127.0.0.1:8000 -t public

## Manage Login
{
	"username":"TAKE-AN-EMAIL-IN-DATABASE", 
	"password":"openclassrooms-P7"
}

## Manage Client Role
    By default the Client's Role is ROLE_USER. He can see only his users.
    You can change your Role is data base to be ADMIN. 

## UML Diagramm.

