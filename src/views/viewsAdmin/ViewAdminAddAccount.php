<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $errorAdminAddAccount = [
    "errorFirstName" => '',
    'errorLastName' => '',
    'errorEmail' => '',
  ];

  $lastName = "";
  $firstName = "";
  $email = '';
}
?>

<?php $title = "Créer un compte" ?>

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

    <form action="../../indexAdmin.php?status=on&action=confirmAdd" method="post" id="createFranchise" class="create">
      <h1 class="create__title">Créer un compte</h1>

      <div class="create__block">
        <label for="lastName" class="create__label">Nom</label>
        <input type="text" name="lastName" id="lastName" class="create__input" value="<?= !$errorAdminAddAccount['errorLastName'] ? $lastName : '' ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorAdminAddAccount['errorLastName'] ? $errorAdminAddAccount['errorLastName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="firstName" class="create__label">Prénom</label>
        <input type="text" name="firstName" id="firstName" class="create__input" value="<?= !$errorAdminAddAccount['errorFirstName'] ? $firstName : '' ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorAdminAddAccount['errorFirstName'] ? $errorAdminAddAccount['errorFirstName'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="email" class="create__label">Adresse email</label>
        <input type="email" name="email" id="email" class="create__input" value="<?= !$errorAdminAddAccount['errorEmail'] ? $email : '' ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorAdminAddAccount['errorEmail'] ? $errorAdminAddAccount['errorEmail'] : ""  ?></p>
        </div>
      </div>

      <button type="submit" class="btn create__btn">Créer</button>
    </form>
  </main>
</div>

<?php $content = ob_get_clean() ?>

<?php require("templates/layout.php") ?>

