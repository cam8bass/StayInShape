<script defer type="module" src="public/js/controller.js"></script>

<?php $title = "Recherche de club"; ?>

<?php ob_start() ?>
<div class="container__index">

  <div class="sideBar">
    <?php require_once('./includes/home.php'); ?>
    <?php require_once('./includes/nav.php'); ?>
  </div>

  <main class="content content__search">
    <div class="list__filter">

      <button type="button" class="list__filter-btn" id="active-club">
        <img src="./public/img/icons/icon-active-blue.png" alt="icon active" class="list__filter-icon">
      </button>

      <button type="button" class="list__filter-btn" id="inactive-club">
        <img src="./public/img/icons/icon-inactive-blue.png" alt="icon inactive" class="list__filter-icon">
      </button>

      <button type="button" class="list__filter-btn" id="all-club">
        <img src="./public/img/icons/icon-group-blue.png" alt="icon-all" class="list__filter-icon">
      </button>

    </div>
    <div class="list">
      <?php foreach ($allClubs as $club) : ?>
        <a href="../../index.php?status=on&action=showClubProfile&id=<?= $club['idClub'] ?>" class="list__link">
          <div class="list__block  <?= $club['status'] === 'enabled' ? "active" : "inactive" ?>">
            <img src="<?= $club['img'] ?>" alt=" picture profile" class="list__img" />
            <img src="./public/img/icons/<?= $club['status'] === "enabled" ? "icon-active-blue.png" : "icon-inactive-blue.png" ?>" alt="icone status" class="list__icon list__icon-active" />
            <ul class="list__list">
              <li class="list__item">
                <p class="list__text">Stay in shape : <?= $club['clubName'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Responsable: <?= $club['firstName'] . ' '  . $club['lastName'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Email : <?= $club['email'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Type : <?= $club['type'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Franchise responsable : <?= $club['nameFranchiseOwner'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Profil : <?= $club['status'] === 'enabled' ? "Actif" : "Désactivé" ?></p>
              </li>
            </ul>
          </div>
        </a>
      <?php endforeach ?>
    </div>
  </main>
</div>

<?php $content = ob_get_clean() ?>

<?php require('templates/layout.php');
