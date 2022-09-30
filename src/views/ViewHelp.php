Information<?php $title = 'Aide' ?>

<?php ob_start() ?>

<div class="container__createClub">
  <main class="content content__createClub">


    <div class="help" id="up">

      <!-- Start btn return for desk -->
      <a href="../../index.php?status=on&action=home" class="btn header__return help__return ">
        <img src="public/img/icons/icon-left-arrow.png" alt="button return" class="header__return-icon">

        Retour</a>
      <!-- End btn return for desk -->

      <!-- Start btn return for mob -->
      <a href="../../index.php?status=on&action=home" class=" header__return-blue help__return ">
        <img src="public/img/icons/icon-left-arrow-blue.png" alt="button return" class="header__return-icon">

      </a>
      <!-- End btn return for mob  -->

      <h1 class="help__title">Aide</h1>

      <ul class="help__summary">
        <li class="help__summary-item"><a href="#admin" class="help__summary-link">Administrateur</a></li>
        <li class="help__summary-item"><a href="#tech" class="help__summary-link">Technicien</a></li>
        <li class="help__summary-item"><a href="#user" class="help__summary-link">Utilisateur</a></li>
      </ul>

      <a href="#up" class="help__up">
        <img src="public/img/icons/icon-up.png" alt="icon arrow up" class="help__up-icon">
      </a>

      <section class="help__section" id="admin">
        <h2 class="help__sectionTitle">Administrateur</h2>

        <div class="help__block">
          <h2 class="help__features-title">Accès administrateur</h2>
          <p class="help__text">afin d’accéder à la page login de l’administrateur, il suffit de renseigner "indexAdmin.php" dans la barre de navigation.</p>
          <div class="help__img">
            <img src="public/img/help/help-19.png" alt="picture help" class="help__img-big">
          </div>

        </div>
        <ul class="help__features">
          <h3 class="help__features-title">Fonctionnalités</h3>
          <li class="help__features-item"><a href="#adminAddAccount" class="help__summary-link">ajouter un compte technicien</a></li>
          <li class="help__features-item"><a href="#adminDeleteAccount" class="help__summary-link">supprimer un compte technicien</a>n</li>
          <li class="help__features-item"><a href="#adminSearch" class="help__summary-link">rechercher un compte technicien</a></li>
        </ul>

        <div class="help__block" id="adminAddAccount">
          <h4 class="help__subtitle">ajouter un compte technicien</h4>
          <p class="help__text">
            Afin de créer un nouveau compte, il suffit de rentrer un nom, un prénom, une adresse e-mail, puis cliquez sur "créer".
            Une page de confirmation s'ouvre, cliquez sur le bouton "confirmer".
            Le nouveau compte technicien est créé, il suffit de récupérer le mot de passe associé à ce compte.
          </p>
        </div>

        <div class="help__block" id="adminDeleteAccount">
          <h4 class="help__subtitle">supprimer un compte technicien</h4>
          <p class="help__text">
            Entrez l'e-mail du compte à supprimer, puis cliquez sur le bouton "supprimer".
            Une page de confirmation s'ouvre, cliquez sur le bouton "confirmer".
            Cependant, il sera possible de supprimer uniquement les comptes de techniciens.
          </p>
        </div>

        <div class="help__block" id="adminSearch">
          <h4 class="help__subtitle">rechercher compte technicien</h4>
          <p class="help__text">
            La barre de recherche utilise les noms et prénoms des utilisateurs afin d'effectuer une recherche.
          </p>
        </div>

      </section>


      <section class="help__section" id="tech">
        <h2 class="help__sectionTitle">Technicien</h2>

        <div class="help__block">
          <h2 class="help__features-title">Accès technicien</h2>
          <p class="help__text">afin d’accéder à la page login du technicien, il suffit de renseigner "index.php" dans la barre de navigation.</p>
          <div class="help__img">
            <img src="public/img/help/help-18.png" alt="picture help" class="help__img-big">
          </div>
        </div>

        <ul class="help__features">
          <h3 class="help__features-title">Fonctionnalités</h3>

          <li class="help__features-item"><a href="#createPartner" class="help__summary-link">Création d’un compte franchise</a></li>
          <li class="help__features-item"><a href="#createClub" class="help__summary-link">Création d’un compte club</a></li>
          <li class="help__features-item"><a href="#deletePartner" class="help__summary-link">Supprimer un compte franchise</a></li>
          <li class="help__features-item"><a href="#deleteclub" class="help__summary-link">Supprimer un compte club</a></li>
          <li class="help__features-item"><a href="#activePartner" class="help__summary-link">Activer un compte franchise</a></li>
          <li class="help__features-item"><a href="#activeClub" class="help__summary-link">Activer un compte club</a></li>
          <li class="help__features-item"><a href="#disablePartner" class="help__summary-link">Désactiver un compte franchise</a></li>
          <li class="help__features-item"><a href="#disableClub" class="help__summary-link">Désactiver un compte club</a></li>
          <li class="help__features-item"><a href="#search" class="help__summary-link">Utiliser la barre de recherche</a></li>
          <li class="help__features-item"><a href="#modifyPermission" class="help__summary-link">Modifier les permissions d'un club</a></li>
          <li class="help__features-item"><a href="#changeClubOwner" class="help__summary-link">Effectuer un changement de propriétaire pour un club</a></li>
          <li class="help__features-item"><a href="#info" class="help__summary-link">Afficher les informations d'un utilisateur</a></li>
          <li class="help__features-item"><a href="#filter" class="help__summary-link">Filtrer les comptes activés / désactivés</a></li>
        </ul>

        <div class="help__block" id="createPartner">
          <h4 class="help__subtitle">Création d’un compte franchise</h4>
          <p class="help__text">
            Pour créer le compte d'une franchise, entrez le nom, le prénom, le nom de la franchise, et son adresse e-mail.
            Son adresse e-mail doit être unique (non utilisé), puis cliquez sur le bouton "suivant".
            Une page de confirmation s'ouvre, veuillez cliquer sur le bouton "confirmer".
            Un message apparaît, confirmant la création du compte, il est maintenant possible de récupérer le mot de passe.
            Puis cliquez sur le bouton "retour".
            Une fois le compte créé, il apparaît comme désactivé.
            Il suffit de l'activer manuellement (cf. activation de compte);
          </p>
          <div class="help__img">
            <img src="public/img/help/help-1.png" alt="picture help" class="help__img-big">
          </div>
        </div>

        <div class="help__block" id="createClub">
          <h4 class="help__subtitle">Création d’un compte club</h4>
          <p class="help__text">
            Pour créer un club, allez sur le compte de la franchise souhaitant ajouter un club, puis cliquez sur le bouton "ajouter".
            Si le bouton "ajouter" n'apparaît pas, la franchise et désactivé, il suffira d'activer celle-ci pour pouvoir ajouter un nouveau club.
            Lors de la création du club, entrez le nom, le prénom, le nom du club ainsi que son adresse e-mail (dois être unique) puis cliquez sur le bouton "suivant".
            La page des permissions s'ouvre.
            Remplir les permissions accordées à ce club puis cliquer sur le bouton "créer".
            Une page de confirmation s'ouvre, cliquez sur le bouton "confirmer".
            Si vous cliquez sur le bouton "annuler" lors de la création d'un nouveau club, les informations rentrées au préalable seront supprimées.
            Une fenêtre s'ouvre indiquant l'adresse e-mail, le mot de passe du club créé ainsi qu'un message indiquant qu'un e-mail de confirmation vient d'être envoyé à la franchise responsable.
            Cliquez sur le bouton "retour".
            À ce stade, le compte du club est désactivé.
            Pour l'activer, le responsable de la franchise devra consulter ses e-mails et cliquer sur le lien d'activation fourni.
            Une fois fait, le nouveau compte Club sera actif et il sera donc possible pour celui-ci de se connecter.
            En tant que technicien, il est possible de forcer l'activation du compte (cf. activation de compte).
          </p>

          <div class="help__img">
            <img src="public/img/help/help-2.png" alt="picture help" class="help__img-big">
          </div>
        </div>

        <div class="help__block" id="deletePartner">
          <h4 class="help__subtitle">supprimer un compte franchise</h4>
          <p class="help__text">
            Pour pouvoir supprimer le compte d'une franchise, il est nécessaire que celle-ci ne possède aucun club.
            Pour supprimer le compte d'une franchise, il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "supprimer".
            Une page de confirmation s'ouvre, cliquez sur le bouton "confirmer."
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img">
              <img src="public/img/help/help-3.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img">
              <img src="public/img/help/help-13.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="deleteclub">
          <h4 class="help__subtitle">supprimer un compte club</h4>
          <p class="help__text">
            Pour supprimer le compte d'un club, il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "supprimer".
            Une page de confirmation s'ouvre, cliquez sur le bouton "confirmer".
            Un e-mail de notification est envoyé à la franchise responsable afin de signaler la suppression du compte concerné.
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-3.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-13.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="activePartner">
          <h4 class="help__subtitle">activer un compte franchise</h4>
          <p class="help__text">
            Pour activer le compte d'une franchise, il suffit de se rendre sur le profil concerné, puis cliquez sur le bouton "activer".
            Une page de confirmation de changement de statut apparaît, cliquez sur le bouton "confirmer".
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-9.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-15.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="activeClub">
          <h4 class="help__subtitle">activer un compte club</h4>
          <p class="help__text">
            Pour activer le compte d'un club, il suffit de se rendre sur le profil concerné, cliquez sur le bouton "activer".
            Une page de confirmation de changement de statut apparaît, cliquez sur le bouton "confirmer".
            Un e-mail notifiant le changement de statut sera envoyé à la franchise responsable et au club concerné.
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-9.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-15.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="disablePartner">
          <h4 class="help__subtitle">désactiver un compte franchise</h4>
          <p class="help__text">
            Pour désactiver le compte d'une franchise, il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "désactiver".
            Une page de confirmation de changement de statut apparaît, cliquez sur le bouton "confirmer".
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-8.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-12.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="disableClub">
          <h4 class="help__subtitle">désactiver un compte club</h4>
          <p class="help__text">
            Pour désactiver le compte d'un club, il suffit de se rendre sur le profil concerné et de cliquer sur le bouton "désactiver".
            Une page de confirmation de changement de statut apparaît, cliquez sur le bouton "confirmer".
            Un e-mail de notification sera envoyé à la franchise responsable, concernant le changement de statut de son club.
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-8.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-12.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="search">
          <h4 class="help__subtitle">utiliser la barre de recherche</h4>
          <p class="help__text">
            La barre de recherche utilise les noms et prénoms des utilisateurs afin d'effectuer une recherche.
            Lorsque l'on clique sur un résultat de recherche, vous serez automatiquement redirigé vers le profil de l'utilisateur recherché.
          </p>
          <div class="help__icon">
            <div class="help__img-btn">
              <img src="public/img/help/help-10.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="modifyPermission">
          <h4 class="help__subtitle">modifier les permissions d'un club</h4>
          <p class="help__text">
            Pour modifier les permissions d'un club, le compte doit être activé.
            Rendez-vous sur le compte concerné.
            En bas de la page se trouve le bouton "modifier", cliquez dessus.
            Une nouvelle page s'ouvre avec les anciennes permissions déjà cochées, effectuer les modifications,
            puis cliquez sur le bouton "modifier" qui se trouve en bas de la page.
            Une page de confirmation s'ouvre, cliquez sur le bouton "confirmer".
            Un e-mail de notification sera alors envoyé au responsable de franchise ainsi qu'au club concerné.
          </p>
          <div class="help__icon">
            <div class="help__img-btn">
              <img src="public/img/help/help-5.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="changeClubOwner">
          <h4 class="help__subtitle">effectuer un changement de propriétaire pour un club</h4>
          <p class="help__text">
            Rendez-vous sur le profil du club concerné, cliquez sur le bouton "changer de propriétaire".
            Une page s'ouvre, choisissez le nouveau propriétaire, puis cliquez sur le bouton "suivant".
            Une page de confirmation s’ouvre, cliquez sur le bouton "confirmer".
            Un e-mail de notification sera envoyé aux nouveaux propriétaires ainsi qu'au club concerné par ce changement.
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-11.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-17.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="info">
          <h4 class="help__subtitle">afficher les informations d'un utilisateur</h4>
          <p class="help__text">
            Pour consulter les informations d'un utilisateur, rendez-vous dans le profil concerné,
            cliquez sur le bouton "plus d'infos".
            La page d'informations s'ouvre.
          </p>
          <div class="help__icon">
            <span class="help__img-text">version desk :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-6.png" alt="picture help" class="help__img-small">
            </div>
            <span class="help__img-text">version mob :</span>
            <div class="help__img-btn">
              <img src="public/img/help/help-14.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>

        <div class="help__block" id="filter">
          <h4 class="help__subtitle">filtrer les comptes activés / désactivés</h4>
          <p class="help__text">
            Dans le menu gérer les franchises et/ou gérer les clubs,
            il est possible d'afficher tous les profils, que les profils actifs, que les profils désactiver.
          </p>
          <div class="help__icon">
            <div class="help__img-btn">
              <img src="public/img/help/help-4.png" alt="picture help" class="help__img-small">
            </div>
          </div>
        </div>
      </section>

      <section class="help__section" id="user">
        <h2 class="help__sectionTitle">Utilisateur</h2>

        <div class="help__block">
          <h2 class="help__features-title">Accès utilisateur</h2>
          <p class="help__text">afin d’accéder à la page login de l'utilisateur, il suffit de renseigner "index.php" dans la barre de navigation.</p>
          <div class="help__img">
            <img src="public/img/help/help-18.png" alt="picture help" class="help__img-big">
          </div>
        </div>

        <ul class="help__features">
          <h3 class="help__features-title">Fonctionnalités</h3>
          <li class="help__features-item"><a href="#modifyPassword" class="help__summary-link">modifier mot de passe de compte</a></li>
          <li class="help__features-item"><a href="#modifyPicture" class="help__summary-link">modifier photo de profil</a></li>
          <li class="help__features-item"><a href="#modifyDescription" class="help__summary-link">Modifier description</a></li>
          <li class="help__features-item"><a href="#showProfile" class="help__summary-link">aperçu des modules liés au compte</a></li>
        </ul>


        <div class="help__block" id="modifyPassword">
          <h4 class="help__subtitle">modifier le mot de passe</h4>
          <p class="help__text">
            Pour modifier la description du profil, cliquez sur le lien réglages, puis modifier mot de passe.
            Entrer votre ancien mot de passe, puis votre nouveau mot de passe.
            Votre nouveau mot de passe doit comporter au minimum une lettre majuscule,
            une lettre minuscule, et un caractère spécial, et sa longueur doit être au minimum de 8 caractères.
            Puis cliquez sur le bouton "envoyer". Une fenêtre de notification apparaît, cliquez sur le bouton "retour".
          </p>
        </div>

        <div class="help__block" id="modifyPicture">
          <h4 class="help__subtitle">modifier photo de profil</h4>
          <p class="help__text">
            Pour modifier la description du profil, cliquez sur le lien réglages, puis modifier photo.
            Télécharger la photo. La photo ne doit pas dépasser 2Mo, puis cliquez sur le bouton "envoyer".
            Une fenêtre de notification apparaît, cliquez sur le bouton "retour".
          </p>
        </div>

        <div class="help__block" id="modifyDescription">
          <h4 class="help__subtitle">modifier la description</h4>
          <p class="help__text">
            Pour modifier la description du profil, cliquer sur le lien "réglages", puis modifier description.
            La description doit comporter au minimum 50 caractères, puis cliquez sur le bouton "envoyer".
            Une fenêtre de notification apparaît, cliquez sur le bouton "retour".
          </p>
        </div>

        <div class="help__block" id="showProfile">
          <h4 class="help__subtitle">aperçu du profil</h4>
          <p class="help__text">
            Pour obtenir un aperçu du profil, cliquez sur le lien mon profil.
            En fonction du type d'utilisateur,
            il sera possible de voir les permissions accordées ainsi qu'une liste des clubs rattachés à ce compte.
          </p>
        </div>
      </section>

    </div>
  </main>



</div>

<?php $content = ob_get_clean(); ?>

<?php require("templates/layout.php") ?>