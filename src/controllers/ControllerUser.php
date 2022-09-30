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
      // Permet de récupérer l'id de l'utilisateur et le type
      $idUser = $_SESSION['currentUser']['id'];
    } elseif ($userType === "Partner") {
      $idUser = $_GET['id'] ?? "";
    }
    // Permet de récupérer le profile du club
    $club = $this->modelUser->retrieveClubWithIdClub($idUser);
    // Permet de récupérer les permissions du club
    $clubPermission = $this->modelUser->retrievePermissions($club['idPermission']);
    require('src/views/viewsUser/ViewUserProfileClub.php');
  }

  public function displayUserProfilePartner()
  {
    // Permet de récupérer l'id de l'utilisateur et le type
    $idUser = $_SESSION['currentUser']['id'] ?? '';
    // Permet de récupérer le profil du partenaire 
    $partnerProfile = $this->modelUser->retrievePartnerWithId($idUser);
    // Permet de récupérer les clubs rattaché au partenaire
    $allClubs = $this->modelUser->retrieveAllClubsAssociatedWithPartner($partnerProfile['franchiseName']);
    require('src/views/viewsUser/ViewUserProfilePartner.php');
  }

  public function displayUserSettings()
  {
    // Permet de récupérer l'id de l'utilisateur et le type
    $idUser = $_SESSION['currentUser']['id'] ?? '';
    $userType = $_SESSION['currentUser']['type'] ?? '';
    // Permet de récupérer les informations du profile de l'utilisateur 
    $userProfile = $this->modelUser->retrieveUserProfile($userType, $idUser);
    require('src/views/ViewProfileInfo.php');
  }

  public function userChangePictureClub()
  {
    // Permet de récupérer l'id de l'utilisateur et le type
    $idUser = $_SESSION['currentUser']['id'] ?? '';
    $userType = $_SESSION['currentUser']['type'] ?? '';
    // Permet de vérifier l'image envoyé
    $errorImgFile = $this->errorManagement->checkImgFile($_FILES);

    if ($errorImgFile) {
      // Si le fichier envoyer provoque une erreur
      require("src/views/viewsUser/ViewUserChangePictureForm.php");
    } else {
      // Permet de récupérer l'ancienne img
      $oldImg = $this->modelUser->retrieveImgPath($userType, $idUser);
      // Permet d'enregister l'image dans le dossier 
      $newImgPath = $this->modelUser->saveImg($_FILES);
      // Permet de supprimer l'ancienne image si l'image est différente de l'image de profile par defaut
      $this->modelUser->deleteOldImg($oldImg['img']);
      // Permet de mettre à jour la bdd
      $this->modelUser->changePathImg($userType, $newImgPath, $idUser);
      // Permet de rediriger vers la page home 
      $requestType = "downloadImg";
      require('src/views/ViewSuccessPage.php');
    }
  }

  public function userChangePassword()
  {
    $idUser = $_SESSION["currentUser"]["id"] ?? "";
    // Permet de vérifier les inputs
    $allInput = $this->modelUser->checkUserChangePassword($_POST);
    // Permet de récupérer l'ancien mot de passe de l'utilisateur
    $oldPasswordHash = $this->modelUser->retrieveUserPassword($idUser);
    //Permet de vérifier la confirmité des inputs
    $errorChangePassword = $this->errorManagement->checkUserPassword($oldPasswordHash["password"], $allInput);

    if (empty(array_filter($errorChangePassword, fn ($el) => $el !== ''))) {
      // Permet de hash le nouveau mot de passe
      $newPassword = password_hash($allInput['newPassword'], PASSWORD_ARGON2I);
      // Permet d'envoyer le nouveau mot de passe à la BDD
      $this->modelUser->changeUserPassword($idUser, $newPassword);
      // Permet de rédiriger vers la page home
      $requestType = "changePassword";
      require('src/views/ViewSuccessPage.php');
    } else {
      require('templates/viewsUser/ViewUserChangePasswordForm.php');
    }
  }

  public function userChangeDescription()
  {
    $idUser = $_SESSION["currentUser"]["id"] ?? "";
    $userType = $_SESSION['currentUser']['type'] ?? '';
    // Permet de vérifier la description
    $newDescription = $this->modelUser->checkUserDescription($_POST);
    // Permet de vérifier la conformité de la description
    $errorDescription = $this->errorManagement->checkUserDescription($newDescription);
    // Permet de récupérer l'ancienne description
    $oldDescription = $this->modelUser->retrieveUserDescription($userType, $idUser);

    if (!$errorDescription) {
      // Permet de mettre a jour la nouvelle description dans la bdd
      $this->modelUser->changeUserDescription($newDescription, $userType, $idUser);
      // Permet de rédiriger vers la page home
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

    if ($validKey['numActive'] === $activationKey) {
      $activation = $this->modelUser->sendActivation($idClub);
      if ($activation) {
        $this->modelUser->accountActivation($idClub);
      }
      $requestType = "accountActivation";
    } else {
      $requestType = "accountActivationFailed";
    }

    // Permet de générer la page success 
    require("src/views/ViewSuccessPage.php");
  }
}
