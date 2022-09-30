<?php
$currentUser = $_SESSION['currentUser'] ?? "";
?>
<?php $title = "Mon compte" ?>
<?php ob_start() ?>

<div class="container__createClub">
  <main class="content content__createClub ">
    <div class="account <?= $userProfile['status'] === "enabled" ? "active" : "inactive" ?>">
      <?php if ($currentUser['type'] === 'tech') : ?>
        
        <!-- Start btn return for desk -->
        <a href="../../index.php?status=on&action=<?= $userType === "Club" ? "showClubProfile&id=$idUrl" : "showPartnerProfile&id=$idUrl" ?>" class="btn header__return">
          <img src="public/img/icons/icon-left-arrow.png" alt="button return" class="header__return-icon">
          Retour</a>
        <!-- End btn return for desk -->

        <!-- Start btn return for mob -->
        <a href="../../index.php?status=on&action=<?= $userType === "Club" ? "showClubProfile&id=$idUrl" : "showPartnerProfile&id=$idUrl" ?>" class=" header__return-blue">
          <img src="public/img/icons/icon-left-arrow-blue.png" alt="button return" class="header__return-icon">
        </a>
      <?php else : ?>
        <a href="../../index.php?status=on&action=home" class="btn header__return">
          <img src="public/img/icons/icon-left-arrow.png" alt="button return" class="header__return-icon">
          Retour</a>
        <!-- End btn return for desk -->

        <!-- Start btn return for mob -->
        <a href="../../index.php?status=on&action=home" class=" header__return-blue">
          <img src="public/img/icons/icon-left-arrow-blue.png" alt="button return" class="header__return-icon">
        </a>

      <?php endif ?>

      <div class="account__header">
        <!-- End btn return for mob  -->
        <h1 class="account__title">Mon compte</h1>

        <img src="<?= $userProfile['img'] ?>" alt="profile picture" class="account__img <?= $currentUser['type'] === "tech" ? "account__img-center" : "" ?>">

        <?php if ($currentUser['type'] === "Club" || $currentUser['type'] === "Partner") : ?>
          <div class="account__list">
            <a href="../../index.php?status=on&action=changePictureForm" class="account__link">Modifier photo</a>
            <a href="../../index.php?status=on&action=changeDescriptionForm" class="account__link">Modifier description</a>
            <a href="../../index.php?status=on&action=changePasswordForm" class="account__link">Modifier mot de passe</a>
          </div>
        <?php endif ?>
      </div>
      <!-- Start btn return for desk -->

      <div class="account__block">
        <div class="account__subtitle">Nom :
          <span class="account__text"><?= $userProfile['lastName'] ?></span>
        </div>
      </div>

      <div class="account__block">
        <div class="account__subtitle">Prénom :
          <span class="account__text"><?= $userProfile['firstName'] ?></span>
        </div>
      </div>

      <div class="account__block">
        <div class="account__subtitle">Email :
          <span class="account__text"><?= $userProfile['email'] ?></span>
        </div>
      </div>
      <?php if ($userType === "Club") : ?>
        <div class="account__block">
          <div class="account__subtitle">Nom du club :
            <span class="account__text"><?= $userProfile["clubName"] ?></span>
          </div>
        </div>

        <div class="account__block">
          <div class="account__subtitle">Franchise responsable :
            <span class="account__text"><?= $userProfile['nameFranchiseOwner'] ?></span>
          </div>
        </div>
      <?php else : ?>

        <div class="account__block">
          <div class="account__subtitle">Nom de la franchise :
            <span class="account__text"><?= $userProfile['franchiseName'] ?></span>
          </div>
        </div>

      <?php endif ?>
      <div class="account__block">
        <div class="account__subtitle">Description :
          <span class="account__text account__text-description"><?= $userProfile["description"] ?></span>
        </div>
      </div>

    </div>
  </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php');
