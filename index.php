<?php
require_once('src/controllers/ControllerSession.php');
require_once('src/controllers/ControllerTech.php');
require_once('src/controllers/ControllerUser.php');
require_once('src/config/config.php');

use App\controllers\ControllerSession\Session;
use App\controllers\ControllerTech\Technician;
use App\controllers\ControllerUser\User;



try {

  if (isset($_GET['status']) && isset($_GET['action'])) {

    if (($_GET['status'] === 'off') && ($_GET['action'] === 'login')) {
      // Permet de lancer la vérification du formulaire de login
      (new Session())->loginUser("location: ../../index.php?status=on&action=home", 'src/views/ViewLogin.php');
    } elseif ($_GET['status'] === "off" && $_GET['action'] === "mailConfirmCreateClub") {
      // Permet d'activer le compte d'un club 
      (new User())->verifyActivationKey();
    }

    if ($_GET['status'] === "on") {
      // Permet de démarrer la session et récupérer le profil de l'utilisateur courant
      $currentUser = (new Session())->alreadyLoggin();

      if ($currentUser) {

        //  === Section technicien ===
        if (($currentUser['type'] === 'tech') && ($currentUser['read'] === 1) && ($currentUser['write'] === 1) && $currentUser['create'] === 0) {

          if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_GET['action'] === "partnerCreationForm") {
              // Permet de lancer la vérification avant de soummettre la création d'un nouveau partenaire
              (new Technician())->techCreateProfile("confirmCreatePartner", 'src/views/viewsTech/ViewTechCreatePartner.php');
            } elseif ($_GET['action'] === "clubCreationForm") {
              // Permet de lancer la vérification avant de soummettre la création d'un nouveau club
              (new Technician())->techCreateProfile("selectPermissions", "src/views/viewsTech/ViewTechClubCreationForm.php");
            } elseif ($_GET['action'] === "confirmPermissions") {
              // Permet de récupérer les permissions checked et de rediriger vers la page de confirmation de création de permissions
              (new Technician())->techConfirmCreatePermission();
            } elseif ($_GET['action'] === "confirmModifyPermissions") {
              // Permet de rediriger vers la page de confirmation de modification de permissions
              (new Technician())->techConfirmModifyPermissions();
            } elseif ($_GET['action'] === "confirmChangeClubOwner") {
              // Permet de récupérer le nom de la nouvelle franchise responsable et de rediriger vers la page de confirmation de changement de propriétaire
              (new Technician())->techConfirmChangeClubOwner();
            } else {
              throw new Exception(ERROR_REDIRECT);
            }
          } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if ($_GET['action'] === 'home') {
              // Permet de nettoyer la session

              (new Session)->cleanSession();
              // Permet d'effectuer une recherche d'utilisateur  via la barre de recherhce 
              (new Technician())->searchUser();
              // Permet de confirmer le login si la confirmation est réussi redirection vers la page home
              require('src/views/ViewHome.php');
            } elseif ($_GET['action'] === 'logout') {
              // Permet d'afficher la page de confirmation de déconnection
              $requestType = 'logout';
              require('src/views/ViewConfirmationPage.php');
            } elseif ($_GET['action'] === 'confirmLogout') {
              // Permet de confirmer la déconnection la session 
              (new Session())->logout("location: ../../index.php");
            } elseif ($_GET['action'] === 'partnerCreationForm') {
              // Permet d'afficher la page de création de nouveau partenaire
              require('src/views/viewsTech/ViewTechCreatePartner.php');
            } elseif ($_GET['action'] === 'confirmCreatePartner') {
              // Permet d'afficher la page de confirmation de création de partenaire
              $requestType = "createPartner";
              require('src/views/ViewConfirmationPage.php');
            } elseif ($_GET['action'] === "createPartner") {
              // Permet de confirmer la création d'un nouveau partenaire
              (new Technician())->techConfirmCreatePartner();
            } elseif ($_GET['action'] === "displayAllPartner") {
              // Permet de nettoyer la session
              (new Session())->cleanSession();
              // Permet d'afficher tous les partenaires 
              (new Technician())->techDisplayAllPartners();
            } elseif ($_GET['action'] === "showPartnerProfile") {
              // Permet de nettoyer la session
              (new Session())->cleanSession();
              // Permet d'afficher la fiche du partenaire sélectionné
              (new Technician())->techShowPartnerProfile("src/views/viewsTech/ViewTechShowPartnerProfile.php");
            } elseif ($_GET['action'] === "clubCreationForm") {
              // Permet d'afficher la page de création d'un nouveau club
              (new Technician())->techShowPartnerProfile('src/views/viewsTech/ViewTechClubCreationForm.php');
            } elseif ($_GET['action'] === "selectPermissions") {
              require('src/views/viewsTech/ViewTechCreateClubPermission.php');
            } elseif ($_GET['action'] === "createClub") {
              // Permet de confirmer la création d'un nouveau club
              (new Technician())->techCreateClub();
            } elseif ($_GET['action'] === "showClubProfile") {
              // Permet de récupérer les permissions et les infos du club et d'afficher la page de son profil
              (new Technician())->techShowClubProfile("src/views/viewsTech/ViewTechShowClubProfile.php");
            } elseif ($_GET['action'] === 'modifyPermissionsForm') {
              // Permet d'afficher la page de modificaion de permissions
              (new Technician())->techShowClubProfile("src/views/viewsTech/ViewTechModifyPermissions.php");
            } elseif ($_GET['action'] === "modifyPermissions") {
              // Permet de confirmer la modification des permissions
              (new Technician())->techModifyPermissions();
            } elseif ($_GET['action'] === "displayAllClubs") {
              // Permet de nettoyer la session
              (new Session())->cleanSession();
              // Permet d'afficher tous les clubs
              (new Technician())->techDisplayAllClubs();
            } elseif ($_GET['action'] === "confirmStatusChange") {
              // Permet de confirmer le changement de status du profile
              $requestType = "statusChange";
              require('src/views/ViewConfirmationPage.php');
            } elseif ($_GET['action'] === "statusChange") {
              // Permet de modifier le status du profile
              (new Technician())->techChangeStatus();
            } elseif ($_GET['action'] === "confirmDeleteClub") {
              // Permet de confirmer la suppression d'un profile
              $requestType = "deleteProfile";
              require('src/views/ViewConfirmationPage.php');
            } elseif ($_GET['action'] === "deleteClub") {
              // Permet de supprimer un club
              (new Technician())->techDeleteClub();
            } elseif ($_GET['action'] === "confirmDeletePartner") {
              // Permet de confirmer la suppréssion du partenaire
              (new Technician())->techConfirmDeletePartner();
            } elseif ($_GET['action'] === "deletePartner") {
              // Permet de supprimer un partenaire
              (new Technician())->techDeletePartner();
            } elseif ($_GET['action'] === "changeClubOwnerForm") {
              (new Technician())->techChangeClubOwnerForm();
            } elseif ($_GET['action'] === "changeClubOwner") {
              // Permet de changer le propriétaire du club selectionné
              (new Technician())->techChangeClubOwner();
            } elseif ($_GET['action'] === 'info') {
              (new Technician())->techDisplayProfileInfo();
            } else (throw new Exception(ERROR_REDIRECT));
          }
        } elseif ($currentUser['read'] === 1 && $currentUser['write'] === 0 && $currentUser['create'] === 0) {
          //  === Section utilisateurs ===
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_GET['action'] === "changePictureForm") {
              // Accessible uniquement au compte partenaire et club
              //  Permet de lancer la vérification de la nouvelle image 
              (new User())->userChangePictureClub();
            } elseif ($_GET['action'] === "changePasswordForm") {
              // Permet de vérifier la conformité des mots de passe 
              (new User())->userChangePassword();
            } elseif ($_GET['action'] === "changeDescriptionForm") {
              // Permet de vérifier la conformité de la description
              (new User())->userChangeDescription();
            } else (throw new Exception(ERROR_REDIRECT));
          } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if ($_GET['action'] === 'home') {
              // Permet de confirmer le login si la confirmation est réussi redirection vers la page home
              require('src/views/ViewHome.php');
            } elseif ($_GET['action'] === 'logout') {
              // Permet d'afficher la page de confirmation de déconnection
              $requestType = 'logout';
              require('src/views/ViewConfirmationPage.php');
            } elseif ($_GET['action'] === 'confirmLogout') {
              // Permet de confirmer la déconnection la session 
              (new Session())->logout("location: ../../index.php");
            } elseif ($_GET['action'] === "settings") {
              // Permet d'accéder au compte de l'utilisateur
              (new User())->displayUserSettings();
            } elseif ($_GET['action'] === "changePictureForm") {
              // Permet de modifier la photo de l'utilisateur
              require('src/views/viewsUser/ViewUserChangePictureForm.php');
            } elseif ($_GET['action'] === "changePasswordForm") {
              // Permet de modifier le password de l'utilisateur
              require('src/views/viewsUser/ViewUserChangePasswordForm.php');
            } elseif ($_GET['action'] === "changeDescriptionForm") {
              // Permet de modifier la description
              (new User())->userChangeDescription();
            } elseif ($_GET['action'] === "myClubProfile") {
              // Permet d'afficher le profil de l'utilisateur club
              (new User())->displayUserProfileClub();
            } elseif ($_GET['action'] === "myPartnerProfile") {
              (new User())->displayUserProfilePartner();
            } else (throw new Exception(ERROR_REDIRECT));
          }
        } else {
          // Permet d'afficher la première page de login  s'il n'y a pas de currentUser ou que le currentUser n'est pas connu
          // Supprime la session si le currentUser n'est pas connu
          (new Session())->logout("location: ../../../index.php");
        }
      } else {
        throw new Exception(ERROR_ACCESS_DENIED);
      }
    }
  } elseif (!isset($_GET['status']) && !isset($_GET["action"])) {
    // Permet de récupérer la session de l'utilisateur pour une durée de 14 jours 
    $currentUser = (new Session())->alreadyLoggin();

    if ($currentUser) {
      header("location: ../../index.php?status=on&action=home");
    } else {
      // Permet d'afficher la page de login si aucune action est présente et si il n'y a pas de status
      require('src/views/ViewLogin.php');
    }
  }
} catch (Exception $e) {
  $errorMessage = $e->getMessage();
  require('src/views/ViewError.php');
}
