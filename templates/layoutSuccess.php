<?php $title  ?>

<?php ob_start(); ?>

<div class="container__index">
  <main class="content content__index content__popup">

    <div class="popup">
      <h1 class="popup__title"><?= $popupTitle; ?></h1>
      <p class="popup__text">
        <?= $popupText; ?>
      </p>
      <div class="popup__btn ">
        <a href="<?= $popupLinkAgree; ?>" class="btn popup__btn-agree">Retour</a>
      </div>
    </div>
  </main>
</div>

<?php $content = ob_get_clean(); ?>

<?php require("templates/layout.php") ?>