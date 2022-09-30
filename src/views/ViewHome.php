<?php if ($currentUser['type'] === 'admin') : ?>
  <script defer type="module" src="public/js/adminSearch.js"></script>
<?php elseif ($currentUser['type'] === 'tech') : ?>
  <script defer type="module" src="public/js/techSearch.js"></script>
<?php endif ?>

<?php $title = 'Home' ?>
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

    <div class="searchResults hidden">
      <button class="searchResults__btn ">
        <img src="../public/img/icons/icon-close.png" alt="icon close" class="searchResults__btn-close">
      </button>

      <div class="searchResults__block hidden"></div>
    </div>
  </main>
</div>
<?php $content = ob_get_clean(); ?>

<?php require("templates/layout.php") ?>