<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $errorCreateProfile = [
    "errorFirstName" => '',
    "errorLastName" => "",
    "errorEmail" => "",
    "errorCompagnyName" => ""
  ];

  $lastName = "";
  $firstName = "";
  $email = "";
  $compagnyName = "";
}

?>

<?php $title = "Profile partenaire" ?>
<?php ob_start() ?>

<div class="container__createClub">

  <main class="content  content__createClub">

    <div class="brand">
      <img src="./public/img/logo.png" alt="logo" class="brand__logo" />
      <h1 class="brand__title">Stay in shape</h1>
    </div>

    <form action="../../index.php?status=on&action=clubCreationForm&id=<?= $partnerProfile['idPartner'] ?>" method="post" id="createClub" class="create">

      <!-- Start btn return for desk -->
      <a href="../../index.php?status=on&action=showPartnerProfile&id=<?= $partnerProfile['idPartner'] ?>" class="btn header__return">
        <svg class="header__return-icon">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
        Retour</a>
      <!-- End btn return for desk -->

      <!-- Start btn return for mob -->
      <a href="../../index.php?status=on&action=showPartnerProfile&id=<?= $partnerProfile['idPartner'] ?>" class=" header__return-blue">
        <svg class="header__return-icon--blue">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
      </a>
      <!-- End btn return for mob  -->
      <h1 class="create__title">Créer un club</h1>

      <div class="create__block">
        <label for="lastName" class="create__label">Nom manager</label>
        <input type="text" name="lastName" id="lastName" class="create__input" value="<?= !$errorCreateProfile['errorLastName'] ? $lastName : "" ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorCreateProfile['errorLastName'] ? $errorCreateProfile['errorLastName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="firstName" class="create__label">Prénom manager</label>
        <input type="text" name="firstName" id="firstName" class="create__input" value="<?= !$errorCreateProfile['errorFirstName'] ? $firstName : "" ?>" />
        <div class=" login__error">
          <p class="login__error-text"><?= $errorCreateProfile['errorFirstName'] ? $errorCreateProfile['errorFirstName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="compagnyName" class="create__label">Nom du club</label>
        <input type="text" name="compagnyName" id="compagnyName" class="create__input" value="<?= !$errorCreateProfile['errorCompagnyName'] ? $compagnyName : "" ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorCreateProfile['errorCompagnyName'] ? $errorCreateProfile['errorCompagnyName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="email" class="create__label">Adresse email</label>
        <input type="email" name="email" id="email" class="create__input" value="<?= !$errorCreateProfile['errorEmail'] ? $email : "" ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorCreateProfile['errorEmail'] ? $errorCreateProfile['errorEmail'] : ""  ?></p>
        </div>
      </div>


      <button type="submit" class="btn create__btn">Suivant</button>
    </form>

  </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>