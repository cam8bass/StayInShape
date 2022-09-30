<?php $title = "Profile partenaire" ?>
<?php ob_start() ?>

<div class="container__permission">
  <header class="header">

    <!-- Start btn return for desk -->
    <a href="../../index.php?status=on&action=showPartnerProfile&id=<?= $idPartnerParent ?>" class="btn header__return">
      <img src="public/img/icons/icon-left-arrow.png" alt="button return" class="header__return-icon">
      Retour</a>
    <!-- End btn return for desk -->

    <!-- Start btn return for mob -->
    <a href="../../index.php?status=on&action=showPartnerProfile&id=<?= $idPartnerParent ?>" class=" header__return-blue">
      <img src="public/img/icons/icon-left-arrow-blue.png" alt="button return" class="header__return-icon">
    </a>
    <!-- End btn return for mob  -->

    <img src="<?= $club['img'] ?>" alt="picture profile" class="header__img" />
    <img src="./public/img/icons/<?= $club['status'] === "enabled" ? "icon-active-blue.png" : "icon-inactive-blue.png" ?>" alt="icon status" class="header__icon--status" />
    <ul class="header__list">
      <li class="header__item">
        <p class="header__text">Stay in shape : <?= $club['clubName'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Responsable: <?= $club["firstName"] . ' ' . $club['lastName'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Email : <?= $club['email'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Type : <?= $club['type'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Franchise responsable: <?= $club['nameFranchiseOwner'] ?></p>
      </li>
      <li class="header__item">
        <p class="header__text">Profil : <?= $club['status'] === "enabled" ? "Actif" : "Désactivé" ?></p>
      </li>
    </ul>

    <div class="header__btn">


      <a href="" class="btn header__link">
        <img src="./public/img/icons/icon-inactive.png" alt="icon disable" class="header__icon" />
        Désactiver</a>

      <a href="" class="btn header__link">
        <img src="./public/img/icons/icon-delete.png" alt="icon delete" class="header__icon" />
        Supprimer</a>

      <a href="" class="btn header__link">
        <img src="./public/img/icons/icon-info.png" alt="icon-info" class="header__icon" />
        Plus d'infos</a>
      <!-- Start link for mob -->
      <a href="" class="header__link-blue">
        <img src="./public/img/icons/icon-add-blue.png" alt="icon add" class="header__icon" />
      </a>
      <a href="" class="header__link-blue">
        <img src="./public/img/icons/icon-inactive-blue.png" alt="icon disable" class="header__icon" />
      </a>
      <a href="" class="header__link-blue">
        <img src="./public/img/icons/icon-delete-blue.png" alt="icon delete" class="header__icon" />
      </a>
      <a href="" class="header__link-blue">
        <img src="./public/img/icons/icon-info-blue.png" alt="icon info" class="header__icon" />
      </a>
      <!-- End link for mob -->
    </div>
  </header>

  <main class="content content__permission">
    <section class="section__permission ">
      <form action="../../index.php?status=on&action=confirmModifyPermissions&id=<?= $idClub ?>" method="POST" class="permission">
        <h2 class="permission__heading">
          <span class="permission__heading-title">Permissions</span>
        </h2>

        <!-- Start Cat 1 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Comptabilité</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Logiciel comptabilité</span>
                  <input type="checkbox" id="accountingSoftware" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("accountingSoftware", $clubPermission['permissions']) ? "checked" : "" ?> value="accountingSoftware" />
                  <label for="accountingSoftware" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion de paie</span>
                  <input type="checkbox" id="payrollManagement" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("payrollManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="payrollManagement" />
                  <label for="payrollManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Logiciel gestion de caisse</span>
                  <input type="checkbox" id="cashManagementSoftware " name="permissions[] " class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("cashManagementSoftware", $clubPermission['permissions']) ? "checked" : "" ?> value="cashManagementSoftware" />
                  <label for="cashManagementSoftware " class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Aide-comptable</span>
                  <input type="checkbox" id="accountingAssistant" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("accountingAssistant", $clubPermission['permissions']) ? "checked" : "" ?> value="accountingAssistant" />
                  <label for="accountingAssistant" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion retard paiement</span>
                  <input type="checkbox" id="latePaymentManagement" name="permissions[]" class="permission__body-input" value="latePaymentManagement" <?= isset($clubPermission['permissions']) && in_array("latePaymentManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="latePaymentManagement" />
                  <label for="latePaymentManagement" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 1 -->

        <!-- Start Cat 2 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Gestion</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion des adhérents</span>
                  <input type="checkbox" id="membershipManagement " name="permissions[] " class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("membershipManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="membershipManagement" />
                  <label for="membershipManagement " class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Cloud</span>
                  <input type="checkbox" id="cloud" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("cloud", $clubPermission['permissions']) ? "checked" : "" ?> value="cloud" />
                  <label for="cloud" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Formules abonnements</span>
                  <input type="checkbox" id="subscriptionFormulas" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("subscriptionFormulas", $clubPermission['permissions']) ? "checked" : "" ?> value="subscriptionFormulas" />
                  <label for="subscriptionFormulas" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Programme fidélisation</span>
                  <input type="checkbox" id="loyaltyProgram" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("loyaltyProgram", $clubPermission['permissions']) ? "checked" : "" ?> value="loyaltyProgram" />
                  <label for="loyaltyProgram" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion multi sites</span>
                  <input type="checkbox" id="multi-siteManagement" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("multi-siteManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="multi-siteManagement" />
                  <label for="multi-siteManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion horaire accès</span>
                  <input type="checkbox" id="accessTimeManagement" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("accessTimeManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="accessTimeManagement" />
                  <label for="accessTimeManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Aide juridique</span>
                  <input type="checkbox" id="juridicalHelp" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("juridicalHelp", $clubPermission['permissions']) ? "checked" : "" ?> value="juridicalHelp" />
                  <label for="juridicalHelp" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 2 -->

        <!-- Start Cat 3 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Le personnel</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Accès planning équipe</span>

                  <input type="checkbox" id="teamPlanningAccess" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("teamPlanningAccess", $clubPermission['permissions']) ? "checked" : "" ?> value="teamPlanningAccess" />
                  <label for="teamPlanningAccess" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion planification des cours</span>
                  <input type="checkbox" id="coursePlanningManagement" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("coursePlanningManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="coursePlanningManagement" />
                  <label for="coursePlanningManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Remplacement coach</span>
                  <input type="checkbox" id="replacementCoach" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("replacementCoach", $clubPermission['permissions']) ? "checked" : "" ?> value="replacementCoach" />
                  <label for="replacementCoach" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Formation des équipes</span>
                  <input type="checkbox" id="teamTraining" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("teamTraining", $clubPermission['permissions']) ? "checked" : "" ?> value="teamTraining" />
                  <label for="teamTraining" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Aide à l'embauche</span>
                  <input type="checkbox" id="helpHiring" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("helpHiring", $clubPermission['permissions']) ? "checked" : "" ?> value="helpHiring" />
                  <label for="helpHiring" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Badge salarié</span>
                  <input type="checkbox" id="employeeBadge" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("employeeBadge", $clubPermission['permissions']) ? "checked" : "" ?> value="employeeBadge" />
                  <label for="employeeBadge" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 3 -->

        <!-- Start Cat 4 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Adhérent</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Accès application</span>

                  <input type="checkbox" id="appAccess" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("appAccess", $clubPermission['permissions']) ? "checked" : "" ?> value="appAccess" />
                  <label for="appAccess" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Cours en ligne</span>
                  <input type="checkbox" id="onlineCourse" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("onlineCourse", $clubPermission['permissions']) ? "checked" : "" ?> value="onlineCourse" />
                  <label for="onlineCourse" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Module conseil diététique</span>
                  <input type="checkbox" id="dietAdviceModule" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("dietAdviceModule", $clubPermission['permissions']) ? "checked" : "" ?> value="dietAdviceModule" />
                  <label for="dietAdviceModule" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Badge adhérent</span>
                  <input type="checkbox" id="memberBadge" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("memberBadge", $clubPermission['permissions']) ? "checked" : "" ?> value="memberBadge" />
                  <label for="memberBadge" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 4 -->

        <!-- Start Cat 5 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Réservation en ligne</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Outil de réservation en ligne</span>

                  <input type="checkbox" id="onlineBookingTool" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("onlineBookingTool", $clubPermission['permissions']) ? "checked" : "" ?> value="onlineBookingTool" />
                  <label for="onlineBookingTool" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Rappel automatique séance</span>
                  <input type="checkbox" id="autoSessionReminder" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("autoSessionReminder", $clubPermission['permissions']) ? "checked" : "" ?> value="autoSessionReminder" />
                  <label for="autoSessionReminder" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Liste d'attente / Annulation</span>
                  <input type="checkbox" id="waintingList" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("waintingList", $clubPermission['permissions']) ? "checked" : "" ?> value="waintingList" />
                  <label for="waintingList" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Info capacité réservation</span>
                  <input type="checkbox" id="bookingCapacity" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("bookingCapacity", $clubPermission['permissions']) ? "checked" : "" ?> value="bookingCapacity" />
                  <label for="bookingCapacity" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 5 -->

        <!-- Start Cat 6 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Matériels</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion des commandes</span>

                  <input type="checkbox" id="orderManagement" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("orderManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="orderManagement" />
                  <label for="orderManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Accès liste fournisseurs</span>
                  <input type="checkbox" id="supplierListAccess" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("supplierListAccess", $clubPermission['permissions']) ? "checked" : "" ?> value="supplierListAccess" />
                  <label for="supplierListAccess" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Commande équipements</span>
                  <input type="checkbox" id="equipmentOrder" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("equipmentOrder", $clubPermission['permissions']) ? "checked" : "" ?> value="equipmentOrder" />
                  <label for="equipmentOrder" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Entretien des équipements</span>
                  <input type="checkbox" id="equipmentMaintenance" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("equipmentMaintenance", $clubPermission['permissions']) ? "checked" : "" ?> value="equipmentMaintenance" />
                  <label for="equipmentMaintenance" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 6 -->

        <!-- Start Cat 7 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Vente</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Vente de boisson</span>

                  <input type="checkbox" id="saleDrinks" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("saleDrinks", $clubPermission['permissions']) ? "checked" : "" ?> value="saleDrinks" />
                  <label for="saleDrinks" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Vente article de sport</span>
                  <input type="checkbox" id="sportingGoodsSale" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("sportingGoodsSale", $clubPermission['permissions']) ? "checked" : "" ?> value="sportingGoodsSale" />
                  <label for="sportingGoodsSale" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Vente sportwear</span>
                  <input type="checkbox" id="sportswear" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("sportswear", $clubPermission['permissions']) ? "checked" : "" ?> value="sportswear" />
                  <label for="sportswear" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion stock / Commande</span>
                  <input type="checkbox" id="stockManagement" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("stockManagement", $clubPermission['permissions']) ? "checked" : "" ?> value="stockManagement" />
                  <label for="stockManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Abonnement musique</span>
                  <input type="checkbox" id="musicSubscription" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("musicSubscription", $clubPermission['permissions']) ? "checked" : "" ?> value="musicSubscription" />
                  <label for="musicSubscription" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Abonnement TV</span>
                  <input type="checkbox" id="TVSubscription" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("TVSubscription", $clubPermission['permissions']) ? "checked" : "" ?> value="TVSubscription" />
                  <label for="TVSubscription" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 7 -->

        <!-- Start Cat 8 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Notification</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification email</span>

                  <input type="checkbox" id="emailNotification" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("emailNotification", $clubPermission['permissions']) ? "checked" : "" ?> value="emailNotification" />
                  <label for="emailNotification" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification fréquentation</span>
                  <input type="checkbox" id="attendanceNotification" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("attendanceNotification", $clubPermission['permissions']) ? "checked" : "" ?> value="attendanceNotification" />
                  <label for="attendanceNotification" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification absence coach</span>
                  <input type="checkbox" id="coachAbsenceNotification" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("coachAbsenceNotification", $clubPermission['permissions']) ? "checked" : "" ?> value="coachAbsenceNotification" />
                  <label for="coachAbsenceNotification" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification chiffre d'affaires</span>
                  <input type="checkbox" id="notificationTurnover" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("notificationTurnover", $clubPermission['permissions']) ? "checked" : "" ?> value="notificationTurnover" />
                  <label for="notificationTurnover" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 8 -->

        <!-- Start Cat 9 -->
        <h3 class="permission__category">
          <span class="permission__category-title">Statistique</span>
        </h3>

        <div class="permission__block">
          <div class="permission__body">
            <ul class="permission__body-list">
              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Analyse clientèle</span>

                  <input type="checkbox" id="customerAnalysis" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) && in_array("customerAnalysis", $clubPermission['permissions']) ? "checked" : "" ?> value="customerAnalysis" />
                  <label for="customerAnalysis" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Analyse fréquentation</span>
                  <input type="checkbox" id="attendanceAnalysis" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) &&  in_array("attendanceAnalysis", $clubPermission['permissions']) ? "checked" : "" ?> value="attendanceAnalysis" />
                  <label for="attendanceAnalysis" class="permission__body-label"> </label>
                </div>
              </li>


              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Analyse heure fréquentation</span>
                  <input type="checkbox" id="timeAttendanceAnalysis" name="permissions[]" class="permission__body-input" <?= isset($clubPermission['permissions']) &&  in_array("timeAttendanceAnalysis", $clubPermission['permissions']) ? "checked" : "" ?> value="timeAttendanceAnalysis" />
                  <label for="timeAttendanceAnalysis" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 9 -->
        <button class="btn permission__submit">Modifier</button>
      </form>
    </section>
  </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>