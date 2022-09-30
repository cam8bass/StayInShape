<script defer type="module" src="public/js/controller.js"></script>
<?php $title = "Recherche de partenaire"; ?>

<?php ob_start() ?>
<div class="container__index">
  <div class="sideBar">
    <?php require_once('./includes/home.php'); ?>
    <?php require_once('./includes/nav.php'); ?>
  </div>

  <main class="content content__search">

    <div class="list__filter">
      <button type="button" class="list__filter-btn" id="active-partner">
        <img src="./public/img/icons/icon-active-blue.png" alt="icon active" class="list__filter-icon">
      </button>

      <button type="button" class="list__filter-btn" id="inactive-partner">
        <img src="./public/img/icons/icon-inactive-blue.png" alt="icon inactive" class="list__filter-icon">
      </button>

      <button type="button" class="list__filter-btn" id="all-partner">
        <img src="./public/img/icons/icon-group-blue.png" alt="icon-all" class="list__filter-icon">
      </button>
    </div>

    <div class="list">
      <?php foreach ($allPartners as $partner) : ?>
        <a href="../../index.php?status=on&action=showPartnerProfile&id=<?= $partner['idPartner'] ?>" class="list__link">
          <div class="list__block  <?= $partner['status'] === 'enabled' ? "active" : "inactive" ?>">
            <img src="<?= $partner['img'] ?>" alt=" picture profile" class="list__img" />
            <img src="./public/img/icons/<?= $partner['status'] === "enabled" ? "icon-active-blue.png" : "icon-inactive-blue.png" ?>" alt="icone status" class="list__icon list__icon-active" />
            <ul class="list__list">
              <li class="list__item">
                <p class="list__text">Stay in shape : <?= $partner['franchiseName'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Responsable: <?= $partner['firstName'] . ' '  . $partner['lastName'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Email : <?= $partner['email'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Type : <?= $partner['type'] ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Nombre de clubs : <?= $partner['attachedClub'] ? count(explode(',', $partner['attachedClub'])) : "0" ?></p>
              </li>
              <li class="list__item">
                <p class="list__text">Profil : <?= $partner['status'] === 'enabled' ? "Actif" : "Désactivé" ?></p>
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
