<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $errorTypeDelete = [
    'errorEmail' => ''
  ];

  $errorUserDelete = [
    'errorEmail' => ''
  ];
}

?>

<?php $title = 'Suppression de compte'; ?>
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

    <form action="../../indexAdmin.php?status=on&action=delete" method="post" id="createFranchise" class="create">
      <h1 class="create__title">Supprimer un compte</h1>

      <div class="create__block">
        <label for="email" class="create__label">Adresse email</label>
        <input type="email" name="email" id="email" class="create__input" />
        <div class="login__error">
          <p class="login__error-text"><?= ($errorTypeDelete['errorEmail'] ? $errorTypeDelete['errorEmail'] : '')  ?></p>
        </div>
        <div class="login__error">
          <p class="login__error-text"><?= ($errorUserDelete['errorEmail'] ? $errorUserDelete['errorEmail'] : '') ?></p>
        </div>
      </div>

      <button type="submit" class="btn create__btn">Supprimer</button>
    </form>
    
  </main>
</div>

<?php $content = ob_get_clean() ?>

<?php require("templates/layout.php") ?>



