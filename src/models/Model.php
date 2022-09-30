<?php

namespace App\models\Model;

require_once('src/lib/Database.php');

use App\lib\Database\DatabaseConnection;

class Model
{
  public DatabaseConnection $dbh;
  public string $filePath = "./data/permissions.json";

  public function retrieveUserProfile($userType, $idUser)
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

  public function retrievePartnerWithId($idProfile)
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

  public function retrieveClubWithIdClub($idClub)
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

  public function retrieveAllClubsAssociatedWithPartner($franchiseName)
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

  public function retrievePermissions($idPermission)
  {
    if (file_exists($this->filePath)) {
      // Permet de récupérer le contenu du fichier permission 
      $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
      // Permet de récupérer l'index en fonction du profile demandé
      $indexPermissions = array_search($idPermission, array_column($permissions, "idPermission"));
      // Permet de retourner les permissions du profile demandé
      $profilePermissions = $permissions[$indexPermissions];
      return $profilePermissions;
    }
  }

  public function retrieveImgPath($userType, $idUser)
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

  public function deleteOldImg($oldImgName)
  {
    $defaultPicture = "./public/img/icons/icon-photo.png";
    if ($oldImgName === $defaultPicture) {
      return;
    } else {
      unlink($oldImgName);
    }
  }

  public function createRandomPassword($length)
  {
    do {
      $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@&=+*%!?";
      $shfl = str_shuffle($comb);
      $password = substr($shfl, 0, $length);

      // Permet de vérifier qu'il y a un moins un caractère en Majuscules
      $uppercase = preg_match('@[A-Z]@', $password);
      // Permet de vérifier qu'il y a un moins un caractère en Minuscule
      $lowercase = preg_match('@[a-z]@', $password);
      // Permet de vérifier qu'il y a un moins un nombre 
      $number = preg_match('@[0-9]@', $password);
      // Permet de vérifier qu'il y a un caractère spécial
      $specialCharacter = preg_match('/[\'\/~`\!@#%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password);
    } while (!$specialCharacter || !$number || !$lowercase || !$uppercase);

    return $password;
  }
}
