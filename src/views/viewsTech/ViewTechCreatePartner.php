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

<?php $title = "Créer un nouveau partenaire" ?>

<?php ob_start() ?>

<div class="container__index">

  <div class="sideBar">
    <?php require_once('./includes/home.php'); ?>
    <?php require_once('./includes/nav.php'); ?>
  </div>

  <main class="content content__index">

    <div class="brand">
      <img src="./public/img/logo.png" alt="logo" class="brand__logo" />
      <h1 class="brand__title">Stay in shape</h1>
    </div>

    <form action="../../index.php?status=on&action=partnerCreationForm" method="post" class="create">
      <h1 class="create__title">Créer un nouveau partenaire</h1>

      <div class="create__block">
        <label for="lastName" class="create__label">Nom</label>
        <input type="text" name="lastName" id="lastName" class="create__input" value="<?= !$errorCreateProfile['errorLastName'] ? $lastName : "" ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorCreateProfile['errorLastName'] ? $errorCreateProfile['errorLastName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="firstName" class="create__label">Prénom</label>
        <input type="text" name="firstName" id="firstName" class="create__input" value="<?= !$errorCreateProfile['errorFirstName'] ? $firstName : "" ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorCreateProfile['errorFirstName'] ? $errorCreateProfile['errorFirstName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="compagnyName" class="create__label">Nom franchise</label>
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
<?php require("templates/layout.php") ?>