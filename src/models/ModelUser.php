<?php

namespace App\models\ModelUser;

require_once('src/lib/Database.php');
require_once('src/models/Model.php');

use App\lib\Database\DatabaseConnection;
use App\models\Model\Model;

class ModelUser extends Model
{
  public DatabaseConnection $dbh;
  public string $imgPath = "./data/uploads/";



  /**
   * recover password user
   * @param string $idUser
   * @return array user password
   */
  public function retrieveUserPassword(string $idUser)
  {
    $statementRetrieveUserPassword = $this->dbh->connectDb()->prepare("SELECT password FROM user WHERE id=:idUser");
    $statementRetrieveUserPassword->bindValue(":idUser", $idUser);
    $statementRetrieveUserPassword->execute();
    return $statementRetrieveUserPassword->fetch();
  }

  /**
   * retrieve old user description
   * @param string $userType club or partner
   * @param string $idUser
   * @return array user description
   */
  public function retrieveUserDescription(string $userType, string $idUser)
  {
    if ($userType === "Partner") {
      $statementRetrieveUserDescription = $this->dbh->connectDb()->prepare("SELECT description 
      FROM user
      JOIN partner
      ON user.id=partner.idPartner
      WHERE id=:idUser");
    } elseif ($userType === "Club") {
      $statementRetrieveUserDescription = $this->dbh->connectDb()->prepare("SELECT description 
      FROM user
      JOIN club
      ON user.id=club.idClub
      WHERE id=:idUser");
    }
    $statementRetrieveUserDescription->bindValue(":idUser", $idUser);
    $statementRetrieveUserDescription->execute();
    return $statementRetrieveUserDescription->fetch();
  }

  /**
   * change user profile picture
   * @param string $userType club or partner
   * @param string $newImg img path
   * @param string $idClub
   */
  public function changePathImg(string $userType, string $newImg, string $idClub)
  {
    if ($userType === "Club") {
      $statementChangePathImg = $this->dbh->connectDb()->prepare("UPDATE club SET img=:newImg WHERE idClub=:idUser ");
    } elseif ($userType === "Partner") {
      $statementChangePathImg = $this->dbh->connectDb()->prepare("UPDATE partner SET img=:newImg WHERE idPartner=:idUser");
    }
    $statementChangePathImg->bindValue(":newImg", $newImg);
    $statementChangePathImg->bindValue(":idUser", $idClub);
    $statementChangePathImg->execute();
  }

  /**
   * change user password
   * @param string $idUser
   * @param string $newPassword
   */
  public function changeUserPassword(string $idUser, string $newPassword)
  {
    $statementChangeUserPassword = $this->dbh->connectDb()->prepare("UPDATE user SET password=:newPassword WHERE id=:idUser");
    $statementChangeUserPassword->bindValue("idUser", $idUser);
    $statementChangeUserPassword->bindValue(":newPassword", $newPassword);
    $statementChangeUserPassword->execute();
  }

  /**
   * edit user description
   * @param string $newDescription
   * @param string $userType club or partner
   * @param string $idUser
   */
  public function changeUserDescription(string $newDescription, string $userType, string $idUser)
  {
    if ($userType === "Partner") {
      $statementChangeUserDescription = $this->dbh->connectDb()->prepare("UPDATE partner SET description=:newDescription WHERE idPartner=:idUser ");
    } elseif ($userType === "Club") {
      $statementChangeUserDescription = $this->dbh->connectDb()->prepare("UPDATE club SET description=:newDescription WHERE idClub=:idUser ");
    }
    $statementChangeUserDescription->bindValue(":newDescription", trim($newDescription));
    $statementChangeUserDescription->bindValue(":idUser", $idUser);
    $statementChangeUserDescription->execute();
  }

  /**
   * retrieve account activation key
   * @param string $idClub
   * @return array activation key
   */
  public function retrieveActicationKey(string $idClub)
  {
    $statementRetrieveActivationKey = $this->dbh->connectDb()->prepare("SELECT numActive FROM club WHERE idClub=$idClub");
    $statementRetrieveActivationKey->execute();
    return $statementRetrieveActivationKey->fetch();
  }

  /**
   * modify status of the activation key
   * @param string $idClub
   */
  public function sendActivation(string $idClub)
  {
    $statementSendActivationKey = $this->dbh->connectDb()->prepare("UPDATE club SET numActive=:activationKey WHERE idClub=$idClub");
    $statementSendActivationKey->bindValue(":activationKey", "activated");
    return $statementSendActivationKey->execute();
  }

  /**
   * activate club account
   * @param string $idClub
   */
  public function accountActivation(string $idClub)
  {
    $statementAccountActivation = $this->dbh->connectDb()->prepare("UPDATE user SET status=:active WHERE id=$idClub ");
    $statementAccountActivation->bindValue(':active', "enabled");
    $statementAccountActivation->execute();
  }

  /**
   * save a new picture profile
   * @param array $imgDownload
   * @return string new img path
   */
  public function saveImg(array $imgDownload)
  {
    $idImg = uniqid();
    $imgExtension = pathinfo($imgDownload['img']['name'], PATHINFO_EXTENSION);
    $imgName = explode('.', $imgDownload['img']['name']);
    // Permets de définir le nom de l'image, si l'image ne possède pas de nom alors id généré sera défini en tant que nom
    $newImgName =  !trim($imgName[0]) ? $idImg . "." . $imgExtension : strtolower(str_replace(" ", "", $imgName[0])) . "-" . $idImg . "." . $imgExtension;
    // Permets de sauvegarder la nouvelle image
    move_uploaded_file($imgDownload['img']['tmp_name'], $this->imgPath . $newImgName);
    return $this->imgPath . $newImgName;
  }

  /**
   * check data when changing password
   * @param array $allInput
   * @return array all input
   */
  public function checkUserChangePassword(array $allInput): array
  {
    $allInput = filter_input_array(INPUT_POST, [
      "newPassword" => FILTER_SANITIZE_SPECIAL_CHARS,
      "oldPassword" => FILTER_SANITIZE_SPECIAL_CHARS
    ]);
    return $allInput ?? [];
  }

  /**
   * check new user description
   * @param array $input new desciption
   * @return array $new description
   */
  public function checkUserDescription(array $input)
  {
    $newDescription = filter_input_array(INPUT_POST, [
      "description" => FILTER_SANITIZE_SPECIAL_CHARS
    ]);
    return $newDescription['description'] ?? "";
  }
}
