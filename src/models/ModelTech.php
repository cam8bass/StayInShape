<?php

namespace App\models\ModelTech;

require_once('src/lib/Database.php');
require_once('src/models/Model.php');

use App\lib\Database\DatabaseConnection;
use App\models\Model\Model;

class ModelTech extends Model
{
  public DatabaseConnection $dbh;

  /**
   * create new user profile, send to the user table 
   * @param array $newPartner new partner profile
   * @param string $type type of user 
   * @return string id user
   */
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

  /**
   * create new partner and send data to the partner table
   * @param string $idPartner
   * @param array $newPartner
   * @return array new partner profile 
   */
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

  /**
   * create new club and send data to the club table
   * @param string $idClub
   * @param array $newClub
   * @param string $idPermission
   * @param string $activation key
   * @return array new club profile
   */
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

  /**
   * delete user
   * @param string $idProfile
   */
  public function deleteUser(string $idProfile)
  {
    $statementDeleteUser = $this->dbh->connectDb()->prepare("DELETE FROM user WHERE id=:idProfile");
    $statementDeleteUser->bindValue(":idProfile", $idProfile);
    $statementDeleteUser->execute();
  }

  /**
   * delete partner profile in partner table
   * @param string $idPartner
   */
  public function deleteProfilePartner(string $idPartner)
  {
    $statementDeleteProfilePartner = $this->dbh->connectDb()->prepare("DELETE FROM partner WHERE idPartner=:idPartner");
    $statementDeleteProfilePartner->bindValue(":idPartner", $idPartner);
    $statementDeleteProfilePartner->execute();
  }

  /**
   * delete club profile in club table
   * @param string $idClub
   */
  public function deleteProfileClub(string $idClub)
  {
    $statementDeleteProfileClub = $this->dbh->connectDb()->prepare("DELETE FROM club WHERE idClub=:idClub");
    $statementDeleteProfileClub->bindValue(":idClub", $idClub);
    $statementDeleteProfileClub->execute();
  }

  /**
   * enable or disable user profiles
   * @param string $idProfile
   * @param string $newStatus
   */
  public function changeStatus(string $idProfile, string $newStatus)
  {
    $statementChangeStatus = $this->dbh->connectDb()->prepare("UPDATE user SET status=:newStatus  WHERE id=$idProfile");
    $statementChangeStatus->bindValue(":newStatus", $newStatus);
    $statementChangeStatus->execute();
  }

  /**
   * retrieve all partner profile
   * @return array all partner
   */
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

  /**
   * retrive all club profile
   * @return array all club
   */
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

  /**
   * retrieve user status
   * @param string $idProfile
   * @return array user status
   */
  public function retrieveUserStatus(string $idProfile)
  {
    $statementRetrieveUserStatus = $this->dbh->connectDb()->prepare("SELECT status from user WHERE id=$idProfile");
    $statementRetrieveUserStatus->execute();
    return $statementRetrieveUserStatus->fetch();
  }

  /**
   * retrieve list of all clubs owned by partners
   * @param string $idPartner
   * @return array all attached club
   */
  public function retrieveAttachedClubToPartner(string $idPartner)
  {
    $statementRetrieveAttachedClubToPartner = $this->dbh->connectDb()->prepare("SELECT attachedClub FROM partner
     WHERE idPartner=:idPartner");
    $statementRetrieveAttachedClubToPartner->bindValue(":idPartner", $idPartner);
    $statementRetrieveAttachedClubToPartner->execute();
    return $statementRetrieveAttachedClubToPartner->fetch();
  }

  /**
   * find partner profile with franchise name
   * @param string $newFranchiseName
   * @return array partner profile
   */
  public function retrievePartnerWithFranchiseName(string $newFranchiseName)
  {
    $statementRetrievePartnerWithFranchiseName = $this->dbh->connectDb()->prepare("SELECT idPartner FROM partner WHERE franchiseName=:franchiseName");
    $statementRetrievePartnerWithFranchiseName->bindValue(":franchiseName", $newFranchiseName);
    $statementRetrievePartnerWithFranchiseName->execute();
    return $statementRetrievePartnerWithFranchiseName->fetch();
  }

  /**
   * find all franchise names
   * @return array 
   */
  public function retrieveAllFranchiseNames()
  {
    $statementRetrieveAllFranchiseNames = $this->dbh->connectDb()->prepare("SELECT franchiseName FROM partner ");
    $statementRetrieveAllFranchiseNames->execute();
    return $statementRetrieveAllFranchiseNames->fetchAll();
  }

  /**
   * retrieve parent partner profile with id
   * @param string $idClub
   * @return array partner profile
   */
  public function retrieveIdProfileParent(string $idClub)
  {
    $statementRetrieveIdProfileParent = $this->dbh->connectDb()->prepare("SELECT idPartnerParent FROM club WHERE idClub=:idClub");
    $statementRetrieveIdProfileParent->bindValue(":idClub", $idClub);
    $statementRetrieveIdProfileParent->execute();
    return $statementRetrieveIdProfileParent->fetch();
  }

  /**
   * update new permissions
   * @param string $newIdPermission
   * @param string $idClub
   */
  public function updatePermissions(string $newIdPermission, string $idClub)
  {
    $statementUpdatePermissions = $this->dbh->connectDb()->prepare("UPDATE club SET idPermission = :newIdPermission WHERE idClub=$idClub ");
    $statementUpdatePermissions->bindValue(":newIdPermission", $newIdPermission);
    $statementUpdatePermissions->execute();
    return $statementUpdatePermissions->fetch();
  }

  /**
   * add club to the partner in the partner table
   * @param string $idPartner
   * @param string $idClub
   */
  public function addClubToParentPartner(string $idPartner, string $idClub)
  {
    $statementAddClubToParentPartner = $this->dbh->connectDb()->prepare("UPDATE partner SET attachedClub= :idClub
     WHERE idPartner=:idPartner");
    $statementAddClubToParentPartner->bindValue(":idPartner", $idPartner);
    $statementAddClubToParentPartner->bindValue(":idClub", $idClub);
    $statementAddClubToParentPartner->execute();
  }

  /**
   * update club profile after change owner 
   * @param string $idClub
   * @param string $newIdPartner
   * @param string $newFranchiseName
   */
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

  /**
   * verify data of the profile creation form 
   * @param array $allInput form data
   * @return array $allInput data from vérified form
   */
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

  /**
   * create permissions file and put the new permissions in this file
   * @param string $clubPermissions
   * @return $id permission id
   */
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

  /**
   * modify permissions file and create a new id permissions
   * @param string $oldIdPermissions
   * @param array $newPermission
   * @return string new id permission
   */
  public function modifyPermissionsFile(string $oldIdPermissions, array $newPermission)
  {
    if (file_exists($this->filePath)) {
      // Permets de récupérer le contenu du fichier permission 
      $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
      // Permets de créer un nouvel id
      $newId = time();
      // Permets de remplacer les anciennes permissions par les nouvelles
      $indexOldPermissions = array_search($oldIdPermissions, array_column($permissions, "idPermission"));
      $permissions[$indexOldPermissions] = [
        'permissions' => $newPermission,
        'idPermission' => $newId
      ];
      file_put_contents($this->filePath, json_encode($permissions));
      return $newId;
    }
  }

  /**
   * remove old permissions selected
   * @param string $oldPermissions
   */
  public function deletePermissions(string $oldIdPermissions)
  {
    // Permets de récupérer le contenu du fichier permission 
    $permissions = json_decode(file_get_contents($this->filePath), true) ?? [];
    // Permets de récupérer l'index de permissions à supprimer
    $indexOldPermissions = array_search($oldIdPermissions, array_column($permissions, "idPermission"));
    // Permets de supprimer les permissions du profil
    unset($permissions[$indexOldPermissions]);
    $permissions = [...$permissions];
    // Permets de sauvegarder les modifications de suppression
    file_put_contents($this->filePath, json_encode($permissions));
  }
}
