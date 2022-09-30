<?php

namespace App\models\ModelAdmin;

require_once('src/lib/Database.php');
require_once('src/models/Model.php');

use App\lib\Database\DatabaseConnection;
use App\models\Model\Model;

class ModelAdmin extends Model
{
  public DatabaseConnection $dbh;
  /**
   * create new account for a technician
   * @param array $newUser new user profile
   * @return array profile
   */
  public function createAccount(array $newUser)
  {
    $statementCreateAccount = $this->dbh->connectDb()->prepare("INSERT INTO user VALUES(
      DEFAULT,
      :firstName,
      :lastName,
      :email,
      :password,
      :type,
      :status,
      :read,
      :write,
      :create
  )");
    $statementCreateAccount->bindValue(":firstName", ucfirst(strtolower(trim($newUser['firstName']))));
    $statementCreateAccount->bindValue(":lastName", ucfirst(strtolower(trim($newUser['lastName']))));
    $statementCreateAccount->bindValue(":email", $newUser['email']);
    $statementCreateAccount->bindValue(":password", trim($newUser['password']));
    $statementCreateAccount->bindValue(":type", "tech");
    $statementCreateAccount->bindValue(":status", "enabled");
    $statementCreateAccount->bindValue(":read", 1);
    $statementCreateAccount->bindValue(":write", 1);
    $statementCreateAccount->bindValue(":create", 0);
    $statementCreateAccount->execute();
    return $statementCreateAccount->fetch();
  }

  /**
   * delete a technician account
   * @param string $email
   * @return string $email
   */
  public function deleteAccount(string $email): string
  {
    $statementDeleteAccount = $this->dbh->connectDb()->prepare("DELETE FROM user WHERE email=:email");
    $statementDeleteAccount->bindValue(":email", $email);
    $statementDeleteAccount->execute();
    return $email;
  }

  /**
   * check form
   * @param array $allInput content of form
   * @return array all form content
   */
  public function checkAllInputAddAccount(array $allInput): array
  {
    $allInput = filter_input_array(INPUT_POST, [
      "firstName" => FILTER_SANITIZE_SPECIAL_CHARS,
      "lastName" => FILTER_SANITIZE_SPECIAL_CHARS,
      "email" => FILTER_SANITIZE_EMAIL,
    ]);

    return $allInput ?? [];
  }

  /**
   * check email 
   * @param array $input email address
   * @return string email
   */
  public function checkEmail(array $input): string
  {
    $input = filter_input_array(INPUT_POST, [
      "email" => FILTER_SANITIZE_EMAIL
    ]);

    $email = $input['email'] ?? '';
    return $email;
  }

  /**
   * search all technician profiles
   *@return array  all technicien profiles
   */
  public function selectUserTech(): array
  {
    $statementSelectUserTech = $this->dbh->connectDb()->prepare("SELECT firstName, lastName, email FROM user WHERE type=:userType");
    $statementSelectUserTech->bindValue(':userType', 'tech');
    $statementSelectUserTech->execute();
    return $statementSelectUserTech->fetchAll();
  }
}
