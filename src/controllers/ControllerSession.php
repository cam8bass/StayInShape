<?php

namespace App\controllers\ControllerSession;

require_once('src/lib/Database.php');
require_once('src/models/ModelErrorManagement.php');
require_once('src/models/ModelSession.php');

use App\lib\Database\DatabaseConnection;
use App\models\ModelSession\ModelSession;
use App\models\ModelErrorManagement\ErrorManagement;

class Session
{

  function __construct()
  {
    $this->dbh = new DatabaseConnection();
    $this->modelSession = new ModelSession();
    $this->modelSession->dbh = $this->dbh;
    $this->errorManagement = new ErrorManagement();
  }

  /**
   * @param string $success redirect to success page 
   * @param string $failed redirect to loginAdmin page
   */
  public function loginAdmin($success, $failed)
  {
    // Permets de vérifier les inputs
    $allInput = $this->modelSession->checkAllInputLogin($_POST);
    $email = $allInput['email'] ?? '';
    $password = $allInput['password'] ?? '';

    // Permets de créer un message d'erreur si le format des inputs n’est pas respecté
    $errorTypeLogin = $this->errorManagement->checkErrorTypeLogin($email, $password);

    // Permets de rechercher un utilisateur grâce à l'email rentré
    $user = $this->modelSession->retrieveUserWithEmail($email) ?? '';
    //Permets de vérifier si le compte n’est pas désactivé et que l'adresse email est valide ainsi que le mot de passe 
    $errorUserLogin = $this->errorManagement->checkErrorUserLogin($password, $user);
    $errorIfUserAccount = $this->errorManagement->checkErrorIfUserAccount($user);

    if (empty(array_filter($errorTypeLogin, fn ($el) => $el !== '')) && empty(array_filter($errorUserLogin, fn ($el) => $el !== "")) && empty(array_filter($errorIfUserAccount, fn ($el) => $el !== ''))) {
      $this->modelSession->loginUser($errorUserLogin, $user);

      header($success);
    } else {
      require($failed);
    }
  }

  /**
   * @param string $success redirect to success page 
   * @param string $failed redirect to login page
   */
  public function loginUser($success, $failed)
  {
    // Permets de vérifier les inputs
    $allInput = $this->modelSession->checkAllInputLogin($_POST);
    $email = $allInput['email'] ?? '';
    $password = $allInput['password'] ?? '';
    // Permets de créer un message d'erreur si le format des inputs n’est pas respecté
    $errorTypeLogin = $this->errorManagement->checkErrorTypeLogin($email, $password);
    // Permets de rechercher un utilisateur grâce à l'email rentré
    $user = $this->modelSession->retrieveUserWithEmail($email) ?? '';
    // Permets de vérifier si le compte n’est pas désactivé et que l'adresse email est valide ainsi que le mot de passe 
    $errorUserLogin = $this->errorManagement->checkErrorUserLogin($password, $user);
    $errorIfAdminAccount = $this->errorManagement->checkErrorIfAdminAccount($user);

    if (empty(array_filter($errorTypeLogin, fn ($el) => $el !== '')) && empty(array_filter($errorUserLogin, fn ($el) => $el !== "")) && empty(array_filter($errorIfAdminAccount, fn ($el) => $el !== ""))) {
      $this->modelSession->loginUser($errorUserLogin, $user);

      header($success);
    } else {
      require($failed);
    }
  }

  public function alreadyLoggin()
  {
    // Permets de vérifier si l'utilisateur est déjà connecté
    $currentUser = $this->modelSession->isLoggedin();

    if ($currentUser) {
      session_start();
      $_SESSION['currentUser'] = $currentUser ?? "";
      return $currentUser;
    } else return;
  }

  /**
   * @param string $redirect redirect to login page
   * 
   */
  public function logout($redirect)
  {
    // Permets de supprimer la session et les cookies de session
    $idSession = $_COOKIE['session'] ?? '';
    $this->modelSession->logout($idSession);
    header($redirect);
  }

  public function cleanSession()
  {
    if (isset($_SESSION['createProfile'])) {
      unset($_SESSION['createProfile']);
    }
    if (isset($_SESSION['idProfileParent'])) {
      unset($_SESSION['idProfileParent']);
    }
    if (isset($_SESSION['allPermissions'])) {
      unset($_SESSION['allPermissions']);
    }
    if (isset($_SESSION['oldPermission'])) {
      unset($_SESSION['oldPermission']);
    }
    if (isset($_SESSION['modifyPermission'])) {
      unset($_SESSION['modifyPermission']);
    }
    if (isset($_SESSION['profileType'])) {
      unset($_SESSION['profileType']);
    }
    if (isset($_SESSION['idPartnerParent'])) {
      unset($_SESSION['idPartnerParent']);
    }
    if (isset($_SESSION['changeOwner'])) {
      unset($_SESSION['changeOwner']);
    }

    if (isset($_SESSION["userType"])) {
      unset($_SESSION['userType']);
    }

    if (isset($_SESSION['allClubs'])) {
      unset($_SESSION['allClubs']);
    }

    if (isset($_SESSION['allPartner'])) {
      unset($_SESSION['allPartner']);
    }

    if (isset($_SESSION['idClub'])) {
      unset($_SESSION['idClub']);
    }

    if (isset($_SESSION['idPartner'])) {
      unset($_SESSION['idPartner']);
    }
  }
}
