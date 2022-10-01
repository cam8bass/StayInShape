<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $errorImgFile = "";
}
?>

<?php $title = "Modifier compte" ?>
<?php ob_start() ?>

<div class="container__createClub">
  <main class="content content__createClub ">

    <form action="../../index.php?status=on&action=changePictureForm" method="POST" class="popupAccount" enctype="multipart/form-data">
      <!-- Start btn return for desk -->
      <a href="../../index.php?status=on&action=settings" class="btn header__return ">
        <svg class="header__return-icon">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
        Retour</a>
      <!-- End btn return for desk -->

      <!-- Start btn return for mob -->
      <a href="../../index.php?status=on&action=settings" class=" header__return-blue create__btn-return">

        <svg class="header__return-icon--blue">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left"></use>
        </svg>
      </a>

      <!-- End btn return for mob  -->
      <h1 class="popupAccount__title">Changement de photo de profil</h1>

      <div class="popupAccount__block">
        <input type="file" name="img" id="img" class="popupAccount__input popupAccount__input-file" />
        <div class="popupAccount__error">
          <p class="popupAccount__error-text"><?= $errorImgFile ? $errorImgFile : "" ?></p>
        </div>
      </div>
      <button type="submit" class="btn popupAccount__btn">Envoyer</button>

    </form>
  </main>
</div>
<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>