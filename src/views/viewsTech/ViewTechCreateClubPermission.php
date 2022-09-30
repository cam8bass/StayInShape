
<?php $title = "Permissions" ?>
<?php ob_start() ?>

<div class="container__permission">
  <main class="content content__permission">
    <section class="section__permission ">
      
      <form action="../../index.php?status=on&action=confirmPermissions" method="post" id="asignPermission" class="permission">
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

                  <input type="checkbox" id="accountingSoftware" name="permissions[]" class="permission__body-input" value="accountingSoftware" />
                  <label for="accountingSoftware" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion de paie</span>
                  <input type="checkbox" id="payrollManagement" name="permissions[]" class="permission__body-input" value="payrollManagement" />
                  <label for="payrollManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Logiciel gestion de caisse</span>
                  <input type="checkbox" id="cashManagementSoftware " name="permissions[] " class="permission__body-input" value="cashManagementSoftware" />
                  <label for="cashManagementSoftware " class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Aide-comptable</span>
                  <input type="checkbox" id="accountingAssistant" name="permissions[]" class="permission__body-input" value="accountingAssistant" />
                  <label for="accountingAssistant" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion retard paiement</span>
                  <input type="checkbox" id="latePaymentManagement" name="permissions[]" class="permission__body-input" value="latePaymentManagement" />
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
                  <input type="checkbox" id="membershipManagement " name="permissions[] " class="permission__body-input" value="membershipManagement" />
                  <label for="membershipManagement " class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Cloud</span>
                  <input type="checkbox" id="cloud" name="permissions[]" class="permission__body-input" value="cloud" />
                  <label for="cloud" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Formules abonnements</span>
                  <input type="checkbox" id="subscriptionFormulas" name="permissions[]" class="permission__body-input" value="subscriptionFormulas" />
                  <label for="subscriptionFormulas" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Programme fidélisation</span>
                  <input type="checkbox" id="loyaltyProgram" name="permissions[]" class="permission__body-input" value="loyaltyProgram" />
                  <label for="loyaltyProgram" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion multi sites</span>
                  <input type="checkbox" id="multi-siteManagement" name="permissions[]" class="permission__body-input" value="multi-siteManagement" />
                  <label for="multi-siteManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion horaire accès</span>
                  <input type="checkbox" id="accessTimeManagement" name="permissions[]" class="permission__body-input" value="accessTimeManagement" />
                  <label for="accessTimeManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Aide juridique</span>
                  <input type="checkbox" id="juridicalHelp" name="permissions[]" class="permission__body-input" value="juridicalHelp" />
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

                  <input type="checkbox" id="teamPlanningAccess" name="permissions[]" class="permission__body-input" value="teamPlanningAccess" />
                  <label for="teamPlanningAccess" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion planification des cours</span>
                  <input type="checkbox" id="coursePlanningManagement" name="permissions[]" class="permission__body-input" value="coursePlanningManagement" />
                  <label for="coursePlanningManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Remplacement coach</span>
                  <input type="checkbox" id="replacementCoach" name="permissions[]" class="permission__body-input" value="replacementCoach" />
                  <label for="replacementCoach" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Formation des équipes</span>
                  <input type="checkbox" id="teamTraining" name="permissions[]" class="permission__body-input" value="teamTraining" />
                  <label for="teamTraining" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Aide à l'embauche</span>
                  <input type="checkbox" id="helpHiring" name="permissions[]" class="permission__body-input" value="helpHiring" />
                  <label for="helpHiring" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Badge salarié</span>
                  <input type="checkbox" id="employeeBadge" name="permissions[]" class="permission__body-input" value="employeeBadge" />
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

                  <input type="checkbox" id="appAccess" name="permissions[]" class="permission__body-input" value="appAccess" />
                  <label for="appAccess" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Cours en ligne</span>
                  <input type="checkbox" id="onlineCourse" name="permissions[]" class="permission__body-input" value="onlineCourse" />
                  <label for="onlineCourse" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Module conseil diététique</span>
                  <input type="checkbox" id="dietAdviceModule" name="permissions[]" class="permission__body-input" value="dietAdviceModule" />
                  <label for="dietAdviceModule" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Badge adhérent</span>
                  <input type="checkbox" id="memberBadge" name="permissions[]" class="permission__body-input" value="memberBadge" />
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

                  <input type="checkbox" id="onlineBookingTool" name="permissions[]" class="permission__body-input" value="onlineBookingTool" />
                  <label for="onlineBookingTool" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Rappel automatique séance</span>
                  <input type="checkbox" id="autoSessionReminder" name="permissions[]" class="permission__body-input" value="autoSessionReminder" />
                  <label for="autoSessionReminder" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Liste d'attente / Annulation</span>
                  <input type="checkbox" id="waintingList" name="permissions[]" class="permission__body-input" value="waintingList" />
                  <label for="waintingList" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Info capacité réservation</span>
                  <input type="checkbox" id="bookingCapacity" name="permissions[]" class="permission__body-input" value="bookingCapacity" />
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

                  <input type="checkbox" id="orderManagement" name="permissions[]" class="permission__body-input" value="orderManagement" />
                  <label for="orderManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Accès liste fournisseurs</span>
                  <input type="checkbox" id="supplierListAccess" name="permissions[]" class="permission__body-input" value="supplierListAccess" />
                  <label for="supplierListAccess" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Commande équipements</span>
                  <input type="checkbox" id="equipmentOrder" name="permissions[]" class="permission__body-input" value="equipmentOrder" />
                  <label for="equipmentOrder" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Entretien des équipements</span>
                  <input type="checkbox" id="equipmentMaintenance" name="permissions[]" class="permission__body-input" value="equipmentMaintenance" />
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

                  <input type="checkbox" id="saleDrinks" name="permissions[]" class="permission__body-input" value="saleDrinks" />
                  <label for="saleDrinks" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Vente article de sport</span>
                  <input type="checkbox" id="sportingGoodsSale" name="permissions[]" class="permission__body-input" value="sportingGoodsSale" />
                  <label for="sportingGoodsSale" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Vente sportwear</span>
                  <input type="checkbox" id="sportswear" name="permissions[]" class="permission__body-input" value="sportswear" />
                  <label for="sportswear" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Gestion stock / Commande</span>
                  <input type="checkbox" id="stockManagement" name="permissions[]" class="permission__body-input" value="stockManagement" />
                  <label for="stockManagement" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Abonnement musique</span>
                  <input type="checkbox" id="musicSubscription" name="permissions[]" class="permission__body-input" value="musicSubscription" />
                  <label for="musicSubscription" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Abonnement TV</span>
                  <input type="checkbox" id="TVSubscription" name="permissions[]" class="permission__body-input" value="TVSubscription" />
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

                  <input type="checkbox" id="emailNotification" name="permissions[]" class="permission__body-input" value="emailNotification" />
                  <label for="emailNotification" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification fréquentation</span>
                  <input type="checkbox" id="attendanceNotification" name="permissions[]" class="permission__body-input" value="attendanceNotification" />
                  <label for="attendanceNotification" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification absence coach</span>
                  <input type="checkbox" id="coachAbsenceNotification" name="permissions[]" class="permission__body-input" value="coachAbsenceNotification" />
                  <label for="coachAbsenceNotification" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Notification chiffre d'affaires</span>
                  <input type="checkbox" id="notificationTurnover" name="permissions[]" class="permission__body-input" value="notificationTurnover" />
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

                  <input type="checkbox" id="customerAnalysis" name="permissions[]" class="permission__body-input" value="customerAnalysis" />
                  <label for="customerAnalysis" class="permission__body-label"> </label>
                </div>
              </li>

              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Analyse fréquentation</span>
                  <input type="checkbox" id="attendanceAnalysis" name="permissions[]" class="permission__body-input" value="attendanceAnalysis" />
                  <label for="attendanceAnalysis" class="permission__body-label"> </label>
                </div>
              </li>


              <li class="permission__body-item">
                <div class="permission__body-line">
                  <span class="permission__body-text">Analyse heure fréquentation</span>
                  <input type="checkbox" id="timeAttendanceAnalysis" name="permissions[]" class="permission__body-input" value="timeAttendanceAnalysis" />
                  <label for="timeAttendanceAnalysis" class="permission__body-label"> </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End Cat 9 -->
        <button type="submit" class="btn permission__submit">Créer</button>
      </form>
    </section>
</div>

</main>
</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php');
