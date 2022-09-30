<?php $currentUser = $_SESSION['currentUser'] ?? ""; ?>

<?php $title = "Erreur" ?>
<?php ob_start() ?>

<div class="container__index">
  <main class="content content__index content__popup">
    <div class="popup">
      <h1 class="popup__title">Erreur</h1>
      <p class="popup__text"><?= $errorMessage . ", page introuvable" ?></p>
      <div class="error__btn">
        <?php if ($currentUser) : ?>
          <a href="../../index.php?status=on&action=home" class="btn error__link">Fermer</a>
        <?php else : ?>
          <a href="../../index.php" class="btn error__link">Fermer</a>
        <?php endif ?>
      </div>
    </div>
  </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>