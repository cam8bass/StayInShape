<?php $title = "Profile partenaire" ?>
<?php ob_start() ?>

<div class="container__showProfil">
  <header class="header">

    <!-- Start btn return for desk -->
    <a href="../../index.php?status=on&action=displayAllPartner" class="btn header__return">
      <img src="public/img/icons/icon-left-arrow.png" alt="button return" class="header__return-icon">
      Retour</a>
    <!-- End btn return for desk -->

    <!-- Start btn return for mob -->
    <a href="../../index.php?status=on&action=displayAllPartner" class=" header__return-blue">
      <img src="public/img/icons/icon-left-arrow-blue.png" alt="button return" class="header__return-icon">
    </a>
    <!-- End btn return for mob  -->

    <img src="<?= $partnerProfile['img'] ?>" alt="picture profile" class="header__img" />
    <img src="./public/img/icons/<?= $partnerProfile['status'] === "enabled" ? "icon-active-blue.png" : "icon-inactive-blue.png" ?>" alt="icon status" class="header__icon--status" />
    <ul class="header__list">
      <li class="header__item">
        <p class="header__text">Stay in shape : <?= $partnerProfile['franchiseName'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Responsable: <?= $partnerProfile["firstName"] . ' ' . $partnerProfile['lastName'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Email : <?= $partnerProfile['email'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Type : <?= $partnerProfile['type'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Nombre de clubs : <?= $partnerProfile['attachedClub'] ? count(explode(',', $partnerProfile['attachedClub'])) : "0" ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Profile : <?= $partnerProfile['status'] === "enabled" ? "Actif" : "Désactivé" ?></p>
      </li>
    </ul>

    <div class="header__btn">

      <?php if ($partnerProfile['status'] === "enabled") : ?>
        <a href="../../index.php?status=on&action=clubCreationForm&id=<?= $partnerProfile['idPartner'] ?>" class="btn header__link">
          <img src="./public/img/icons/icon-add.png" alt="icon add" class="header__icon" />
          Ajouter</a>
      <?php endif ?>

      <a href="../../index.php?status=on&action=confirmStatusChange&id=<?= $partnerProfile['idPartner'] ?>" class="btn header__link">
        <img src="./public/img/icons/<?= $partnerProfile['status'] === "enabled" ? "icon-inactive.png" : "icon-active.png" ?>" alt="icon status" class="header__icon" />
        <?= $partnerProfile['status'] === "enabled" ? "Désactiver" : "Activer" ?></a>

      <a href="../../index.php?status=on&action=confirmDeletePartner&id=<?= $partnerProfile['idPartner'] ?>" class="btn header__link">
        <img src="./public/img/icons/icon-delete.png" alt="icon delete" class="header__icon" />
        Supprimer</a>

      <a href="../../index.php?status=on&action=info&id=<?= $partnerProfile['idPartner'] ?>" class="btn header__link">
        <img src="./public/img/icons/icon-info.png" alt="icon-info" class="header__icon" />
        Plus d'info</a>

      <!-- Start link for mob -->
      <?php if ($partnerProfile['status'] === "enabled") : ?>
        <a href="../../index.php?status=on&action=clubCreationForm&id=<?= $partnerProfile['idPartner'] ?>" class="header__link-blue">
          <img src="./public/img/icons/icon-add-blue.png" alt="icon add" class="header__icon" />
        </a>
      <?php endif ?>
      <a href="../../index.php?status=on&action=confirmStatusChange&id=<?= $partnerProfile['idPartner'] ?>" class="header__link-blue">
        <img src="./public/img/icons/<?= $partnerProfile['status'] === "enabled" ? "icon-inactive-blue.png" : "icon-active-blue.png" ?>" alt="icon disable" class="header__icon" />
      </a>
      <a href="../../index.php?status=on&action=confirmDeletePartner&id=<?= $partnerProfile['idPartner'] ?>" class="header__link-blue">
        <img src="./public/img/icons/icon-delete-blue.png" alt="icon delete" class="header__icon" />
      </a>
      <a href="../../index.php?status=on&action=info&id=<?= $partnerProfile['idPartner'] ?>" class="header__link-blue">
        <img src="./public/img/icons/icon-info-blue.png" alt="icon info" class="header__icon" />
      </a>
      <!-- End link for mob -->

    </div>
  </header>

  <main class=" content  ">
    <section class="section__club">
      <div class="club">
        <h2 class="club__heading">
          <span class="permission__heading-title">Clubs </span>
        </h2>

        <div class="list">
          <?php foreach ($allClubs as $club) : ?>
            <a href="../../index.php?status=on&action=showClubProfile&id=<?= $club['idClub'] ?>" class="list__link  ">
              <div class="list__block <?= $club['status'] === "enabled" ? "active" : "inactive" ?>">
                <img src="<?= $club['img'] ?>" alt="picture profil" class="list__img" />
                <img src="./public/img/icons/<?= $club['status'] === "enabled" ? "icon-active-blue.png" : "icon-inactive-blue.png" ?>" alt="icone status" class="list__icon list__icon-active" />
                <ul class="list__list">
                  <li class="list__item">
                    <p class="list__text">Stay in shape : <?= $club['clubName'] ?></p>
                  </li>
                  <li class="list__item">
                    <p class="list__text">Responsable: <?= $club['firstName'] . " " . $club['lastName'] ?></p>
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
                    <p class="list__text">Profile : <?= $club['status'] === 'enabled' ? "Actif" : "Désactivé" ?></p>
                  </li>
                </ul>
              </div>
            </a>
          <?php endforeach ?>
        </div>
      </div>
    </section>

  </main>
</div>



<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>