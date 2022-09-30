![Logo](https://zupimages.net/up/22/40/9ogi.png)

# Stay in Shape

Le client est une grande marque de salle de sport, qui possède des franchises.
L’entreprise souhaite créer une application simple destinée à ses équipes techniques.

Les responsables de franchise ainsi que les responsables de club de sport auront également un accès leur permettant une lecture seul de leur profil.
Grâce à cette application l’équipe technique pourra gérer les droits d’accès à ces différentes applications Web,
afin que les franchisés et clubs de sport puissent les utiliser.

Le projet a donc pour but de créer une interface ergonomique afin d’ aider l’équipe technique à ouvrir ou fermer les accès au module de leur API auprès des franchisées / salles de sport.

## Run Locally

Clone the project

```bash
  git clone https://github.com/cam8bass/stayInShape.git
```

Go to the project directory

```bash
  cd stayInShape
```

Install dependencies

```bash
  composer require phpmailer/phpmailer
```

Go to the secureData file

```bash
  stayInShape/src/secure/secureData.php
```

Complete secureData file

```bash
  SECURE_DNS_DB = mysql:host="dns";dbname="your db name";
  SECURE_USER_DB = "your username db"
  SECURE_PWD_DB = "your password db"
  SECURE_EMAIL = "SMTP username"
  SECURE_PWD_EMAIL = "SMTP password"
```

## Database

cf. bdd.md

## Features

Administrateur :

- Ajouter un compte technicien
- Supprimer un compte technicien
- Rechercher un compte technicien

Technicien :

- Création d’un compte franchise
- Création d’un compte club
- Supprimer un compte franchise
- Supprimer un compte club
- Activer un compte franchise
- Activer un compte club
- Désactiver un compte franchise
- Désactiver un compte club
- Utiliser la barre de recherche
- Modifier les permissions d'un club
- Effectuer un changement de propriétaire pour un club
- Afficher les informations d'un utilisateur
- Filtrer les comptes activés / désactivés

Utilisateur :

- Modifier mot de passe de compte
- Modifier photo de profil
- Modifier description
- Aperçu des modules lié au compte

## Documentation

### Administrateur

#### Accès administrateur

Afin d’accéder à la page login de l’administrateur,
il suffit de renseigner "indexAdmin.php" dans la barre de navigation.

#### Ajouter un compte technicien

Afin de créer un nouveau compte, il suffit de rentrer un nom, un prénom,
adresse e-mail, puis cliquer sur "créer". Une page de confirmation s'ouvre,
cliquer sur le bouton "confirmer". Le nouveau compte technicien est créé,
il suffit de récupérer le mot de passe associé à ce compte.

#### Supprimer un compte technicien

Entrer l'e-mail du compte à supprimer, puis cliquer sur le bouton "supprimer".
Une page de confirmation s'ouvre, cliquer sur le bouton "confirmer".
Cependant, il sera possible de supprimer uniquement les comptes de techniciens.

#### Rechercher compte technicien

La barre de recherche utilise les noms et prénoms des utilisateurs afin d'effectuer une recherche.

### Technicien

#### Accès technicien

Afin d’accéder à la page login du technicien,
il suffit de renseigner "index.php" dans la barre de navigation.

#### Création d’un compte franchise

Pour créer le compte d'une franchise, entrer le nom, le prénom,
le nom de la franchise, et son adresse e-mail.
Son adresse e-mail doit être unique (non utilisé), puis cliquer sur le bouton "suivant".
Une page de confirmation s'ouvre, veuillez cliquer sur le bouton "confirmer".
Un message apparaît, confirmant la création du compte,
il est maintenant possible de récupérer le mot de passe.
Puis cliqué sur le bouton "retour". Une fois le compte créé,
il apparaît comme désactivé. Il suffit de l'activer manuellement (cf. activation de compte);

#### Création d’un compte club

Pour créer un club, aller sur le compte de la franchise souhaitant ajouter un club,
puis cliquer sur le bouton "ajouter". Si le bouton "ajouter" n'apparaît pas,
la franchise et désactivé, il suffira d'activer celle-ci pour pouvoir ajouter un nouveau club.
Lors de la création du club, entrer le nom, le prénom,
le nom du club ainsi que son adresse e-mail (dois être unique) puis cliquer sur le bouton "suivant".
La page des permissions s'ouvre. Remplir les permissions accordées à ce club puis cliquées sur le bouton "créer".
Une page de confirmation s'ouvre, cliquée sur le bouton "confirmer".
Si vous cliquez sur le bouton "annuler" lors de la création d'un nouveau club,
les informations rentrées au préalable seront supprimées.
Une fenêtre s'ouvre indiquant l'adresse e-mail,
le mot de passe du club créé ainsi qu'un message indiquant qu'un e-mail de confirmation vient d'être envoyé à la franchise responsable.
Cliquez sur le bouton "retour".
À ce stade, le compte du club est désactivé. Pour l'activer,
le responsable de la franchise devra consulter ses e-mails et cliquer sur le lien d'activation fourni.
Une fois fait, le nouveau compte Club sera actif et il sera donc possible pour celui-ci de se connecter.
En tant que technicien, il est possible de forcer l'activation du compte (cf. activation de compte).

#### Supprimer un compte franchise

Pour pouvoir supprimer le compte d'une franchise,
il est nécessaire que celle-ci ne possède aucun club.
Pour supprimer le compte d'une franchise,
il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "supprimer".
Une page de confirmation s'ouvre, cliquer sur le bouton "confirmer."

#### Supprimer un compte club

Pour supprimer le compte d'un club,
il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "supprimer".
Une page de confirmation s'ouvre, cliquer sur le bouton "confirmer".
Un e-mail de notification est envoyé à la franchise responsable afin de signaler la suppression du compte concerné.

#### Activer un compte franchise

Pour activer le compte d'une franchise,
il suffit de se rendre sur le profil concerné,
et cliquer sur le bouton "activer".
Une page de confirmation de changement de statut apparaît,
cliquer sur le bouton "confirmer".

#### Activer un compte club

Pour activer le compte d'un club,
il suffit de se rendre sur le profil concerné,
et cliquer sur le bouton "activer".
Une page de confirmation de changement de statut apparaît,
cliquer sur le bouton "confirmer".
Un e-mail notifiant le changement de statut sera envoyé à la franchise responsable et au club concerné.

#### Désactiver un compte franchise

Pour désactiver le compte d'une franchise,
il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "désactiver".
Une page de confirmation de changement de statut apparaît,
cliquer sur le bouton "confirmer".

#### Désactiver un compte club

Pour désactiver le compte d'un club,
il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "désactiver".
Une page de confirmation de changement de statut apparaît,
cliquer sur le bouton "confirmer".
Un e-mail de notification sera envoyé à la franchise responsable,
concernant le changement de statut de son club.

#### Utiliser la barre de recherche

La barre de recherche utilise les noms et prénoms des utilisateurs afin d'effectuer une recherche.
Lorsque l'on clique sur un résultat de recherche,
vous serez automatiquement redirigé vers le profil de l'utilisateur recherché.

#### Modifier les permissions d'un club

Pour modifier les permissions d'un club, le compte doit être activé.
Rendez-vous sur le compte concerné. En bas de la page se trouve le bouton modifier,
cliquer dessus. Une nouvelle page s'ouvre avec les anciennes permissions déjà cochées,
effectuer les modifications, puis cliquer sur le bouton "modifier" qui se trouve en bas de la page.
Une page de confirmation s'ouvre, cliquer sur le bouton "confirmer".
Un e-mail de notification sera alors envoyé au responsable de franchise ainsi qu'au club concerné.

#### Effectuer un changement de propriétaire pour un club

Rendez-vous sur le profil du club concerné, puis cliquer sur le bouton "changer de propriétaire".
Une page s'ouvre, choisissez le nouveau propriétaire, puis cliquer sur le bouton "suivant".
Une page de confirmation s’ouvre, cliquer sur le bouton "confirmer".
Un e-mail de notification sera envoyé aux nouveaux propriétaires ainsi qu'au club concerné par ce changement.

#### Afficher les informations d'un utilisateur

Pour consulter les informations d'un utilisateur,
rendez-vous dans le profil concerné, puis cliquer sur le bouton "plus d'infos".
La page d'informations s'ouvre.

#### Filtrer les comptes activés / désactivés

Dans le menu gérer les franchises et/ou gérer les clubs,
il est possible d'afficher tous les profils, que les profils actifs,
que les profils désactiver.

### Utilisateur

#### Accès utilisateur

Afin d’accéder à la page login de l'utilisateur,
il suffit de renseigner "index.php" dans la barre de navigation.

#### Modifier mot de passe

Pour modifier la description du profil, cliquer sur le lien réglages,
puis modifier mot de passe. Entrer votre ancien mot de passe,
puis votre nouveau mot de passe.
Votre nouveau mot de passe doit comporter au minimum une lettre majuscule,
une lettre minuscule, et un caractère spécial,
et sa longueur doit être au minimum de 8 caractères.
Puis cliquer sur le bouton "envoyer".
Une fenêtre de notification apparaît, cliquer sur le bouton "retour".

#### Modifier photo de profil

Pour modifier la description du profil, cliquer sur le lien réglages,
puis modifier photo. Télécharger la photo.
La photo ne doit pas dépasser 2Mo, puis cliquer sur envoyer.
Une fenêtre de notification apparaît, cliquer sur le bouton "retour".

#### Modifier la description

Pour modifier la description du profil, cliquer sur le lien réglages, puis modifier description.
La description doit comporter au minimum 50 caractères, puis cliquer sur le bouton "envoyer".
Une fenêtre de notification apparaît, cliquer sur le bouton "retour".

#### Aperçu du profil

Pour obtenir un aperçu du profil, cliquer sur le lien mon profil.
En fonction du type d'utilisateur,
il sera possible de voir les permissions accordées ainsi qu'une liste des clubs rattachés à ce compte.

## Project link

[StayInShape](https://www.camei8ht.fr)

## login

#### Admin

```bash
mail : admin@email.com
pass: Admin;1234
```

#### Technician

```bash
mail : johnSmith@email.com
pass: Tech;1234
```

## Use

[Flaticon](https://www.flaticon.com/fr/)

[Pexels](https://www.pexels.com/fr-fr/)

[IcoMoon](https://icomoon.io/#home)
