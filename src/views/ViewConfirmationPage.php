<?php
$idUrl = $_GET["id"] ?? "";
$idClub = $_SESSION['idClub'] ?? "";
$idPartner = $_SESSION['idPartner'] ?? "";
$profileType = $_SESSION['profileType'] ?? "";

if ($requestType === "adminAddAccount") {
  // Permet de remplir la page de confirmation de création d'un nouveau compte technicien
  $title = "Création de compte";
  $popupTitle = "Création d'un nouveau compte";
  $popupText = "Êtes-vous sûr de vouloir créer ce compte ?";
  $popupLinkCancel = "../../indexAdmin.php?status=on&action=home";
  $popupLinkAgree = "../../indexAdmin.php?status=on&action=confirmAdd";
  //
} elseif ($requestType === 'adminLogout') {
  // Permet d'afficher la page de confirmation de déconnexion de l'admin
  $title = "Deconnection";
  $popupTitle = "Déconnection";
  $popupText = " Êtes-vous sûr de vouloir vous déconnecter ?";
  $popupLinkCancel = "../../indexAdmin.php?status=on&action=home";
  $popupLinkAgree = "../../indexAdmin.php?status=on&action=confirmLogout";
  //
} elseif ($requestType === "adminDeleteAccount") {
  // Permet de remplir la page de confirmation de suppréssion d'un compte technicien
  $title = "Suppression de compte";
  $popupTitle = "Suppression de compte utilisateur";
  $popupText = "Êtes-vous sûr de vouloir supprimer ce compte ?";
  $popupLinkCancel = "../../indexAdmin.php?status=on&action=home";
  $popupLinkAgree = "../../indexAdmin.php?status=on&action=confirmDelete";
  //
} elseif ($requestType === "modifyPermissions") {
  // Permet de remplir la page de confirmation de changement de permissions
  $title = "Modification permissions";
  $popupTitle = "Modification des permissions";
  $popupText = " Êtes-vous sûr de vouloir modifier les permissions ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=modifyPermissions";
  //
} elseif ($requestType === "changeOwner") {
  // Permet de remplir la page de confirmation de changement de propriétaire
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
  // Permet de remplir la page de confirmation de changement de statut
  $title = " Changement status";
  $popupTitle = "Changement de status";
  $popupText = " Êtes-vous sûr de vouloir changer le status ?";
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
  // Permet de remplir la page de confirmation de supression de partenaire ou de club
  $title = "Suppression";
  $popupTitle = "Supressions du profile";
  $popupText = " Êtes-vous sûr de vouloir supprimer ce profile  ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  // En fonction du type d'utilisateur le lien sera différant
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
  // Permet de remplir la page de confirmation de création de club
  $title = "Création club";
  $popupTitle = "Création d'un nouveau club";
  $popupText = " Êtes-vous sûr de vouloir créer ce nouveau club ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=createClub";
  //
} elseif ($requestType === "createPartner") {
  // Permet de remplir la page de confirmation de création de partenaire
  $title = "Création partenaire";
  $popupTitle = "Création d'un nouveau partenaire";
  $popupText = " Êtes-vous sûr de vouloir créer ce nouveau partenaire ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=createPartner";
  //
} elseif ($requestType === 'logout') {

  $title = "Deconnection";
  $popupTitle = "Déconnection";
  $popupText = " Êtes-vous sûr de vouloir vous déconnecter ?";
  $popupLinkCancel = "../../index.php?status=on&action=home";
  $popupLinkAgree = "../../index.php?status=on&action=confirmLogout";
}

$content = require('templates/layoutPopup.php');

require("templates/layout.php");
