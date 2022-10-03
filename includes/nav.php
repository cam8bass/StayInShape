<?php
$currentUser = $_SESSION['currentUser'] ?? '';
?>


<div class="navigation">

  <input type="checkbox" class="navigation__checkbox" id="navi-toggle">
  <label for="navi-toggle" class="navigation__btn">
    <span class="navigation__icon">&nbsp;</span>
  </label>
  <div class="navigation__background">&nbsp;</div>

  <!-- Start Admin nav -->
  <nav class="navigation__nav">
    <?php if ($currentUser['type'] === "admin" && $currentUser['create'] === 1) : ?>

      <ul class="navigation__list">

        <li class="navigation__item">
          <img src="./public/img/icons/icon-create.png" alt="icone add" class="navigation__icon-link" />
          <a href="../indexAdmin.php?status=on&action=add" id="adminAddAccount" class="navigation__link">Ajouter compte</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-delete-1.png" alt="icone delete" class="navigation__icon-link" />
          <a href="../indexAdmin.php?status=on&action=delete" class="navigation__link">
            Supprimer compte</a>
        </li>

        <li class="navigation__item">
          <img src="public/img/icons/icon-help.png" alt="icone help" class="navigation__icon-link">
          <a href="../../indexAdmin.php?status=on&action=help" class="navigation__link">Manuel d'utilisation</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-logout.png" alt="icone logout" class="navigation__icon-link" />
          <a href="../indexAdmin.php?status=on&action=logout" class="navigation__link"> Déconnection</a>
        </li>

      </ul>
      <!-- End Admin nav -->

      <!-- Start techn nav -->
    <?php elseif ($currentUser['type'] === "tech" && $currentUser['write'] === 1 && $currentUser['read'] === 1 && $currentUser['create'] === 0) : ?>

      <ul class="navigation__list">
        <li class="navigation__item">
          <img src="./public/img/icons/icon-partner.png" alt="icone partner" class="navigation__icon-link" />
          <a href="../index.php?status=on&action=displayAllPartner" class="navigation__link"> Gérer franchises</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-structure.png" alt="icone structure" class="navigation__icon-link" />
          <a href="../index.php?status=on&action=displayAllClubs" class="navigation__link"> Gérer les clubs</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-create.png" alt="icone create" class="navigation__icon-link" />
          <a href="../index.php?status=on&action=partnerCreationForm" class="navigation__link"> Nouvelle franchise</a>
        </li>

        <li class="navigation__item">
          <img src="public/img/icons/icon-help.png" alt="icone help" class="navigation__icon-link">
          <a href="../../index.php?status=on&action=help" class="navigation__link">Manuel d'utilisation</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-logout.png" alt="icone logout" class="navigation__icon-link" />
          <a href="../index.php?status=on&action=logout" class="navigation__link"> Déconnection</a>
        </li>

      </ul>
      <!-- End tech nav -->

      <!-- Start user nav -->
    <?php elseif (($currentUser['type'] === "Partner" || $currentUser['type'] === "Club") && $currentUser["read"] === 1 && $currentUser['write'] === 0 && $currentUser['create'] === 0) : ?>

      <ul class="navigation__list">

        <li class="navigation__item">
          <img src="./public/img/icons/icon-profil.png" alt="icone create" class="navigation__icon-link" />
          <a href="<?= $currentUser['type'] === "Club" ? "../index.php?status=on&action=myClubProfile" : "../index.php?status=on&action=myPartnerProfile" ?>" class="navigation__link">Mon profil</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-setting.png" alt="icone create" class="navigation__icon-link" />
          <a href="../index.php?status=on&action=settings" class="navigation__link">Réglages</a>
        </li>

        <li class="navigation__item">
          <img src="public/img/icons/icon-help.png" alt="icone help" class="navigation__icon-link">
          <a href="../../index.php?status=on&action=help" class="navigation__link">Manuel d'utilisation</a>
        </li>

        <li class="navigation__item">
          <img src="./public/img/icons/icon-logout.png" alt="icone logout" class="navigation__icon-link" />
          <a href="../index.php?status=on&action=logout" class="navigation__link"> Déconnection</a>
        </li>

      </ul>

      <!-- End user nav -->
    <?php endif ?>
  </nav>

</div>