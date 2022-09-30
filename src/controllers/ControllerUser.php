<?php

namespace App\controllers\ControllerUser;

require_once('src/lib/Database.php');
require_once('src/models/ModelUser.php');
require_once('src/models/ModelErrorManagement.php');

use App\lib\Database\DatabaseConnection;
use App\models\ModelUser\ModelUser;
use App\models\ModelErrorManagement\ErrorManagement;

class User
{
  function __construct()
  {
    $this->dbh = new DatabaseConnection();
    $this->modelUser = new ModelUser();
    $this->modelUser->dbh = $this->dbh;
    $this->errorManagement = new ErrorManagement();
  }

  public function displayUserProfileClub()
  {
    $userType = $_SESSION['currentUser']['type'];
    if ($userType === "Club") {
      // Permets de récupérer l'id de l'utilisateur et le type
      $idUser = $_SESSION['currentUser']['id'];
    } elseif ($userType === "Partner") {
      $idUser = $_GET['id'] ?? "";
    }
    // Permets de récupérer le profile du club
    $club = $this->modelUser->retrieveClubWithIdClub($idUser);
    // Permets de récupérer les permissions du club
    $clubPermission = $this->modelUser->retrievePermissions($club['idPermission']);
    require('src/views/viewsUser/ViewUserProfileClub.php');
  }

  public function displayUserProfilePartner()
  {
    // Permets de récupérer l'id de l'utilisateur et le type
    $idUser = $_SESSION['currentUser']['id'] ?? '';
    // Permets de récupérer le profil du partenaire 
    $partnerProfile = $this->modelUser->retrievePartnerWithId($idUser);
    // Permets de récupérer les clubs rattachés au partenaire
    $allClubs = $this->modelUser->retrieveAllClubsAssociatedWithPartner($partnerProfile['franchiseName']);
    require('src/views/viewsUser/ViewUserProfilePartner.php');
  }

  public function displayUserSettings()
  {
    // Permets de récupérer l'id de l'utilisateur et le type
    $idUser = $_SESSION['currentUser']['id'] ?? '';
    $userType = $_SESSION['currentUser']['type'] ?? '';
    // Permets de récupérer les informations du profil de l'utilisateur 
    $userProfile = $this->modelUser->retrieveUserProfile($userType, $idUser);
    require('src/views/ViewProfileInfo.php');
  }

  public function userChangePictureClub()
  {
    // Permets de récupérer l'id de l'utilisateur et le type
    $idUser = $_SESSION['currentUser']['id'] ?? '';
    $userType = $_SESSION['currentUser']['type'] ?? '';
    // Permets de vérifier l'image envoyée
    $errorImgFile = $this->errorManagement->checkImgFile($_FILES);
    
    if ($errorImgFile) {
      // Si le fichier envoyé provoque une erreur
      require("src/views/viewsUser/ViewUserChangePictureForm.php");
    } else {
      // Permets de récupérer l'ancienne image
      $oldImg = $this->modelUser->retrieveImgPath($userType, $idUser);
      // Permets d'enregistrer l'image dans le dossier 
      $newImgPath = $this->modelUser->saveImg($_FILES);
      // Permets de supprimer l'ancienne image si l'image est différente de l'image de profil par défaut
      $this->modelUser->deleteOldImg($oldImg['img']);
      // Permets de mettre à jour la bdd
      $this->modelUser->changePathImg($userType, $newImgPath, $idUser);
      // Permets de rediriger vers la page home 
      $requestType = "downloadImg";
      require('src/views/ViewSuccessPage.php');
    }
  }

  public function userChangePassword()
  {
    $idUser = $_SESSION["currentUser"]["id"] ?? "";
    // Permets de vérifier les inputs
    $allInput = $this->modelUser->checkUserChangePassword($_POST);
    // Permets de récupérer l'ancien mot de passe de l'utilisateur
    $oldPasswordHash = $this->modelUser->retrieveUserPassword($idUser);
    // Permets de vérifier la conformité des inputs
    $errorChangePassword = $this->errorManagement->checkUserPassword($oldPasswordHash["password"], $allInput);

    if (empty(array_filter($errorChangePassword, fn ($el) => $el !== ''))) {
      // Permets de hash le nouveau mot de passe
      $newPassword = password_hash($allInput['newPassword'], PASSWORD_ARGON2I);
      // Permets d'envoyer le nouveau mot de passe à la BDD
      $this->modelUser->changeUserPassword($idUser, $newPassword);
      // Permets de rédiriger vers la page home
      $requestType = "changePassword";
      require('src/views/ViewSuccessPage.php');
    } else {
      require('src/views/viewsUser/ViewUserChangePasswordForm.php');
    }
  }

  public function userChangeDescription()
  {
    $idUser = $_SESSION["currentUser"]["id"] ?? "";
    $userType = $_SESSION['currentUser']['type'] ?? '';
    // Permets de vérifier la description
    $newDescription = $this->modelUser->checkUserDescription($_POST);
    // Permets de vérifier la conformité de la description
    $errorDescription = $this->errorManagement->checkUserDescription($newDescription);
    // Permets de récupérer l'ancienne description
    $oldDescription = $this->modelUser->retrieveUserDescription($userType, $idUser);

    if (!$errorDescription) {
      // Permets de mettre à jour la nouvelle description dans la bdd
      $this->modelUser->changeUserDescription($newDescription, $userType, $idUser);
      // Permets de rédiriger vers la page home
      $requestType = "changeDescription";
      require('src/views/ViewSuccessPage.php');
    } else {
      require("src/views/viewsUser/ViewUserChangeDescriptionForm.php");
    }
  }

  public function verifyActivationKey()
  {
    $idClub = $_GET['id'] ?? '';
    $activationKey = $_GET['key'] ?? '';
    $validKey = $this->modelUser->retrieveActicationKey($idClub);

    if ($validKey["numActive"] === $activationKey) {
      $activation = $this->modelUser->sendActivation($idClub);
      if ($activation) {
        $this->modelUser->accountActivation($idClub);
      }
      $requestType = "accountActivation";
    } else {
      $requestType = "accountActivationFailed";
    }

    // Permets de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }
}
