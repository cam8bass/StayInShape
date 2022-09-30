<?php

namespace App\models\ModelSession;

require_once('src/lib/Database.php');

use App\lib\Database\DatabaseConnection;

class ModelSession
{
  public DatabaseConnection $dbh;

  /**
   * create new session 
   * @param array $user user profile
   * @param string $idSession
   */
  public function createNewSession(array $user, string $idSession)
  {
    $statementCreateNewSession = $this->dbh->connectDb()->prepare("INSERT INTO session (idSession,idUser) VALUES(
      :idSession,
      :idUser
      )");
    $statementCreateNewSession->bindValue(":idSession", $idSession);
    $statementCreateNewSession->bindValue(":idUser", $user['id']);
    $statementCreateNewSession->execute();
  }

  /**
   * delete current session
   * @param string $idSession
   */
  public function deleteSession(string $idSession)
  {
    $statementDeleteSession = $this->dbh->connectDb()->prepare('DELETE FROM session WHERE idSession=:idSession');
    $statementDeleteSession->bindValue("idSession", $idSession);
    $statementDeleteSession->execute();
  }

  /**
   * find user profiles with their email address
   * @param string $email
   * @return array user profile
   */
  public function retrieveUserWithEmail(string $email)
  {
    $statementRetrieveUserWithEmail = $this->dbh->connectDb()->prepare("SELECT * FROM user WHERE email=:email");
    $statementRetrieveUserWithEmail->bindValue(":email", $email);
    $statementRetrieveUserWithEmail->execute();
    return $statementRetrieveUserWithEmail->fetch();
  }

  /**
   * returns the profile of the connected user
   * @param string $idUser
   * @return array current user
   */
  public function readUser(string $idUser)
  {
    $statementReadUser = $this->dbh->connectDb()->prepare("SELECT id,firstName,lastName,email,type,status,user.read,user.write,user.create
    FROM user
    WHERE id=:idUser");
    $statementReadUser->bindValue(":idUser", $idUser);
    $statementReadUser->execute();
    return $statementReadUser->fetch();
  }

  /**
   * retrieve session information
   * @param string $idSession
   * @return array session data
   */
  public function readSession(string $idSession)
  {
    $statementreadSession = $this->dbh->connectDb()->prepare("SELECT * FROM session WHERE idSession=:idSession");
    $statementreadSession->bindValue(":idSession", $idSession);
    $statementreadSession->execute();
    return $statementreadSession->fetch();
  }

  /**
   * filter connection information
   * @param array $allInput 
   * @return array $allInput cleaned end checked
   */
  public function checkAllInputLogin(array $allInput): array
  {
    $allInput = filter_input_array(INPUT_POST, [
      "email" => FILTER_SANITIZE_EMAIL,
      "password" => FILTER_SANITIZE_SPECIAL_CHARS
    ]);

    return $allInput ?? [];
  }


  /**
   * check if the login information is correct
   * @param array $errorLogin error login 
   * @param array $user user profile
   */
  public function loginUser(array $errorLogin, array $user): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Si le compte existe et que le password est correct
      if (empty(array_filter($errorLogin, fn ($el) => $el != ''))) {
        // Permets de créer un id pour la session
        $idSession = bin2hex(random_bytes(32));
        // Permets d'envoyer l'id dans la session côté Bdd
        $this->createNewSession($user, $idSession);
        //  Permets de créer 2 cookies (signature et session)
        $signature = hash_hmac('sha256', $idSession, "82b9cca8c89955d90458c1420d9399b16bc83c8e7c58f709b4f3022a430a0d4fd421993ef5ecc2553798044f4b5c98f23f9215b9dd84bab0fba9b332e48d7087");
        setcookie('signature', $signature, time() + 60 * 60 * 24 * 14, '/', '', false, true);
        setcookie('session', $idSession, time() + 60 * 60 * 24 * 14, '/', '', false, true);
      }
    }
  }

  public function isLoggedin()
  {
    $idSession = $_COOKIE['session'] ?? '';
    $signature = $_COOKIE['signature'] ?? '';

    if ($idSession && $signature) {
      $hash = hash_hmac('sha256', $idSession, "82b9cca8c89955d90458c1420d9399b16bc83c8e7c58f709b4f3022a430a0d4fd421993ef5ecc2553798044f4b5c98f23f9215b9dd84bab0fba9b332e48d7087");

      if (hash_equals($hash, $signature)) {
        $session = $this->readSession($idSession);
        if ($session) {
          $currentUser = $this->readUser($session['idUser']);
        }
      }
    }
    return $currentUser ?? false;
  }

  /**
   * user logout
   * @param string $idSession
   */
  public function logout(string $idSession)
  {
    $this->deleteSession($idSession);
    setcookie('session', '', time() - 1, "/");
    setcookie('signature', '', time() - 1, "/");
    unset($_SESSION['currentUser']);
    session_destroy();
    return;
  }
}
