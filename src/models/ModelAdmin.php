<?php

namespace App\models\ModelAdmin;

require_once('src/lib/Database.php');
require_once('src/models/Model.php');

use App\lib\Database\DatabaseConnection;
use App\models\Model\Model;

class ModelAdmin extends Model
{
  public DatabaseConnection $dbh;

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

  public function deleteAccount(string $email): string
  {
    $statementDeleteAccount = $this->dbh->connectDb()->prepare("DELETE FROM user WHERE email=:email");
    $statementDeleteAccount->bindValue(":email", $email);
    $statementDeleteAccount->execute();
    return $email;
  }

  public function checkAllInputAddAccount(array $allInput): array
  {
    $allInput = filter_input_array(INPUT_POST, [
      "firstName" => FILTER_SANITIZE_SPECIAL_CHARS,
      "lastName" => FILTER_SANITIZE_SPECIAL_CHARS,
      "email" => FILTER_SANITIZE_EMAIL,
    ]);

    return $allInput ?? [];
  }

  public function checkEmail(array $input): string
  {
    $input = filter_input_array(INPUT_POST, [
      "email" => FILTER_SANITIZE_EMAIL
    ]);

    $email = $input['email'] ?? '';
    return $email;
  }

  public function selectUserTech(): array
  {
    $statementSelectUserTech = $this->dbh->connectDb()->prepare("SELECT firstName, lastName, email FROM user WHERE type=:userType");
    $statementSelectUserTech->bindValue(':userType', 'tech');
    $statementSelectUserTech->execute();
    return $statementSelectUserTech->fetchAll();
  }
}
