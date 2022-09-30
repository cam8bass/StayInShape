<?php

namespace App\models\ModelTech;

require_once('src/lib/Database.php');
require_once('src/models/Model.php');

use App\lib\Database\DatabaseConnection;
use App\models\Model\Model;

class ModelTech extends Model
{
  public DatabaseConnection $dbh;

  public function createUser(array $newPartner, string $type)
  {
    $statementCreateUser = $this->dbh->connectDb()->prepare("INSERT INTO user VALUES(
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
    $statementCreateUser->bindValue(":firstName", ucfirst(strtolower(trim($newPartner['firstName']))));
    $statementCreateUser->bindValue(":lastName", ucfirst(strtolower(trim($newPartner['lastName']))));
    $statementCreateUser->bindValue(":email",  $newPartner['email']);
    $statementCreateUser->bindValue(":password", trim($newPartner['password']));
    $statementCreateUser->bindValue(":type", "$type");
    $statementCreateUser->bindValue(":status", "disabled");
    $statementCreateUser->bindValue(":read", 1);
    $statementCreateUser->bindValue(":write", 0);
    $statementCreateUser->bindValue(":create", 0);
    $statementCreateUser->execute();
    return $this->dbh->connectDb()->lastInsertId();
  }

  public function createPartner(string $idPartner, array $newPartner)
  {
    $statementCreatePartner = $this->dbh->connectDb()->prepare("INSERT INTO partner VALUES(
      :idPartner,
      :franchiseName,
      :attachedClub,
      :img,
      :description
    )");
    $statementCreatePartner->bindValue(":idPartner", $idPartner);
    $statementCreatePartner->bindValue(":franchiseName", ucfirst(strtolower(trim($newPartner['compagnyName']))));
    $statementCreatePartner->bindValue(":attachedClub", "");
    $statementCreatePartner->bindValue(":img", "./public/img/icons/icon-photo.png");
    $statementCreatePartner->bindValue(":description", "");
    $statementCreatePartner->execute();
    return $statementCreatePartner->fetch();
  }

  public function createClub(string $idClub, array $newClub, string $idPermission, string $activationKey)
  {
    $statementCreateClub = $this->dbh->connectDb()->prepare("INSERT INTO club VALUES(
      :idClub,
      :idPermission,
      :idPartnerParent,
      :clubName,
      :nameFranchiseOwner,
      :img,
      :description,
      :numActive

    )");
    $statementCreateClub->bindValue(":idClub", $idClub);
    $statementCreateClub->bindValue(":idPermission", $idPermission);
    $statementCreateClub->bindValue(":idPartnerParent", $newClub['idPartnerParent']);
    $statementCreateClub->bindValue(":clubName", ucfirst(strtolower(trim($newClub['compagnyName']))));
    $statementCreateClub->bindValue(":nameFranchiseOwner", $newClub['nameFranchiseOwner']);
    $statementCreateClub->bindValue(":img",  "./public/img/icons/icon-photo.png");
    $statementCreateClub->bindValue(":description", "");
    $statementCreateClub->bindValue(":numActive", $activationKey);
    $statementCreateClub->execute();
    return $statementCreateClub->fetch();
  }

  public function deleteUser(string $idProfile)
  {
    $statementDeleteUser = $this->dbh->connectDb()->prepare("DELETE FROM user WHERE id=:idProfile");
    $statementDeleteUser->bindValue(":idProfile", $idProfile);
    $statementDeleteUser->execute();
  }

  public function deleteProfilePartner(string $idPartner)
  {
    $statementDeleteProfilePartner = $this->dbh->connectDb()->prepare("DELETE FROM partner WHERE idPartner=:idPartner");
    $statementDeleteProfilePartner->bindValue(":idPartner", $idPartner);
    $statementDeleteProfilePartner->execute();
  }

  public function deleteProfileClub(string $idClub)
  {
    $statementDeleteProfileClub = $this->dbh->connectDb()->prepare("DELETE FROM club WHERE idClub=:idClub");
    $statementDeleteProfileClub->bindValue(":idClub", $idClub);
    $statementDeleteProfileClub->execute();
  }

  public function changeStatus(string $idProfile, string $newStatus)
  {
    $statementChangeStatus = $this->dbh->connectDb()->prepare("UPDATE user SET status=:newStatus  WHERE id=$idProfile");
    $statementChangeStatus->bindValue(":newStatus", $newStatus);
    $statementChangeStatus->execute();
  }

  public function selectAllPartners()
  {
    $statementSelectAllPartners = $this->dbh->connectDb()->prepare("SELECT idPartner,firstName,lastName,email,type,franchiseName,status,attachedClub,img
    FROM user
    JOIN partner
    ON user.id=partner.idPartner
    WHERE user.type='Partner' ");
    $statementSelectAllPartners->execute();
    return $statementSelectAllPartners->fetchAll();
  }

  public function selectAllClubs()
  {
    $statementSelectAllClubs = $this->dbh->connectDb()->prepare("SELECT firstName,lastName,email,type,idClub,clubName,nameFranchiseOwner, status,img
    FROM user
    JOIN club
    ON user.id=club.idClub
    WHERE user.type='Club'");
    $statementSelectAllClubs->execute();
    return $statementSelectAllClubs->fetchAll();
  }

  public function retrieveUserStatus(string $idProfile)
  {
    $statementRetrieveUserStatus = $this->dbh->connectDb()->prepare("SELECT status from user WHERE id=$idProfile");
    $statementRetrieveUserStatus->execute();
    return $statementRetrieveUserStatus->fetch();
  }

  public function retrieveAttachedClubToPartner(string $idPartner)
  {
    $statementRetrieveAttachedClubToPartner = $this->dbh->connectDb()->prepare("SELECT attachedClub FROM partner
     WHERE idPartner=:idPartner");
    $statementRetrieveAttachedClubToPartner->bindValue(":idPartner", $idPartner);
    $statementRetrieveAttachedClubToPartner->execute();
    return $statementRetrieveAttachedClubToPartner->fetch();
  }

  public function retrievePartnerWithFranchiseName(string $newFranchiseName)
  {
    $statementRetrievePartnerWithFranchiseName = $this->dbh->connectDb()->prepare("SELECT idPartner FROM partner WHERE franchiseName=:franchiseName");
    $statementRetrievePartnerWithFranchiseName->bindValue(":franchiseName", $newFranchiseName);
    $statementRetrievePartnerWithFranchiseName->execute();
    return $statementRetrievePartnerWithFranchiseName->fetch();
  }

  public function retrieveAllFranchiseNames()
  {
    $statementRetrieveAllFranchiseNames = $this->dbh->connectDb()->prepare("SELECT franchiseName FROM partner ");
    $statementRetrieveAllFranchiseNames->execute();
    return $statementRetrieveAllFranchiseNames->fetchAll();
  }

  public function retrieveIdProfileParent(string $idClub)
  {
    $statementRetrieveIdProfileParent = $this->dbh->connectDb()->prepare("SELECT idPartnerParent FROM club WHERE idClub=:idClub");
    $statementRetrieveIdProfileParent->bindValue(":idClub", $idClub);
    $statementRetrieveIdProfileParent->execute();
    return $statementRetrieveIdProfileParent->fetch();
  }

  public function updatePermissions(string $newIdPermission, string $idClub)
  {
    $statementUpdatePermissions = $this->dbh->connectDb()->prepare("UPDATE club SET idPermission = :newIdPermission WHERE idClub=$idClub ");
    $statementUpdatePermissions->bindValue(":newIdPermission", $newIdPermission);
    $statementUpdatePermissions->execute();
    return $statementUpdatePermissions->fetch();
  }

  public function addClubToParentPartner(string $idPartner, string $idClub)
  {
    $statementAddClubToParentPartner = $this->dbh->connectDb()->prepare("UPDATE partner SET attachedClub= :idClub
     WHERE idPartner=:idPartner");
    $statementAddClubToParentPartner->bindValue(":idPartner", $idPartner);
    $statementAddClubToParentPartner->bindValue(":idClub", $idClub);
    $statementAddClubToParentPartner->execute();
  }

  public function changeClubProfileAfterChangeOwner(string $idClub, string $newIdPartner, string $newFranchiseName)
  {
    $statementChangeClubProfileAfterChangeOwner = $this->dbh->connectDb()->prepare("UPDATE club
     SET idPartnerParent=:newIdPartnerParent, nameFranchiseOwner=:newNameFranchiseOwner
     WHERE idClub=:idClub");
    $statementChangeClubProfileAfterChangeOwner->bindValue(":newIdPartnerParent", $newIdPartner);
    $statementChangeClubProfileAfterChangeOwner->bindValue(":newNameFranchiseOwner", $newFranchiseName);
    $statementChangeClubProfileAfterChangeOwner->bindValue(":idClub", $idClub);
    $statementChangeClubProfileAfterChangeOwner->execute();
  }

  public function checkAllInputCreateProfile(array $allInput): array
  {
    $allInput = filter_input_array(INPUT_POST, [
      "firstName" => FILTER_SANITIZE_SPECIAL_CHARS,
      "lastName" => FILTER_SANITIZE_SPECIAL_CHARS,
      "email" => FILTER_SANITIZE_EMAIL,
      "compagnyName" => FILTER_SANITIZE_SPECIAL_CHARS,
    ]);

    return $allInput ?? [];
  }

  public function createPermissionsFile(array $clubPermissions)
  {
    $permissions = [];
    $id = time();
    if (file_exists($this->filePath)) {
      $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
    }

    $permissions = [
      ...$permissions, [
        'permissions' => $clubPermissions,
        'idPermission' => $id
      ]
    ];
    file_put_contents($this->filePath, json_encode($permissions));
    return $id;
  }

  public function modifyPermissionsFile(string $oldIdPermissions, array $newPermission)
  {
    if (file_exists($this->filePath)) {
      // Permet de récupérer le contenu du fichier permission 
      $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
      // Permet de créer un nouvelle id
      $newId = time();
      // Permet de remplacer les anciennes permissions par les nouvelles
      $indexOldPermissions = array_search($oldIdPermissions, array_column($permissions, "idPermission"));
      $permissions[$indexOldPermissions] = [
        'permissions' => $newPermission,
        'idPermission' => $newId
      ];
      file_put_contents($this->filePath, json_encode($permissions));
      return $newId;
    }
  }

  public function deletePermissions(string $oldIdPermissions)
  {
    // Permet de récupérer le contenu du fichier permission 
    $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
    // Permet de récupérer l'index de permissions à supprimer
    $indexOldPermissions = array_search($oldIdPermissions, array_column($permissions, "idPermission"));
    // Permet de supprimer les permissions du profile
    unset($permissions[$indexOldPermissions]);
    $permissions = [...$permissions];
    // // Permet de sauvegarder les modifications de supression
    file_put_contents($this->filePath, json_encode($permissions));
  }
}
