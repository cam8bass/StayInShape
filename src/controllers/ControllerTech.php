<?php

namespace App\controllers\ControllerTech;

require_once('src/lib/Database.php');
require_once('src/models/ModelTech.php');
require_once('src/models/ModelSession.php');
require_once('src/models/ModelErrorManagement.php');
require_once('src/config/config.php');
require_once('src/config/mail.php');
require_once('src/views/viewsTech/ViewsMail.php');


use App\lib\Database\DatabaseConnection;
use App\models\ModelTech\ModelTech;
use App\models\ModelSession\ModelSession;
use App\models\ModelErrorManagement\ErrorManagement;
use App\views\viewsTech\ViewsMail\ViewsMail;
use App\congig\Mail\Mail;

use Exception;

class Technician
{
  function __construct()
  {
    $this->dbh = new DatabaseConnection();
    $this->modelTech = new ModelTech();
    $this->modelTech->dbh = $this->dbh;
    $this->modelSession = new modelSession();
    $this->modelSession->dbh = $this->dbh;
    $this->errorManagement = new ErrorManagement();
    $this->mail = new Mail();
    $this->viewMail = new ViewsMail();
  }

  public function techCreateProfile(string $action, string $locationFailed)
  {
    // Permet de récupérer l'id du profile si il existe dans l'url
    $partnerProfile['idPartner'] = $_GET['id'] ?? '';
    // Permet de vérifier les inputs de création d'un profile'
    $allInput = $this->modelTech->checkAllInputCreateProfile($_POST);
    $lastName = $allInput['lastName'] ?? '';
    $firstName = $allInput['firstName'] ?? '';
    $email = $allInput['email'] ?? '';
    $compagnyName = $allInput['compagnyName'] ?? '';
    //  Permet de vérifier si l'adresse email est déjà utilisée
    $userAlreadyCreate = $this->modelSession->retrieveUserWithEmail($email);
    // Permet de vérifier la conformité des inputs
    $errorCreateProfile = $this->errorManagement->checkErrorCreateProfile($allInput, $userAlreadyCreate);

    if (empty(array_filter($errorCreateProfile, fn ($el) => $el !== ''))) {
      $_SESSION['createProfile'] = $allInput;
      header("location: ../../../index.php?status=on&action=$action");
    } else {
      require($locationFailed);
    }
  }

  public function techConfirmCreatePartner()
  {
    // Permet de récupérer le compte de l'utilisateur en cours de création
    $newPartner = $_SESSION['createProfile'] ?? [];
    if ($newPartner) {
      // Permet de nettoyer la session
      unset($_SESSION['createProfile']);
      // Permet de générer un mot de passe pour le compte;
      $passwordGenerated = $this->modelTech->createRandomPassword(12);
      $passwordHash = password_hash($passwordGenerated, PASSWORD_ARGON2I);
      if (password_verify($passwordGenerated, $passwordHash)) {
        // Permet d'ajouter le password généré au compte en cours de création
        $newPartner["password"] = $passwordHash;
        $requestType = 'copyPassword';
        // Permet de créer le compte utilisateur et de récupérer l'id user du compte crée
        $idProfile = $this->modelTech->createUser($newPartner, "Partner");
        // Permet de remplir le profil du nouveau partenaire
        $this->modelTech->createPartner($idProfile, $newPartner);
        // Permet de générer la page success 
        require('src/views/ViewSuccessPage.php');
      }
    } else throw new Exception(ERROR_REDIRECT);
  }

  public function techCreateClub()
  {
    // Permet de récupérer l'id de la franchise
    $idProfileParent = $_SESSION['idPartnerParent'] ?? '';
    // Permet de récupérer les info du club en cours de création
    $newClub = $_SESSION['createProfile'] ?? [];

    if ($newClub) {
      // Permet de récupérer les permissions cochées du club 
      $clubPermissions = $_SESSION['allPermissions'] ?? [];
      //Permet de récupérer le nom de la franchise parent
      $profileParent = $this->modelTech->retrievePartnerWithId($idProfileParent);
      $newClub['nameFranchiseOwner'] = $profileParent['franchiseName'];
      $newClub['idPartnerParent'] = $idProfileParent;
      // Permet de nettoyer la session
      unset($_SESSION['idPartnerParent']);
      unset($_SESSION['createProfile']);
      unset($_SESSION['allPermissions']);
      // Permet de générer un mot de passe pour le compte;
      $passwordGenerated = $this->modelTech->createRandomPassword(12);
      $passwordHash = password_hash($passwordGenerated, PASSWORD_ARGON2I);
      //Permet de générer une clé d'activation 
      $activationKey = bin2hex(random_bytes(10));

      if (password_verify($passwordGenerated, $passwordHash)) {
        // Permet d'ajouter le password généré au compte en cours de création
        $newClub["password"] = $passwordHash;
        // Permet de créer le compte utilisateur et de récupérer l'id user du compte crée
        $idClub = $this->modelTech->createUser($newClub, "Club");
        // Permet d'envoyer l'email de confirmation de compte
        $messageMail = $this->mail->sendMail($profileParent["email"], SUBJECT_CREATE_CLUB, $this->viewMail->mailCreateClub($newClub['compagnyName'], $idClub, $clubPermissions, $activationKey));

        if ($messageMail) {
          // Permet de créer le fichier permission.json et de le remplir avec les permission 
          $idPermission = $this->modelTech->createPermissionsFile($clubPermissions) ?? time();
          // Permet de remplir le profil de l'utilisateur et de l'envoyer à la Bdd
          $this->modelTech->createClub($idClub, $newClub, $idPermission, $activationKey);
          //  Récupère le nom des clubs déjà rattaché au partner parent
          $attachedClub = $this->modelTech->retrieveAttachedClubToPartner($profileParent['idPartner']);
          $idNewAttachedClub = $attachedClub['attachedClub'] === "" ? $idClub  : implode(',', [$attachedClub['attachedClub'], $idClub]);
          // Permet de mettre à jour le nom des clubs au partner parent
          $this->modelTech->addClubToParentPartner($profileParent['idPartner'],  $idNewAttachedClub);
          $requestType = 'copyPasswordClub';
        } else {
          // En cas de problème lors de la création du compte les données sont supprimées
          $requestType = "errorSendMail";
          $messageMail = ERROR_SEND_MAIL;
          $this->modelTech->deleteUser($idClub);
        }

        // Permet de générer la page success 
        require("src/views/ViewSuccessPage.php");
      }
    } else throw new Exception(ERROR_REDIRECT);
  }

  public function techDisplayProfileInfo()
  {
    // Permet de récupérer le type d'utilisateur
    $userType = $_SESSION['profileType'] ?? '';
    // Permet de récupérer l'id de l'utilisateur
    $idUrl = $_GET['id'] ?? "";
    $idClub = $_SESSION['idClub'] ?? "";
    $idPartner = $_SESSION['idPartner'] ?? '';
    if ($idUrl == $idClub || $idUrl == $idPartner) {
      // Permet de récupérer le profil de l'utilisateur
      $userProfile = $this->modelTech->retrieveUserProfile($userType, $idUrl);
      require('src/views/ViewProfileInfo.php');
    } else {
      throw new Exception("L'utilisateur ne correspond pas à votre demande");
    }
  }

  public function techDisplayAllPartners()
  {
    // Permet de récupérer le profile de tous les partenaires
    $allPartners = $this->modelTech->selectAllPartners();
    $_SESSION['allPartner'] = $allPartners ?? [];
    require('src/views/viewsTech/ViewTechDisplayAllPartners.php');
  }

  public function techDisplayAllClubs()
  {
    // Permet de récupérer le profile de tous les clubs
    $allClubs = $this->modelTech->selectAllClubs();
    $_SESSION['allClubs'] = $allClubs ?? [];
    require('src/views/viewsTech/ViewTechDisplayAllClubs.php');
  }

  public function techShowPartnerProfile($location)
  {
    // Permet de récupérer l'id du partenaire sélectionné dans l'url
    $idProfile = $_GET['id'] ?? '';
    $_SESSION['idPartnerParent'] = $idProfile;
    // Permet de récupérer le profil du partenaire grâce à son id de profile
    $partnerProfile = $this->modelTech->retrievePartnerWithId($idProfile);
    if ($partnerProfile) {
      $_SESSION['idPartner'] = $partnerProfile['idPartner'];
      // Permet de mémoriser le type de profile
      $_SESSION['profileType'] = $partnerProfile['type'];
      //Permet de récupérer les clubs rattaché au partenaire
      $allClubs = $this->modelTech->retrieveAllClubsAssociatedWithPartner($partnerProfile['franchiseName']);
      require($location);
    } else {
      throw new Exception("L'utilisateur n'existe pas");
    }
  }

  public function techShowClubProfile(string $location)
  {
    // Permet de récupérer l'id du partenaire sélectionné dans l'url
    $idClub = $_GET['id'] ?? '';
    // Permet de récupérer lid du partenaire parent
    $idPartnerParent = $_SESSION['idPartnerParent'] ?? "";
    // Permet de récupérer le profil du club
    $club = $this->modelTech->retrieveClubWithIdClub($idClub);

    if ($club) {
      $_SESSION["idClub"] = $idClub;
      // Permet de mémoriser le type de profile
      $_SESSION["profileType"] = $club['type'];
      // Permet de récupérer les permissions du club selectionné
      $clubPermission = $this->modelTech->retrievePermissions($club['idPermission']);
      $_SESSION['oldPermission'] = $clubPermission;
      // Permet de rediriger vers la page profil du club
      require($location);
    } else {
      throw new Exception("L'utilisateur n'existe pas ");
    }
  }

  public function techConfirmCreatePermission()
  {
    $requestType = "createClub";
    // Récupération des permissions
    $allPermissionsChecked = $_POST["permissions"] ?? [];
    $_SESSION['allPermissions'] = $allPermissionsChecked;
    // Redirige vers la page de confirmation de création de nouveau Club
    require('src/views/ViewConfirmationPage.php');
  }

  public function techConfirmModifyPermissions()
  {
    $requestType = "modifyPermissions";
    // Permet de récupérer les nouvelles permissions
    $newPermissions = $_POST['permissions'] ?? [];
    // Permet de récupérer l'id du club à modifier
    $idClub = $_GET['id'] ?? '';
    $_SESSION['modifyPermission'] = [
      'idClub' => $idClub,
      'newPermissions' => $newPermissions,
    ];
    // Redirige vers la page de confirmation de modification de permissions
    require('src/views/ViewConfirmationPage.php');
  }

  public function techModifyPermissions()
  {
    // Permet de récupérer les nouvelles permissions et l'id du club
    $newPermissions = $_SESSION['modifyPermission']["newPermissions"] ?? '';
    $idClub = $_SESSION['modifyPermission']['idClub'] ?? '';
    $oldPermissions = $_SESSION['oldPermission'] ?? [];
    $oldIdPermissions = $oldPermissions['idPermission'];
    // Si aucun changement de permissions alors redirection vers la page home
    if ($oldPermissions["permissions"] !== $newPermissions) {
      // Permet de récupérer l'id du partenaire responsable
      $idPartnerParent = $this->modelTech->retrieveIdProfileParent($idClub);
      // Permet de récupérer le profile du partenaire parent
      $partnerProfile = $this->modelTech->retrievePartnerWithId($idPartnerParent['idPartnerParent']);
      // Permet de récupérer le profile du club
      $clubProfile = $this->modelTech->retrieveClubWithIdClub($idClub);
      // Permet d'envoyer l'email de confirmation de compte au partenaire parent 
      $messageMail = $this->mail->sendMail($partnerProfile['email'], SUBJECT_MODIFY_PERMISSION, $this->viewMail->mailModifyPermission($newPermissions, $clubProfile['clubName']));
      // Permet d'envoyer l'email de confirmation de compte au club 
      $this->mail->sendMail($clubProfile['email'], SUBJECT_MODIFY_PERMISSION, $this->viewMail->mailModifyPermission($newPermissions, $clubProfile['clubName']));
      // Permet de modifier les anciennes permissions avec les nouvelles
      $newIdPermissions = $this->modelTech->modifyPermissionsFile($oldIdPermissions, $newPermissions);
      // Permet d'envoyer le nouvelle idPermission à la bdd
      $this->modelTech->updatePermissions($newIdPermissions, $idClub);
      if ($messageMail) {
        $requestType = "modifyPermission";
      } else {
        $requestType = "errorModifyPermissions";
        $messageMail = ERROR_SEND_MAIL;
      }
    }
    // Permet de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function  techChangeStatus()
  {
    // Permet de récupérer l'id du profile 
    $idProfile = $_GET['id'] ?? "";
    $profileType = $_SESSION['profileType'] ?? "";
    // Permet de récupérer l'ancien status du profile
    $oldStatus = $this->modelTech->retrieveUserStatus($idProfile);
    $newStatus = $oldStatus["status"] === "enabled" ? "disabled" : "enabled";
    // Permet de modifier le status du profile
    $this->modelTech->changeStatus($idProfile, $newStatus);

    if ($profileType === "Club") {
      // Permet de récupérer l'id du partenaire parent du club
      $idParentProfile = $this->modelTech->retrieveIdProfileParent($idProfile);
      // Permet de récupérer les information de compte du partenaire parent
      $profilePartnerParent = $this->modelTech->retrievePartnerWithId($idParentProfile['idPartnerParent']);
      // Permet de récupérer les information de compte du club
      $clubProfile = $this->modelTech->retrieveClubWithIdClub($idProfile);
      // Permet d'envoyer l'email de confirmation de compte au partenaire parent 
      $messageMail = $this->mail->sendMail($profilePartnerParent['email'], SUBJECT_CHANGE_STATUS, $this->viewMail->changeStatus($clubProfile['clubName']));
      if ($messageMail) {
        $requestType = "clubStatusChange";
      } else {
        $requestType = "errorClubStatusChange";
        $messageMail = ERROR_SEND_MAIL;
      }
    } else {
      $requestType = "partnerStatusChange";
    }

    // Permet de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function techDeletePartner()
  {
    $idPartner = $_GET['id'] ?? "";
    // Permet de récupérer l'ancienne image
    $oldImg = $this->modelTech->retrieveImgPath("Partner", $idPartner);
    // Permet de suprrimer l'image du profile
    $this->modelTech->deleteOldImg($oldImg['img']);
    // Permet de supprimer le profile du partenaire
    $this->modelTech->deleteProfilePartner($idPartner);
    //Permet de supprimer le profile user du partenaire
    $this->modelTech->deleteUser($idPartner);
    // Redirection vers la page home
    header("location: ../../../index.php?status=on&action=home");
  }

  public function techDeleteClub()
  {
    // Permet de récupérer l'id du club 
    $idClub = $_GET['id'] ?? "";
    // Permet de récupérer l'id de permission du club
    $idPermissions = $_SESSION['oldPermission']["idPermission"];

    // Permet de récupérer l'id du profile parent
    $idParentClub = $this->modelTech->retrieveIdProfileParent($idClub);
    // Permet de récupérer le profile du partenaire parent
    $profilePartnerParent = $this->modelTech->retrievePartnerWithId($idParentClub['idPartnerParent']);
    // Permet de récupérer les information de compte du club
    $clubProfile = $this->modelTech->retrieveClubWithIdClub($idClub);
    // Permet d'envoyer l'email de confirmation de compte au partenaire parent 
    $messageMail = $this->mail->sendMail($profilePartnerParent['email'], DELETE_CLUB_ACCOUNT, $this->viewMail->deleteClubAccount($clubProfile['clubName']));
    // Permet de supprimer les permissions du club
    $this->modelTech->deletePermissions($idPermissions);
    // Permet de récupérer les clubs rattachés au partenaire
    $attachedClub = $this->modelTech->retrieveAttachedClubToPartner($idParentClub['idPartnerParent']);
    //Permet de supprimer le club des clubs rattachés au partenaire
    $attachedClub = explode(",", $attachedClub['attachedClub']);
    unset($attachedClub[array_search($idClub, $attachedClub)]);
    // Envoyer le nouveau tableau des clubs rattachés au partenaire parent
    $this->modelTech->addClubToParentPartner($idParentClub['idPartnerParent'], (implode(",", $attachedClub)));
    // Permet de récupérer l'ancienne image
    $oldImg = $this->modelTech->retrieveImgPath("Club", $idClub);
    // Permet de suprrimer l'image du profile
    $this->modelTech->deleteOldImg($oldImg['img']);
    // Permet de supprimer le profile du club
    $this->modelTech->deleteProfileClub($idClub);
    // Permet de supprimer le profile user du club
    $this->modelTech->deleteUser($idClub);
    // Redirection vers la page home
    $requestType = "deleteClubAccount";
    // Permet de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function techConfirmDeletePartner()
  {
    $idUrl = $_GET['id'] ?? "";
    $idPartner = $_SESSION['idPartner'] ?? '';
    if ($idUrl == $idPartner) {
      // Permet de récupérer les infos du partenaires
      $attachedClub = $this->modelTech->retrieveAttachedClubToPartner($idUrl);
      $attachedClub = explode(",", $attachedClub['attachedClub']);
      if (empty(array_filter($attachedClub, fn ($club) => $club !== ''))) {
        // Si le partenaire ne possède pas de clubs
        $requestType = "deleteProfile";
        require('src/views/ViewConfirmationPage.php');
      } else {
        // Si le partenaire possède des clubs
        $requestType = "deletionError";
        require('src/views/ViewSuccessPage.php');
      }
    } else {
      throw new Exception("L'utilisateur ne correspond pas à votre demande");
    }
  }

  public function techChangeClubOwnerForm()
  {
    // Permet de récupérer l'id du club
    $idClub = $_GET['id'] ?? '';
    // Permet de récupérer les noms des franchises existantes
    $allFranchiseNames = $this->modelTech->retrieveAllFranchiseNames();
    // Permet d'afficher le formulaire de changement de nom de propriétaire pour le club
    require('src/views/viewsTech/ViewTechChangeClubOwner.php');
  }

  public function techConfirmChangeClubOwner()
  {
    $requestType = "changeOwner";
    // Permet de récupérer le nom de la nouvelle franchise responsable du club
    $newFranchiseName = $_POST['newOwner'] ?? "";
    // Permet de récupérer l'id du club
    $idClub = $_GET['id'] ?? "";
    $_SESSION['changeOwner'] = [
      "newFranchiseName" => $newFranchiseName,
      'idClub' => $idClub
    ];

    // Permet d'afficher la page de confirmation
    require('src/views/ViewConfirmationPage.php');
  }

  public function techChangeClubOwner()
  {
    $newFranchiseName = $_SESSION["changeOwner"]['newFranchiseName'] ?? '';
    $idClub = $_SESSION['changeOwner']['idClub'] ?? '';
    // Permet de récupérer idPartnerParent de l'ancien partenaire parent
    $oldIdPartnerParent = $this->modelTech->retrieveIdProfileParent($idClub);
    // Permet de récupérer idParent du nouveau partenaire grace au nom de franchise
    $newIdPartner = $this->modelTech->retrievePartnerWithFranchiseName($newFranchiseName);
    // Permet de récupérer les information de compte du partenaire parent
    $profilePartnerParent = $this->modelTech->retrievePartnerWithId($newIdPartner['idPartner']);
    // Permet de récupérer les information de compte du club
    $clubProfile = $this->modelTech->retrieveClubWithIdClub($idClub);
    // Permet d'envoyer l'email de confirmation de compte au partenaire parent 
    $messageMail = $this->mail->sendMail($profilePartnerParent['email'], CHANGE_OWNER, $this->viewMail->changeOwner($clubProfile['clubName']));
    // Permet d'envoyer l'email de confirmation de compte du club concerné 
    $this->mail->sendMail($clubProfile['email'], CHANGE_OWNER, $this->viewMail->changeOwner($clubProfile['clubName']));
    // Permet de récupérer la liste des clubs rattaché de l'ancien parent
    $oldAttachedClub = $this->modelTech->retrieveAttachedClubToPartner($oldIdPartnerParent['idPartnerParent']);
    // Permet de modifier la liste des clubs rattaché à l'ancien parent
    $oldAttachedClub = explode(",", $oldAttachedClub["attachedClub"]);
    unset($oldAttachedClub[array_search($idClub, $oldAttachedClub)]);
    $newAttachedClubForOldPartner = [...$oldAttachedClub];
    // Permet de mettre a jour la liste des clubs rattachés de l'ancien partenaire
    $this->modelTech->addClubToParentPartner($oldIdPartnerParent['idPartnerParent'], (implode(",", $newAttachedClubForOldPartner)));
    // Permet de mettre a jour le profil du club 
    $this->modelTech->changeClubProfileAfterChangeOwner($idClub, $newIdPartner['idPartner'], $newFranchiseName);
    // Permet de récupérer la liste des clubs rattaché au nouveau partenaire
    $attachedClubNewPartner = $this->modelTech->retrieveAttachedClubToPartner($newIdPartner['idPartner']);

    if (!$attachedClubNewPartner["attachedClub"]) {
      // Si le partenaire ne possede pas de club alors on ajoute uniquement id du nouveau club
      $attachedClubNewPartner = $idClub;
    } else {
      // Sinon on récupére l'ancienne liste et on ajoute le nouveau club
      $attachedClubNewPartner = explode(",", $attachedClubNewPartner["attachedClub"]);
      array_push($attachedClubNewPartner, $idClub);
      $attachedClubNewPartner = implode(",", $attachedClubNewPartner);
    }
    // Permet d'ajouter le club a la liste du nouveau partenaire
    $this->modelTech->addClubToParentPartner($newIdPartner['idPartner'], $attachedClubNewPartner);
    $requestType = "changeOwner";
    // Permet de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function searchUser()
  {
    $allClubs = $this->modelTech->selectAllClubs() ?? [];
    $allPartners = $this->modelTech->selectAllPartners() ?? [];
    $_SESSION['allUsers'] = [...$allClubs, ...$allPartners];
  }
}
