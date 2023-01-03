<?php

namespace App\controllers\ControllerTech;

require_once('src/lib/Database.php');
require_once('src/models/ModelTech.php');
require_once('src/models/ModelSession.php');
require_once('src/models/ModelErrorManagement.php');
require_once('src/config/config.php');
require_once('src/config/Mail.php');
require_once('src/views/viewsTech/ViewsMail.php');


use App\lib\Database\DatabaseConnection;
use App\models\ModelTech\ModelTech;
use App\models\ModelSession\ModelSession;
use App\models\ModelErrorManagement\ErrorManagement;
use App\congig\Mail\Mail;
use App\views\viewsTech\ViewsMail\ViewsMail;

use Exception;

class Technician
{
  protected  $dbh;
  protected  $modelTech;
  protected  $modelSession;
  protected  $errorManagement;
  protected $mail;
  protected $viewMail;
  
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

  /**
   * @param string $action is necessary for the operation of the router
   * @param string $locationFailed return to createPartner page
   */
  public function techCreateProfile(string $action, string $locationFailed)
  {
    // Permets de récupérer l'id du profile s’il existe dans l'URL
    $partnerProfile['idPartner'] = $_GET['id'] ?? '';
    // Permets de vérifier les inputs de création d'un profile
    $allInput = $this->modelTech->checkAllInputCreateProfile($_POST);
    $firstName =$allInput['firstName']??'';
    $lastName =$allInput['lastName']??'';
    $compagnyName =$allInput['compagnyName']??'';

    $email = $allInput['email'] ?? '';
    //  Permets de vérifier si l'adresse email est déjà utilisée
    $userAlreadyCreate = $this->modelSession->retrieveUserWithEmail($email);
   
    // Permets de vérifier la conformité des inputs
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
    // Permets de récupérer le compte de l'utilisateur en cours de création
    $newPartner = $_SESSION['createProfile'] ?? [];
    if ($newPartner) {
      // Permets de nettoyer la session
      unset($_SESSION['createProfile']);
      // Permets de générer un mot de passe pour le compte
      $passwordGenerated = $this->modelTech->createRandomPassword(12);

      $passwordHash = password_hash($passwordGenerated, PASSWORD_ARGON2I);
      if (password_verify($passwordGenerated, $passwordHash)) {
        // Permets d'ajouter le password généré au compte en cours de création
        $newPartner["password"] = $passwordHash;
        $requestType = 'copyPassword';
        // Permets de créer le compte utilisateur et de récupérer l'id user du compte crée
        $idProfile = $this->modelTech->createUser($newPartner, "Partner");
        // Permets de remplir le profil du nouveau partenaire
        $this->modelTech->createPartner($idProfile, $newPartner);
        // Permets de générer la page success 
        require('src/views/ViewSuccessPage.php');
      }
    } else throw new Exception(ERROR_REDIRECT);
  }

  public function techCreateClub()
  {
    // Permets de récupérer l'id de la franchise
    $idProfileParent = $_SESSION['idPartnerParent'] ?? '';
    // Permets de récupérer les infos du club en cours de création
    $newClub = $_SESSION['createProfile'] ?? [];

    if ($newClub) {
      // Permets de récupérer les permissions cochées du club 
      $clubPermissions = $_SESSION['allPermissions'] ?? [];
      // Permets de récupérer le nom de la franchise parent
      $profileParent = $this->modelTech->retrievePartnerWithId($idProfileParent);
      $newClub['nameFranchiseOwner'] = $profileParent['franchiseName'];
      $newClub['idPartnerParent'] = $idProfileParent;
      // Permets de nettoyer la session
      unset($_SESSION['idPartnerParent']);
      unset($_SESSION['createProfile']);
      unset($_SESSION['allPermissions']);
      // Permets de générer un mot de passe pour le compte
      $passwordGenerated = $this->modelTech->createRandomPassword(12);
      $passwordHash = password_hash($passwordGenerated, PASSWORD_ARGON2I);
      // Permets de générer une clé d'activation
      $activationKey = bin2hex(random_bytes(10));

      if (password_verify($passwordGenerated, $passwordHash)) {
        // Permets d'ajouter le password généré au compte en cours de création
        $newClub["password"] = $passwordHash;
        // Permets de créer le compte utilisateur et de récupérer l'id user du compte crée
        $idClub = $this->modelTech->createUser($newClub, "Club");
        // Permets d'envoyer l'email de confirmation de compte
        $messageMail = $this->mail->sendMail($profileParent["email"], SUBJECT_CREATE_CLUB, $this->viewMail->mailCreateClub($newClub['compagnyName'], $idClub, $clubPermissions, $activationKey));

        if ($messageMail) {
          // Permets de créer le fichier permission.json et de le remplir avec les permissions 
          $idPermission = $this->modelTech->createPermissionsFile($clubPermissions) ?? time();
          // Permets de remplir le profil de l'utilisateur et de l'envoyer à la Bdd
          $this->modelTech->createClub($idClub, $newClub, $idPermission, $activationKey);
          //  Récupère le nom des clubs déjà rattaché au partner parent
          $attachedClub = $this->modelTech->retrieveAttachedClubToPartner($profileParent['idPartner']);
          $idNewAttachedClub = $attachedClub['attachedClub'] === "" ? $idClub  : implode(',', [$attachedClub['attachedClub'], $idClub]);
          // Permets de mettre à jour le nom des clubs au partner parent
          $this->modelTech->addClubToParentPartner($profileParent['idPartner'],  $idNewAttachedClub);
          $requestType = 'copyPasswordClub';
        } else {
          // En cas de problème lors de la création du compte les données sont supprimées
          $requestType = "errorSendMail";
          $messageMail = ERROR_SEND_MAIL;
          $this->modelTech->deleteUser($idClub);
        }

        // Permets de générer la page success 
        require("src/views/ViewSuccessPage.php");
      }
    } else throw new Exception(ERROR_REDIRECT);
  }

  public function techDisplayProfileInfo()
  {
    // Permets de récupérer le type d'utilisateur
    $userType = $_SESSION['profileType'] ?? '';
    // Permets de récupérer l'id de l'utilisateur
    $idUrl = $_GET['id'] ?? "";
    $idClub = $_SESSION['idClub'] ?? "";
    $idPartner = $_SESSION['idPartner'] ?? '';
    if ($idUrl == $idClub || $idUrl == $idPartner) {
      // Permets de récupérer le profil de l'utilisateur
      $userProfile = $this->modelTech->retrieveUserProfile($userType, $idUrl);
      require('src/views/ViewProfileInfo.php');
    } else {
      throw new Exception("L'utilisateur ne correspond pas à votre demande");
    }
  }

  public function techDisplayAllPartners()
  {
    // Permets de récupérer le profile de tous les partenaires
    $allPartners = $this->modelTech->selectAllPartners();
    $_SESSION['allPartner'] = $allPartners ?? [];
    require('src/views/viewsTech/ViewTechDisplayAllPartners.php');
  }

  public function techDisplayAllClubs()
  {
    // Permets de récupérer le profile de tous les clubs
    $allClubs = $this->modelTech->selectAllClubs();
    $_SESSION['allClubs'] = $allClubs ?? [];
    require('src/views/viewsTech/ViewTechDisplayAllClubs.php');
  }

  /**
   * @param string $location link partnerProfile
   */
  public function techShowPartnerProfile($location)
  {
    // Permets de récupérer l'id du partenaire sélectionné dans l'URL
    $idProfile = $_GET['id'] ?? '';
    $_SESSION['idPartnerParent'] = $idProfile;
    // Permets de récupérer le profil du partenaire grâce à son id de profile
    $partnerProfile = $this->modelTech->retrievePartnerWithId($idProfile);
    if ($partnerProfile) {
      $_SESSION['idPartner'] = $partnerProfile['idPartner'];
      // Permets de mémoriser le type de profile
      $_SESSION['profileType'] = $partnerProfile['type'];
      // Permets de récupérer les clubs rattachés au partenaire
      $allClubs = $this->modelTech->retrieveAllClubsAssociatedWithPartner($partnerProfile['franchiseName']);
      require($location);
    } else {
      throw new Exception("L'utilisateur n'existe pas");
    }
  }

  /**
   * @param string $location link clubProfile
   */
  public function techShowClubProfile(string $location)
  {
    // Permets de récupérer l'id du partenaire sélectionné dans l'URL
    $idClub = $_GET['id'] ?? '';
    // Permets de récupérer lid du partenaire parent
    $idPartnerParent = $_SESSION['idPartnerParent'] ?? "";
    // Permets de récupérer le profil du club
    $club = $this->modelTech->retrieveClubWithIdClub($idClub);

    if ($club) {
      $_SESSION["idClub"] = $idClub;
      // Permets de mémoriser le type de profile
      $_SESSION["profileType"] = $club['type'];
      // Permets de récupérer les permissions du club sélectionné
      $clubPermission = $this->modelTech->retrievePermissions($club['idPermission']);
      $_SESSION['oldPermission'] = $clubPermission;
      // Permets de rediriger vers la page profil du club
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
    // Redirige vers la page de confirmation de création d’un nouveau Club
    require('src/views/ViewConfirmationPage.php');
  }

  public function techConfirmModifyPermissions()
  {
    $requestType = "modifyPermissions";
    // Permets de récupérer les nouvelles permissions
    $newPermissions = $_POST['permissions'] ?? [];
    // Permets de récupérer l'id du club à modifier
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
    // Permets de récupérer les nouvelles permissions et l'id du club
    $newPermissions = $_SESSION['modifyPermission']["newPermissions"] ?? '';
    $idClub = $_SESSION['modifyPermission']['idClub'] ?? '';
    $oldPermissions = $_SESSION['oldPermission'] ?? [];
    $oldIdPermissions = $oldPermissions['idPermission'];
    // Si aucun changement de permissions alors redirection vers la page home
    if ($oldPermissions["permissions"] !== $newPermissions) {
      // Permets de récupérer l'id du partenaire responsable
      $idPartnerParent = $this->modelTech->retrieveIdProfileParent($idClub);
      // Permets de récupérer le profile du partenaire parent
      $partnerProfile = $this->modelTech->retrievePartnerWithId($idPartnerParent['idPartnerParent']);
      // Permets de récupérer le profile du club
      $clubProfile = $this->modelTech->retrieveClubWithIdClub($idClub);
      // Permets d'envoyer un email de notification de changement des permissions au partenaire
      $messageMail = $this->mail->sendMail($partnerProfile['email'], SUBJECT_MODIFY_PERMISSION, $this->viewMail->mailModifyPermission($newPermissions, $clubProfile['clubName']));
      // Permets d'envoyer l'email de confirmation de compte au club 
      $this->mail->sendMail($clubProfile['email'], SUBJECT_MODIFY_PERMISSION, $this->viewMail->mailModifyPermission($newPermissions, $clubProfile['clubName']));
      // Permets de modifier les anciennes permissions avec les nouvelles
      $newIdPermissions = $this->modelTech->modifyPermissionsFile($oldIdPermissions, $newPermissions);
      // Permets d'envoyer le nouveau idPermission à la bdd
      $this->modelTech->updatePermissions($newIdPermissions, $idClub);
      if ($messageMail) {
        $requestType = "modifyPermission";
      } else {
        $requestType = "errorModifyPermissions";
        $messageMail = ERROR_SEND_MAIL;
      }
    }
    // Permets de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function  techChangeStatus()
  {
    // Permets de récupérer l'id du profile 
    $idProfile = $_GET['id'] ?? "";
    $profileType = $_SESSION['profileType'] ?? "";
    // Permets de récupérer l'ancien statut du profile
    $oldStatus = $this->modelTech->retrieveUserStatus($idProfile);
    $newStatus = $oldStatus["status"] === "enabled" ? "disabled" : "enabled";
    // Permets de modifier le statut du profil
    $this->modelTech->changeStatus($idProfile, $newStatus);

    if ($profileType === "Club") {
      // Permets de récupérer l'id du partenaire parent du club
      $idParentProfile = $this->modelTech->retrieveIdProfileParent($idProfile);
      // Permets de récupérer les informations de compte du partenaire parent
      $profilePartnerParent = $this->modelTech->retrievePartnerWithId($idParentProfile['idPartnerParent']);
      // Permets de récupérer les informations de compte du club
      $clubProfile = $this->modelTech->retrieveClubWithIdClub($idProfile);
      // Permets d'envoyer l'email de confirmation de compte au partenaire parent 
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

    // Permets de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function techDeletePartner()
  {
    $idPartner = $_GET['id'] ?? "";
    // Permets de récupérer l'ancienne image
    $oldImg = $this->modelTech->retrieveImgPath("Partner", $idPartner);
    // Permets de supprimer l'image du profil
    $this->modelTech->deleteOldImg($oldImg['img']);
    // Permets de supprimer le profil du partenaire
    $this->modelTech->deleteProfilePartner($idPartner);
    // Permets de supprimer le profil user du partenaire
    $this->modelTech->deleteUser($idPartner);
    // Redirection vers la page home
    header("location: ../../../index.php?status=on&action=home");
  }

  public function techDeleteClub()
  {
    // Permets de récupérer l'id du club
    $idClub = $_GET['id'] ?? "";
    // Permets de récupérer l'id de permission du club
    $idPermissions = $_SESSION['oldPermission']["idPermission"];

    // Permets de récupérer l'id du profile parent
    $idParentClub = $this->modelTech->retrieveIdProfileParent($idClub);

    // Permets de récupérer le profile du partenaire parent
    $profilePartnerParent = $this->modelTech->retrievePartnerWithId($idParentClub['idPartnerParent']);
    // Permets de récupérer les informations de compte du club
    $clubProfile = $this->modelTech->retrieveClubWithIdClub($idClub);
    // Permets d'envoyer l'email de confirmation de compte au partenaire parent 
    $messageMail = $this->mail->sendMail($profilePartnerParent['email'], DELETE_CLUB_ACCOUNT, $this->viewMail->deleteClubAccount($clubProfile['clubName']));
    // Permets de supprimer les permissions du club
    $this->modelTech->deletePermissions($idPermissions);
    // Permets de récupérer les clubs rattachés au partenaire
    $attachedClub = $this->modelTech->retrieveAttachedClubToPartner($idParentClub['idPartnerParent']);
    // Permets de supprimer le club des clubs rattachés au partenaire
    $attachedClub = explode(",", $attachedClub['attachedClub']);
    unset($attachedClub[array_search($idClub, $attachedClub)]);
    // Envoyer le nouveau tableau des clubs rattachés au partenaire parent
    $this->modelTech->addClubToParentPartner($idParentClub['idPartnerParent'], (implode(",", $attachedClub)));
    // Permets de récupérer l'ancienne image
    $oldImg = $this->modelTech->retrieveImgPath("Club", $idClub);
    // Permets de supprimer l'image du profile
    $this->modelTech->deleteOldImg($oldImg['img']);
    // Permets de supprimer le profil du club
    $this->modelTech->deleteProfileClub($idClub);
    // Permets de supprimer le profil user du club
    $this->modelTech->deleteUser($idClub);
    // Redirection vers la page home
    $requestType = "deleteClubAccount";
    // // Permets de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function techConfirmDeletePartner()
  {
    $idUrl = $_GET['id'] ?? "";
    $idPartner = $_SESSION['idPartner'] ?? '';
    if ($idUrl == $idPartner) {
      // Permets de récupérer les infos du partenaire
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
    // Permets de récupérer l'id du club
    $idClub = $_GET['id'] ?? '';
    // Permets de récupérer les noms des franchises existantes
    $allFranchiseNames = $this->modelTech->retrieveAllFranchiseNames();
    // Permets d'afficher le formulaire de changement de nom de propriétaire pour le club
    require('src/views/viewsTech/ViewTechChangeClubOwner.php');
  }

  public function techConfirmChangeClubOwner()
  {
    $requestType = "changeOwner";
    // Permets de récupérer le nom de la nouvelle franchise responsable du club
    $newFranchiseName = $_POST['newOwner'] ?? "";
    // Permets de récupérer l'id du club
    $idClub = $_GET['id'] ?? "";
    $_SESSION['changeOwner'] = [
      "newFranchiseName" => $newFranchiseName,
      'idClub' => $idClub
    ];

    // Permets d'afficher la page de confirmation
    require('src/views/ViewConfirmationPage.php');
  }

  public function techChangeClubOwner()
  {
    $newFranchiseName = $_SESSION["changeOwner"]['newFranchiseName'] ?? '';
    $idClub = $_SESSION['changeOwner']['idClub'] ?? '';
    // Permets de récupérer idPartnerParent de l'ancien partenaire parent
    $oldIdPartnerParent = $this->modelTech->retrieveIdProfileParent($idClub);
    // Permets de récupérer idParent du nouveau partenaire grâce au nom de franchise
    $newIdPartner = $this->modelTech->retrievePartnerWithFranchiseName($newFranchiseName);
    // Permets de récupérer les informations de compte du partenaire parent
    $profilePartnerParent = $this->modelTech->retrievePartnerWithId($newIdPartner['idPartner']);
    // Permets de récupérer les informations de compte du club
    $clubProfile = $this->modelTech->retrieveClubWithIdClub($idClub);
    // Permets d'envoyer l'email de confirmation de compte au partenaire parent 
    $messageMail = $this->mail->sendMail($profilePartnerParent['email'], CHANGE_OWNER, $this->viewMail->changeOwner($clubProfile['clubName']));
    // Permets d'envoyer l'email de confirmation de compte du club concerné 
    $this->mail->sendMail($clubProfile['email'], CHANGE_OWNER, $this->viewMail->changeOwner($clubProfile['clubName']));
    // Permets de récupérer la liste des clubs rattachés de l'ancien parent
    $oldAttachedClub = $this->modelTech->retrieveAttachedClubToPartner($oldIdPartnerParent['idPartnerParent']);
    // Permets de modifier la liste des clubs rattachés à l'ancien parent
    $oldAttachedClub = explode(",", $oldAttachedClub["attachedClub"]);
    unset($oldAttachedClub[array_search($idClub, $oldAttachedClub)]);
    $newAttachedClubForOldPartner = [...$oldAttachedClub];
    // Permets de mettre à jour la liste des clubs rattachés de l'ancien partenaire
    $this->modelTech->addClubToParentPartner($oldIdPartnerParent['idPartnerParent'], (implode(",", $newAttachedClubForOldPartner)));
    // Permets de mettre à jour le profil du club 
    $this->modelTech->changeClubProfileAfterChangeOwner($idClub, $newIdPartner['idPartner'], $newFranchiseName);
    // Permets de récupérer la liste des clubs rattachés au nouveau partenaire
    $attachedClubNewPartner = $this->modelTech->retrieveAttachedClubToPartner($newIdPartner['idPartner']);

    if (!$attachedClubNewPartner["attachedClub"]) {
      // Si le partenaire ne possède pas de club alors on ajoute uniquement id du nouveau club
      $attachedClubNewPartner = $idClub;
    } else {
      // Sinon on récupère l'ancienne liste et on ajoute le nouveau club
      $attachedClubNewPartner = explode(",", $attachedClubNewPartner["attachedClub"]);
      array_push($attachedClubNewPartner, $idClub);
      $attachedClubNewPartner = implode(",", $attachedClubNewPartner);
    }
    // Permets d'ajouter le club à la liste du nouveau partenaire
    $this->modelTech->addClubToParentPartner($newIdPartner['idPartner'], $attachedClubNewPartner);
    $requestType = "changeOwner";
    // Permets de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }

  public function searchUser()
  {
    $allClubs = $this->modelTech->selectAllClubs() ?? [];
    $allPartners = $this->modelTech->selectAllPartners() ?? [];
    $_SESSION['allUsers'] = [...$allClubs, ...$allPartners];
  }
}
