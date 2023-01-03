<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $errorTypeLogin = [
    "errorEmail" => '',
    'errorPassword' => ''
  ];

  $errorUserLogin = [
    'errorEmail' => '',
    'errorPassword' => ''
  ];

  $errorIfUserAccount = [
    'errorEmail' => '',
    'errorPassword' => ''
  ];



  $email = "";
}

?>
<?php $title = "Connexion Administrateur" ?>
<?php ob_start() ?>

<div class="container__index">

  <div class="sideBar">
    <form action="../../../indexAdmin.php?status=off&action=login" method="post" id="login" class="login">
      <h1 class="login__title">Mode administrateur</h1>

      <div class="login__block">
        <label for="email" class="login__label">Adresse email</label>
        <input type="email" name="email" id="email" class="login__input" value="<?= !$errorTypeLogin['errorEmail'] && !$errorIfUserAccount['errorEmail'] ? $email : '' ?>" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorTypeLogin['errorEmail'] ? $errorTypeLogin['errorEmail'] : ""  ?></p>
          <p class="login__error-text"><?= $errorUserLogin['errorEmail'] ? $errorUserLogin['errorEmail'] : "" ?></p>
          <p class="login__error-text"><?= $errorIfUserAccount['errorEmail'] ? $errorIfUserAccount['errorEmail'] : "" ?></p>
        </div>
      </div>

      <div class="login__block">
        <label for="password" class="login__label">Mot de passe</label>
        <input type="password" name="password" id="password" class="login__input" />
        <div class="login__error">
          <p class="login__error-text"><?= $errorTypeLogin['errorPassword'] ? $errorTypeLogin['errorPassword'] : "" ?></p>
          <p class="login__error-text"><?= $errorUserLogin['errorPassword'] ? $errorUserLogin['errorPassword'] : "" ?></p>
        </div>
      </div>

      <button type="submit" class="btn login__btn">Connexion</button>
    </form>
  </div>

  <main class="content content__index">
    <div class="brand">
      <img src="./public/img/logo.png" alt="logo" class="brand__logo" />
      <h1 class="brand__title">Stay in shape</h1>
    </div>
  </main>

</div>

<?php $content = ob_get_clean(); ?>
<?php require("templates/layout.php") ?>