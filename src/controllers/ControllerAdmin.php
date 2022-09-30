<?php

namespace App\controllers\ControllerAdmin;

require_once('src/lib/Database.php');
require_once('src/models/ModelAdmin.php');
require_once('src/models/ModelSession.php');
require_once('src/models/ModelErrorManagement.php');

use App\lib\Database\DatabaseConnection;
use App\models\ModelAdmin\ModelAdmin;
use App\models\ModelErrorManagement\ErrorManagement;
use App\models\ModelSession\ModelSession;
use Exception;

class Admin
{

  function __construct()
  {
    $this->dbh = new DatabaseConnection();
    $this->modelAdmin = new ModelAdmin();
    $this->modelAdmin->dbh = $this->dbh;
    $this->modelSession = new modelSession();
    $this->modelSession->dbh = $this->dbh;
    $this->errorManagement = new ErrorManagement();
    $this->errorDeleteUser = new ErrorManagement();
  }

  public function adminAddAccount()
  {
    $requestType = "adminAddAccount";
    // Permets de vérifier les inputs
    $allInput =  $this->modelAdmin->checkAllInputAddAccount($_POST);
    $lastName = $allInput['lastName'] ?? '';
    $firstName = $allInput['firstName'] ?? '';
    $email = $allInput['email'] ?? '';
    //  Permets de vérifier si l'adresse email est déjà utilisée
    $userAlreadyCreate = $this->modelSession->retrieveUserWithEmail($email);
    //  Permets de vérifier la conformité des inputs
    $errorAdminAddAccount = $this->errorManagement->checkErrorAllInputAddAccount($allInput, $userAlreadyCreate);

    if (empty(array_filter($errorAdminAddAccount, fn ($el) => $el !== ''))) {
      $_SESSION['newAccount'] = $allInput;
      require('src/views/ViewConfirmationPage.php');
    } else {
      require('src/views/viewsAdmin/ViewAdminAddAccount.php');
    }
  }

  public function adminConfirmAddAccount()
  {
    if (isset($_SESSION['newAccount'])) {
      // Permets de récupérer le profil de l'utilisateur à créer
      $allInput = $_SESSION['newAccount'];
      // Permets de générer un mot de passe pour le compte
      $passwordGenerated = $this->modelAdmin->createRandomPassword(12);
      $passwordHash = password_hash($passwordGenerated, PASSWORD_ARGON2I);
      if (password_verify($passwordGenerated, $passwordHash)) {
        $allInput["password"] = $passwordHash;
        // Création du nouvel utilisateur
        $this->modelAdmin->createAccount($allInput);
        // Suppression de la sauvegarde des informations 
        unset($_SESSION['newAccount']);

        $requestType = "adminAddAccount";
        require('src/views/ViewSuccessPage.php');
      }
    } else (throw new Exception(ERROR_REDIRECT));
  }

  public function adminDeleteAccount()
  {
    $requestType = "adminDeleteAccount";
    // Permets de nettoyer l'email entré et de la retourner
    $email = $this->modelAdmin->checkEmail($_POST);
    // Permets d'afficher s'il y a un problème de format avec l'email
    $errorTypeDelete = $this->errorDeleteUser->checkErrorTypeEmailDelete($email);
    // Permets de vérifier l'existence du compte à supprimer
    $userWantDelete = $this->modelSession->retrieveUserWithEmail($email);
    // Permets d'afficher l'erreur si aucun compte ne correspond à l'email
    $errorUserDelete = $this->errorDeleteUser->checkErrorExistenceEmailDelete($userWantDelete);
    if (empty(array_filter($errorTypeDelete, fn ($el) => $el !== '')) && empty(array_filter($errorUserDelete, fn ($el) => $el !== ''))) {
      $_SESSION['accountWantDelete'] = $email;
      require("src/views/ViewConfirmationPage.php");
    } else {
      require('src/views/viewsAdmin/ViewAdminDeleteAccount.php');
    }
  }

  public function adminConfirmDeleteAccount()
  {
    if ($_SESSION['accountWantDelete']) {
      // Permets de récupérer l'email de l'utilisateur à supprimer
      $email = $_SESSION['accountWantDelete'];
      // Permets de supprimer le compte
      $this->modelAdmin->deleteAccount($email);
      // Suppression de la sauvegarde des informations 
      unset($_SESSION['accountWantDelete']);
      $requestType = "adminDeleteAccount";
      require('src/views/ViewSuccessPage.php');
    } else (throw new Exception(ERROR_REDIRECT));
  }

  public function searchTech()
  {
    $allTechnicien = $this->modelAdmin->selectUserTech() ?? [];
    $_SESSION['allTechnicien'] = $allTechnicien;
  }
}
