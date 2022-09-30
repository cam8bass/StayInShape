<?php $title = "Profile partenaire" ?>
<?php ob_start() ?>

<div class="container__showProfil">
  <header class="header">

    <!-- Start btn return for desk -->
    <a href="../../index.php?status=on&action=home" class="btn header__return">
      <svg class="header__return-icon">
        <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
          "></use>
      </svg>
      Retour</a>
    <!-- End btn return for desk -->

    <!-- Start btn return for mob -->
    <a href="../../index.php?status=on&action=home" class=" header__return-blue">

      <svg class="header__return-icon--blue">
        <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
          "></use>
      </svg>
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

  </header>

  <main class=" content  ">
    <section class="section__club">
      <div class="club">
        <h2 class="club__heading">
          <span class="permission__heading-title">Clubs </span>
        </h2>

        <div class="list">
          <?php foreach ($allClubs as $club) : ?>
            <a href="../../index.php?status=on&action=myClubProfile&id=<?= $club['idClub'] ?>" class="list__link  ">
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