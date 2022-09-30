<?php $title = "Changement propriétaire" ?>
<?php ob_start() ?>

<div class="container__createClub">

    <main class="content  content__createClub">

      <div class="brand">
        <img src="./public/img/logo.png" alt="logo" class="brand__logo" />
        <h1 class="brand__title">Stay in shape</h1>
      </div>

      <form action="../../index.php?status=on&action=confirmChangeClubOwner&id=<?= $idClub ?>" method="post" id="createClub" class="create">
        <!-- Start btn return for desk -->
        <a href="../../index.php?status=on&action=showClubProfile&id=<?= $idClub ?>" class="btn header__return">
          <svg class="header__return-icon">
            <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
          </svg>
          Retour</a>
        <!-- End btn return for desk -->

        <!-- Start btn return for mob -->
        <a href="../../index.php?status=on&action=showClubProfile&id=<?= $idClub ?>" class=" header__return-blue">
          <svg class="header__return-icon--blue">
            <use xlink:href="./public/img/svg/sprite.svg#icon-long-arrow-left
                 "></use>
          </svg>
        </a>
        <!-- End btn return for mob  -->
        <h1 class="create__title">Créer un club</h1>

        <div class="create__block">
          <label for="lastName" class="create__label">Nouveau propriétaire</label>
          <select name="newOwner" id="newOwner" class="create__input-owner">
            <?php foreach ($allFranchiseNames as $franchiseName) : ?>
              <option value="<?= $franchiseName['franchiseName'] ?>"><?= $franchiseName['franchiseName'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <button type="submit" class="btn create__btn">Suivant</button>
      </form>
      
    </main>






</div>



<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>