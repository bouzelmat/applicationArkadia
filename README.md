# Projet Arkadia Zoo

# Description du Projet
Le projet consiste en la création d'un site web pour Arkadia Zoo, un établissement zoologique dirigé par José, mettant l'accent sur l'écologie et le bien-être animal.

# Objectif Principal
Développer une plateforme web interactive et transparente, offrant une expérience utilisateur immersive tout en promouvant les valeurs écologiques du zoo. Le site vise à informer, engager et attirer les visiteurs potentiels intéressés par une expérience zoologique éthique et écologique.

# Caractéristiques du Site
1-Transparence Exceptionnelle : Accès détaillé aux informations sur l'état de santé et l'alimentation des animaux.
2-Exploration Visuelle : Dès la page d'accueil, les utilisateurs peuvent explorer visuellement les différents habitats et découvrir les animaux qui y résident.
3-Expérience Utilisateur : Navigation intuitive permettant de consulter facilement l'ensemble des entités du zoo et les différents services proposés.
4-Descriptions et Images : Chaque section est enrichie de descriptions précises et d'images de haute qualité pour une immersion totale.
5-Technologies Modernes : Utilisation de technologies web modernes pour offrir une expérience interactive avec des transitions douces entre les différentes vues.
5-Retour d'Expérience : Système de retour d'expérience permettant aux visiteurs de partager leurs avis, contribuant ainsi à l'amélioration continue des services du zoo.
6-Formulaire de Contact : Facilite la communication entre le public et l'établissement.

## Technologies clés

### Front-end
- HTML
- CSS
- Bootstrap
- JavaScript

### Back-end
- PHP
- SQL
- MongoDB Query Language (MQL)

### Base de données
- MySQL
- MongoDB (NoSQL)

## Prérequis

### Matériel
- Ordinateur avec au moins 4 Go de RAM
- Espace disque : minimum 2 Go disponible

### Logiciel
- Système d'exploitation : Windows 10/11 (testé sur ces versions)
- XAMPP version 3.3.0 ou supérieure (inclut Apache, PHP, MySQL)
- PHP version 8.2
- MongoDB (dernière version stable)
- Composer (gestionnaire de dépendances PHP)
- Git (pour le clonage du dépôt)

### Extensions PHP requises
- php_mongodb.dll (version 1.15.1 pour PHP 8.2 TS x64). à titre d'information, lorsque j'ai utilisé les dernières versions disponibles cela ne permettait pas à PHP d'interagir avec MongoDB 
- Autres extensions standard de PHP (incluses dans XAMPP)

## Instructions d'Installation

1. **Installation de XAMPP**
   - Téléchargez XAMPP 3.3.0 ou version supérieure depuis apachefriends.org.
   - Installez XAMPP en suivant les instructions du programme d'installation.

2. **Configuration de MySQL dans XAMPP**
   - Ouvrez le fichier `my.ini` dans le dossier d'installation de XAMPP.
   - Modifiez la ligne du port par défaut pour MySQL : `port=3307`
   - Sauvegardez le fichier et redémarrez le service MySQL.

3. **Installation de MongoDB**
   - Téléchargez et installez MongoDB depuis le site officiel.
   - Suivez les instructions d'installation par défaut.

4. **Installation de l'extension PHP MongoDB**
   - Téléchargez le fichier `php_mongodb-1.15.1-8.2-ts-vs16-x64.zip`.
   - Extrayez `php_mongodb.dll` et placez-le dans le dossier `C:\xampp\php\ext\`.
   - Ajoutez `extension=php_mongodb.dll` à votre fichier `php.ini`.
   - Redémarrez le service Apache.

5. **Installation de Composer**
   - Téléchargez et installez Composer depuis getcomposer.org.

6. **Clonage et Configuration du Projet**
   - Clonez ou téléchargez le projet dans le dossier `C:\xampp\htdocs\`.
   - Installez les dépendances : `composer install`

7. **Configuration des Bases de Données**
   - MySQL : Créez une base de données `arkadia_zoo` et importez le fichier SQL fourni.
   - MongoDB : Importez les données fournies via MongoDB Compass.

8. **Configuration du Projet**
   - Vérifiez les fichiers de configuration dans le dossier `config`.

9. **Lancement de l'Application**
   - Démarrez les services Apache et MySQL.
   - Accédez à `http://localhost/arkadia_zoo/index.php` ce fichier est le point d'entrée de l'application.

## Accès à l'Application

Utilisez les identifiants suivants :
- Admin : username: userPhilipe, password: passwordPhilipe
- Vétérinaire : username: userMathieu, password: passwordMathieu
- Employé : username: userLisa, password: passwordLisa

## Dépannage

- Pour les erreurs liées à l'extension MongoDB, vérifiez l'installation du DLL et l'activation dans `php.ini`.
- Pour les problèmes de connexion MySQL, vérifiez la configuration du port 3307.
- Pour MongoDB, assurez-vous que le service est démarré et accessible via `mongosh`.

## Support
Pour toute question ou problème, veuillez me contactez par mail : omarbouzelmat99@gmail.com