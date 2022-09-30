<?php

namespace App\models\Model;

require_once('src/lib/Database.php');

use App\lib\Database\DatabaseConnection;

class Model
{
  public DatabaseConnection $dbh;
  public string $filePath = "./data/permissions.json";

  /**
   * find user's profile
   * @param string $userType (club,partner)
   * @param string $idUser
   * @return array user profile
   */
  public function retrieveUserProfile(string $userType, string $idUser)
  {
    if ($userType === "Club") {
      $statementRetrieveUserProfile = $this->dbh->connectDb()->prepare("SELECT firstName, lastName,email,clubName,nameFranchiseOwner,description,img,status,type
      FROM user 
      JOIN club
      ON user.id=club.idClub
      WHERE id=:idUser ");
    } elseif ($userType === "Partner") {
      $statementRetrieveUserProfile = $this->dbh->connectDb()->prepare("SELECT firstName,lastName,email,franchiseName,description,img,status,type
      FROM user
      JOIN partner
      ON user.id=partner.idPartner
      WHERE id=:idUser");
    }
    $statementRetrieveUserProfile->bindValue(":idUser", $idUser);
    $statementRetrieveUserProfile->execute();
    return $statementRetrieveUserProfile->fetch();
  }

  /**
   * find partner account with id
   * @param string $idProfile
   * @return array partner profile
   */
  public function retrievePartnerWithId(string $idProfile)
  {
    $statementRetrievePartnerWithId = $this->dbh->connectDb()->prepare("SELECT idPartner, firstName,lastName,email,type, status, franchiseName,attachedClub,img
    FROM user 
    JOIN partner
    ON user.id=partner.idPartner
    WHERE user.id=:idProfile ");
    $statementRetrievePartnerWithId->bindValue(":idProfile", $idProfile);
    $statementRetrievePartnerWithId->execute();
    return $statementRetrievePartnerWithId->fetch();
  }

  /**
   * find club account with id
   * @param string $idClub
   * @return array club profile
   */
  public function retrieveClubWithIdClub(string $idClub)
  {
    $statementRetrieveClubWithIdClub = $this->dbh->connectDb()->prepare("SELECT idPermission,idPartnerParent,clubName,idClub,firstName,lastName,email,type,status,img,nameFranchiseOwner
    FROM user
    JOIN club
    ON user.id=club.idClub
    WHERE user.id=:idClub");
    $statementRetrieveClubWithIdClub->bindValue(":idClub", $idClub);
    $statementRetrieveClubWithIdClub->execute();
    return $statementRetrieveClubWithIdClub->fetch();
  }

  /**
   * find all clubs attached to partner
   * @param string $franchiseName the name of the responsible franchise
   * @return array club an array with clubs owned by partner
   */
  public function retrieveAllClubsAssociatedWithPartner(string $franchiseName)
  {
    $statementRetrieveAllClubsAssociatedWithPartner = $this->dbh->connectDb()->prepare("SELECT clubName, firstName, lastName, email, type, nameFranchiseOwner, status, img,idClub
    FROM user
    Join club
    ON user.id=club.idClub
    WHERE club.nameFranchiseOwner=:franchiseName");
    $statementRetrieveAllClubsAssociatedWithPartner->bindValue(":franchiseName", $franchiseName);
    $statementRetrieveAllClubsAssociatedWithPartner->execute();
    return $statementRetrieveAllClubsAssociatedWithPartner->fetchAll();
  }

  /**
   * find permissions of the selected club
   * @param string $idPermission id attached to the permissions
   * @return array an array with club permissions
   */
  public function retrievePermissions(string $idPermission)
  {
    if (file_exists($this->filePath)) {
      // Permets de récupérer le contenu du fichier permission 
      $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
      // Permets de récupérer l'index en fonction du profil demandé
      $indexPermissions = array_search($idPermission, array_column($permissions, "idPermission"));
      // Permets de retourner les permissions du profil demandé
      $profilePermissions = $permissions[$indexPermissions];
      return $profilePermissions;
    }
  }

  /**
   * find the user's profile picture
   * @param string $userType (club,partner)
   * @param string $idUser
   * @return array img path
   */
  public function retrieveImgPath(string $userType, string $idUser)
  {
    if ($userType === "Club") {
      $statementRetrieveImgPath = $this->dbh->connectDb()->prepare("SELECT img FROM club WHERE idClub=:idUser");
    } elseif ($userType === "Partner") {
      $statementRetrieveImgPath = $this->dbh->connectDb()->prepare("SELECT img FROM partner WHERE idPartner=:idUser");
    }
    $statementRetrieveImgPath->bindValue(":idUser", $idUser);
    $statementRetrieveImgPath->execute();
    return $statementRetrieveImgPath->fetch();
  }

  /**
   * delete old user image
   * @param string $oldImgName path old img
   */
  public function deleteOldImg(string $oldImgName)
  {
    $defaultPicture = "./public/img/icons/icon-photo.png";
    if ($oldImgName === $defaultPicture) {
      return;
    } else {
      unlink($oldImgName);
    }
  }

  /**
   * create random password
   * @param int $length define password length
   * @return string  new password
   */
  public function createRandomPassword(int $length)
  {
    do {
      $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@=+*%!?";
      $shfl = str_shuffle($comb);
      $password = substr($shfl, 0, $length);

      // Permets de vérifier qu'il y a un moins un caractère en Majuscules
      $uppercase = preg_match('@[A-Z]@', $password);
      // Permets de vérifier qu'il y a un moins un caractère en Minuscule
      $lowercase = preg_match('@[a-z]@', $password);
      // Permets de vérifier qu'il y a un moins un nombre 
      $number = preg_match('@[0-9]@', $password);
      // Permets de vérifier qu'il y a un caractère spécial
      $specialCharacter = preg_match('/[\'\/~`\!@#%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password);
    } while (!$specialCharacter || !$number || !$lowercase || !$uppercase);

    return $password;
  }
}
