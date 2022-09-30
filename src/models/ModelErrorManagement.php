<?php

namespace App\models\ModelErrorManagement;

require_once('src/config/config.php');

class ErrorManagement
{
  public array $errorTypeLogin = [
    'errorEmail' => '',
    'errorPassword' => ''
  ];

  public array $errorUserLogin = [
    'errorEmail' => '',
    'errorPassword' => ''
  ];

  public array $errorIfAdminAccount = [
    'errorEmail' => '',
    'errorPassword' => ''
  ];

  public array $errorIfUserAccount = [
    'errorEmail' => '',
    'errorPassword' => ''
  ];

  public array $errorAdminAddAccount = [
    "errorFirstName" => '',
    'errorLastName' => '',
    'errorEmail' => '',
  ];

  public array $errorTypeDelete = [
    'errorEmail' => ''
  ];

  public array $errorUserDelete = [
    'errorEmail' => ''
  ];

  public array $errorCreateProfile = [
    "errorFirstName" => '',
    'errorLastName' => '',
    'errorEmail' => '',
    'errorCompagnyName' => "",
  ];

  public array $errorChangePassword = [
    "errorOldPassword" => "",
    "errorNewPassword" => "",
  ];

  public string $errorDesciption = "";
  public string $errorImgFile = "";

  public function checkErrorTypeLogin(string $email, string $password): array
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->errorTypeLogin['errorEmail'] = ERROR_EMAIL; 
      }
      // A MODIFIER
      if (!$password || mb_strlen($password) < 8) {
        $this->errorTypeLogin['errorPassword'] = ERROR_PASSWORD_TYPE; 
      }
      // $this->errorTypeLogin['errorPassword'] =  $this->checkPassword($password, $this->errorTypeLogin['errorPassword']);
      return $this->errorTypeLogin;
    }
  }

  public function checkErrorUserLogin(string $password, $user): array
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      if (empty(array_filter($this->errorTypeLogin, fn ($el) => $el != ''))) {

        if (!$user) {
          // Si l'adresse email n'est rattaché à aucun compte
          $this->errorUserLogin['errorEmail'] = ERROR_EMAIL_NOT_EXIST; 
        } elseif (!password_verify($password, $user['password'])) {
          // Si le mot de passe est incorrect
          $this->errorUserLogin['errorPassword'] = ERROR_PASSWORD_WRONG; 
        } elseif ($user['status'] === "disabled") {
          // Si le compte est désactivé
          $this->errorUserLogin["errorEmail"] = ERROR_ACCOUNT_DISABLE;
        }
      }
      return $this->errorUserLogin;
    }
  }

  public function checkErrorIfAdminAccount($user)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (empty(array_filter($this->errorUserLogin, fn ($el) => $el != ''))) {
        if (isset($user['type'])) {
          if ($user['type'] === "admin") {
            $this->errorIfAdminAccount['errorEmail'] = ERROR_ACCOUNT_TYPE;
          }
        }
      }
      return $this->errorIfAdminAccount;
    }
  }

  public function checkErrorIfUserAccount($user)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (empty(array_filter($this->errorUserLogin, fn ($el) => $el != ''))) {
        if (isset($user['type'])) {
          if (($user['type'] === "tech") || ($user['type'] === "Partner") || ($user['type'] === "Club")) {
            $this->errorIfUserAccount['errorEmail'] = ERROR_ACCOUNT_TYPE;
          }
        }
      }
      return $this->errorIfUserAccount;
    }
  }

  public function checkErrorTypeEmailDelete($email)
  {
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->errorTypeDelete['errorEmail'] = ERROR_EMAIL; 
    }
    return $this->errorTypeDelete;
  }

  public function checkErrorExistenceEmailDelete($userWantDelete)
  {
    if (empty(array_filter($this->errorTypeDelete, fn ($el) => $el != ''))) {
      if (!$userWantDelete) {
        $this->errorUserDelete['errorEmail'] = ERROR_EMAIL_NOT_EXIST; 
      } elseif ($userWantDelete['type'] === "Partner" || $userWantDelete['type'] === 'Club') {
        $this->errorUserDelete['errorEmail'] = ERROR_TECH_ACCOUNT_TYPE;
      }
    }
    return $this->errorUserDelete;
  }

  public function checkErrorAllInputAddAccount($allInput, $userAllReadyCreate)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $firstName = $allInput['firstName'] ?? '';
      $lastName = $allInput['lastName'] ?? '';
      $email = $allInput['email'] ?? '';
    
      if (!$firstName || mb_strlen($firstName) < 2) {
        $this->errorAdminAddAccount['errorFirstName'] = ERROR_LENGTH; 
      }

      if (!$lastName || mb_strlen($lastName) < 2) {
        $this->errorAdminAddAccount['errorLastName'] = ERROR_LENGTH; 
      }

      if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->errorAdminAddAccount['errorEmail'] = ERROR_EMAIL;
      } elseif ($userAllReadyCreate) {
        $this->errorAdminAddAccount['errorEmail'] = ERROR_EMAIL_ALREADY_USED;
      }
    }
    return $this->errorAdminAddAccount;
  }

  public function checkErrorCreateProfile($allInput, $userAllReadyCreate)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $firstName = $allInput['firstName'] ?? '';
      $lastName = $allInput['lastName'] ?? '';
      $email = $allInput['email'] ?? '';
      $compagnyName = $allInput['compagnyName'] ?? '';

      if (!$firstName || mb_strlen($firstName) < 2) {
        $this->errorCreateProfile['errorFirstName'] = ERROR_LENGTH; 
      }

      if (!$lastName || mb_strlen($lastName) < 2) {
        $this->errorCreateProfile['errorLastName'] = ERROR_LENGTH; 
      }

      if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->errorCreateProfile['errorEmail'] = ERROR_EMAIL;
      } elseif ($userAllReadyCreate) {
        $this->errorCreateProfile['errorEmail'] = ERROR_EMAIL_ALREADY_USED;
      }

      if (!$compagnyName || mb_strlen($compagnyName) < 2) {
        $this->errorCreateProfile['errorCompagnyName'] = ERROR_LENGTH; 
      }
    }
    return $this->errorCreateProfile;
  }

  public function checkImgFile($img)
  {
    $valideImgExtension = ["jpeg", "JPEG", "png", "PNG", "jpg", "JPG"];

    if (isset($img['img'])) {
      if ($img['img']['error'] === UPLOAD_ERR_INI_SIZE) {
        $this->errorImgFile = ERROR_IMG_SIZE;
      } elseif ($img['img']['error'] === UPLOAD_ERR_PARTIAL) {
        $this->errorImgFile = ERROR_IMG_DOWNLOAD;
      } elseif ($img['img']['error'] === UPLOAD_ERR_NO_FILE) {
        $this->errorImgFile = ERROR_IMG;
      } elseif ($img['img']['error'] === UPLOAD_ERR_EXTENSION) {
        $this->errorImgFile = ERROR_IMG_EXTENSION;
      } elseif ($img['img']['size'] > 2097152) {
        $this->errorImgFile = ERROR_IMG_SIZE;
      } elseif (!array_search(pathinfo($img['img']['name'], PATHINFO_EXTENSION), $valideImgExtension)) {
        $this->errorImgFile = UPLOAD_ERR_EXTENSION;
      }
    } else {
      $this->errorImgFile = ERROR_IMG;
    }
    return $this->errorImgFile;
  }

  public function checkUserPassword($oldPassword, $allInput)
  {
    if (!password_verify($allInput["oldPassword"], $oldPassword)) {
      $this->errorChangePassword["errorOldPassword"] = ERROR_PASSWORD_WRONG;
    }
    $this->errorChangePassword["errorNewPassword"] = $this->checkPassword($allInput['newPassword']);
    return $this->errorChangePassword;
  }

  public function checkUserDescription($newDescription)
  {
    if (!$newDescription) {
      $this->errorDesciption = ERROR_INPUT_EMPTY;
    } elseif (mb_strlen($newDescription) < 50) {
      $this->errorDesciption = ERROR_DESCRIPTION_LENGTH;
    }
    return $this->errorDesciption;
  }

  public function checkPassword($password)
  {
    // Permet de vérifier qu'il y a un moins un caractère en Majuscules
    $uppercase = preg_match('@[A-Z]@', $password);
    // Permet de vérifier qu'il y a un moins un caractère en Minuscule
    $lowercase = preg_match('@[a-z]@', $password);
    // Permet de vérifier qu'il y a un moins un nombre 
    $number    = preg_match('@[0-9]@', $password);
    // Permet de vérifier qu'il y a un caractère spécial
    $specialCharacter = preg_match('/[\'\/~`\!@#%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password);
    // Permet de définir la taille minimum du mot de passe
    $passwordLength = mb_strlen($password) > 7;

    $error = ERROR_PASSWORD_TYPE;

    if ((!$password) || (!$uppercase) || (!$lowercase) || (!$number) ||  (!$passwordLength) || (!$specialCharacter)) {
      return $error;
    } else return "";
  }


}







