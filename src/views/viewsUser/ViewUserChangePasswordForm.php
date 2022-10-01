<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
  $errorChangePassword = [
    "errorOldPassword" => "",
    "errorNewPassword" => ""
  ];
}
?>

<?php $title = "Modifier password" ?>
<?php ob_start() ?>

<div class="container__createClub">
  <main class="content content__createClub ">

    <form action="../../index.php?status=on&action=changePasswordForm" method="POST" class="create" enctype="multipart/form-data">
      <!-- Start btn return for desk -->
      <a href="../../index.php?status=on&action=settings" class="btn header__return create__btn-return">
        <svg class="header__return-icon">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
        Retour</a>
      <!-- End btn return for desk -->

      <!-- Start btn return for mob -->
      <a href="../../index.php?status=on&action=settings" class=" header__return-blue create__btn-return">

        <svg class="header__return-icon--blue">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
      </a>

      <!-- End btn return for mob  -->
      <h1 class="create__title">Changement du mot de passe</h1>

      <div class="create__block">
        <label for="oldPassword" class="create__label">Ancien mot de passe</label>
        <input type="password" name="oldPassword" id="oldPassword" class="create__input">
        <div class="login__error">
          <p class="login__error-text"><?= $errorChangePassword['errorOldPassword'] ? $errorChangePassword['errorOldPassword'] : ""  ?></p>
        </div>
      </div>

      <div class="create__block">
        <label for="newPassword" class="create__label">Nouveau mot de passe</label>
        <input type="password" name="newPassword" id="newPassword" class="create__input">
        <div class="login__error">
          <p class="login__error-text"><?= $errorChangePassword['errorNewPassword'] ? $errorChangePassword['errorNewPassword'] : ""  ?></p>
        </div>
      </div>

      <button type="submit" class="btn create__btn">Envoyer</button>
    </form>
  </main>
</div>
<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>