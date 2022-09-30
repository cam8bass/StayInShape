<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
  $errorDescription = "";
}
?>

<?php $title = "Modifier description" ?>
<?php ob_start() ?>

<div class="container__createClub">
  <main class="content content__createClub ">

    <form action="../../index.php?status=on&action=changeDescriptionForm" method="POST" class="popupAccount">

      <!-- Start btn return for desk -->
      <a href="../../index.php?status=on&action=settings" class="btn header__return">
        <svg class="header__return-icon">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
        Retour</a>
      <!-- End btn return for desk -->

      <!-- Start btn return for mob -->
      <a href="../../index.php?status=on&action=settings" class=" header__return-blue">

        <svg class="header__return-icon--blue">
          <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
        </svg>
      </a>
      <h1 class="popupAccount__title">Description du profil</h1>

      <div class="popupAccount__block">
        <label for="description" class="popupAccount__label">Nouvelle description : </label>
        <textarea name="description" id="description" class="popupAccount__description"><?= $oldDescription['description'] ? $oldDescription['description'] : "" ?></textarea>
        <div class="popupAccount__error">
          <p class="popupAccount__error-text"><?= $errorDescription ? $errorDescription : "" ?></p>
        </div>
      </div>
      <button type="submit" class="btn popupAccount__btn">Envoyer</button>
    </form>

  </main>

</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php'); ?>