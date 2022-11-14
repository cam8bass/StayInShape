<?php
$idUrl = $_GET["id"] ?? "";
$idClub = $_SESSION['idClub'] ?? "";
$idPartner = $_SESSION['idPartner'] ?? "";
$profileType = $_SESSION['profileType'] ?? "";

if ($requestType === "adminAddAccount") {
  // permet de remplir la page de confirmation de création d'un nouveau compte technicien
  $title = "Création de comptes";
  $popupTitle = "Création d'un nouveau compte";
  $popupText = "Êtes-vous sûr de vouloir créer ce compte ?";
  $popupLinkCancel = "../../indexAdmin.php?status=on&action=home";
  $popupLinkAgree = "../../indexAdmin.php?status=on&action=confirmAdd";
  //
} elseif ($requestType === 'adminLogout') {
  // permet d'afficher la page de confirmation de déconnexion de l'admin
  $title = "Deconnection";
  $popupTitle = "Déconnection";
  $popupText = " Êtes-vous sûr de vouloir vous déconnecter ?";
  $popupLinkCancel = "../../indexAdmin.php?status=on&action=home";
  $popupLinkAgree = "../../indexAdmin.php?status=on&action=confirmLogout";
  //
} elseif ($requestType === "adminDeleteAccount") {
  // permet de remplir la page de confirmation de suppression d'un compte technicien
  $title = "Suppression de compte";
  $popupTitle = "Suppression de compte utilisateur";
  $popupText = "Êtes-vous sûr de vouloir supprimer ce compte ?";
  $popupLinkCancel = "../../indexAdmin.php?status=on&action=home";
  $popupLinkAgree = "../../indexAdmin.php?status=on&action=confirmDelete";
  //
} elseif ($requestType === "modifyPermissions") {
  // permet de remplir la page de confirmation de changement de permissions
  $title = "Modification permissions";
  $popupTitle = "Modification des permissions";
  $popupText = " Êtes-vous sûr de vouloir modifier les permissions ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=modifyPermissions";
  //
} elseif ($requestType === "changeOwner") {
  // permet de remplir la page de confirmation de changement de propriétaire
  if ($idUrl === $idClub) {
    $title = "Changement propriétaire";
    $popupTitle = "Changement de propriétaire";
    $popupText = " Êtes-vous sûr de vouloir changer de propriétaire ?";
    $popupLinkCancel = "../../index.php?status=on&action=home";
    $popupLinkAgree = "../../index.php?status=on&action=changeClubOwner";
    //
  } else {
    throw new Exception("L'utilisateur ne correspond pas à votre demande");
  }
} elseif ($requestType === "statusChange") {
  // permet de remplir la page de confirmation de changement de statut
  $title = " Changement statut";
  $popupTitle = "Changement de statut";
  $popupText = " Êtes-vous sûr de vouloir changer le statut ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  if ($profileType === "Club") {
    if ($idUrl === $idClub) {
      $popupLinkAgree = "../../index.php?status=on&action=statusChange&id=$idClub";
    } else {
      throw new Exception("L'utilisateur ne correspond pas à votre demande");
    }
  } elseif ($profileType === "Partner") {
    if ($idUrl == $idPartner) {
      $popupLinkAgree = "../../index.php?status=on&action=statusChange&id=$idPartner";
    } else {
      throw new Exception("L'utilisateur ne correspond pas à votre demande");
    }
  }
} elseif ($requestType === "deleteProfile") {
  // permet de remplir la page de confirmation de suppression de partenaire ou de club
  $title = "Suppression";
  $popupTitle = "Supressions du profile";
  $popupText = " Êtes-vous sûr de vouloir supprimer ce profil  ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  // en fonction du type d'utilisateur le lien sera différant
  if ($profileType === "Club") {
    if ($idUrl === $idClub) {
      $popupLinkAgree = "../../index.php?status=on&action=deleteClub&id=$idClub";
    } else {
      throw new Exception("L'utilisateur ne correspond pas à votre demande");
    }
  } elseif ($profileType === "Partner") {
    $popupLinkAgree = "../../index.php?status=on&action=deletePartner&id=$idPartner";
  }
} elseif ($requestType === "createClub") {
  // permet de remplir la page de confirmation de création de club
  $title = "Création club";
  $popupTitle = "Création d'un nouveau club";
  $popupText = " Êtes-vous sûr de vouloir créer ce nouveau club ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=createClub";
  //
} elseif ($requestType === "createPartner") {
  // permet de remplir la page de confirmation de création de partenaire
  $title = "Création partenaire";
  $popupTitle = "Création d'un nouveau partenaire";
  $popupText = " Êtes-vous sûr de vouloir créer ce nouveau partenaire ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=createPartner";
  //
} elseif ($requestType === 'logout') {
  $title = "Déconnexion";
  $popupTitle = "Déconnexion";
  $popupText = " Êtes-vous sûr de vouloir vous déconnecter ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=confirmLogout";
}

$content = require('templates/layoutPopup.php');


