<?php

if ($requestType === "copyPassword") {
  $title = "Création partenaire";
  $popupTitle = "Nouveau compte partenaire créé";
  $popupText = "Le mot de passe pour le compte $newPartner[email] est $passwordGenerated";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "copyPasswordClub") {
  $title = "Création club";
  $popupTitle = "Nouveau compte club créé";
  $popupText = "Le mot de passe pour le compte $newClub[email] est $passwordGenerated , $messageMail";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === 'deletionError') {
  // Permet de remplir la page de confirmation de suppression de partenaire si le partenaire possède encore des clubs
  $title = "Suppression";
  $popupTitle = "Suppression impossible";
  $popupText = "Il est impossible de supprimer ce partenaire, car il possède actuellement encore des clubs. Veuillez fermer les clubs rattachés à ce compte ou effectuer un changement de propriétaire pour les clubs associés.";
  $popupLinkAgree = "../../index.php?status=on&action=home";
} elseif ($requestType === 'downloadImg') {
  $title = "Téléchargement terminé";
  $popupTitle = "Téléchargement de la photo terminé";
  $popupText = "La photo de profil a bien été changée";
  $popupLinkAgree = "../../index.php?status=on&action=home";
} elseif ($requestType === "changePassword") {
  $title = "Changement mot de passe";
  $popupTitle = "Changement de mot de passe validé";
  $popupText = "Le mot de passe a bien été changé, veuillez le conserver et ne pas le divulguer";
  $popupLinkAgree = "../../index.php?status=on&action=home";
} elseif ($requestType === 'changeDescription') {
  $title = "Nouvelle description";
  $popupTitle = "Changement de la description";
  $popupText = "La nouvelle description est validée";
  $popupLinkAgree = "../../index.php?status=on&action=home";
} elseif ($requestType === "adminAddAccount") {
  $title = "Ajout technicien";
  $popupTitle = "Ajout technicien confirmé";
  $popupText = "L'ajout du nouveau technicien est confirmé, le mot de passe du compte est $passwordGenerated";
  $popupLinkAgree = "../../../indexAdmin.php?status=on&action=home";
} elseif ($requestType === "adminDeleteAccount") {
  $title = "Suppression technicien";
  $popupTitle = "Suppression du technicien confirmé";
  $popupText = "Le compte $email a bien été supprimé";
  $popupLinkAgree = "../../../indexAdmin.php?status=on&action=home";
} elseif ($requestType === "errorSendMail") {
  $title = "Erreur envoi e-mail";
  $popupTitle = "Erreur envoi e-mail";
  $popupText = "Un problème est survenu durant la création de ce compte";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "modifyPermission") {
  $title = "Modification permission";
  $popupTitle = "Modification des permissions";
  $popupText = "Nous confirmons la modification des permissions pour ce compte, un e-mail de 
  notification de ces changements vient d'être envoyé au responsable de la franchise ainsi qu'au club concerné";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "errorModifyPermissions") {
  $title = "Erreur envoie";
  $popupTitle = "Erreur envoi e-mail";
  $popupText = "
  Un problème est survenu durant l'envoi de l'e-mail concernant la modification des permissions de ce compte.
   Cependant, les permissions ont bien été modifiées.
  ";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "clubStatusChange") {
  $title = "Modification de statut";
  $popupTitle = "Modification de statut du club";
  $popupText = "Nous confirmons la modification de statut pour ce compte, un e-mail de 
  notification de ces changements vient d'être envoyé au responsable de la franchise concerné";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "errorClubStatusChange") {
  $title = "Erreur lors de l'envoi";
  $popupTitle = "Erreur lors de l'envoi de l'e-mail";
  $popupText = "
  Un problème est survenu durant l'envoi de l'e-mail concernant la modification du statut de ce compte.
  Cependant, les modifications ont bien été effectuées.
  ";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "partnerStatusChange") {
  $title = "Modification de statut";
  $popupTitle = "Modification de statut du franchisé";
  $popupText = "Nous confirmons la modification de statut pour ce compte.";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "deleteClubAccount") {
  $title = "Suppression compte";
  $popupTitle = "Suppression de compte";
  $popupText = "Nous confirmons la suppression de ce compte";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "changeOwner") {
  $title = "Changement de propriétaire";
  $popupTitle = "Confirmation changement de propriétaire";
  $popupText = "Nous confirmons le changement de propriétaire";
  $popupLinkAgree = "../../../index.php?status=on&action=home";
} elseif ($requestType === "accountActivation") {
  $title = "Activation réussi";
  $popupTitle = "Confirmation de l'activation du compte";
  $popupText = "La création du compte vient d'être confirmée, il est maintenant disponible";
  $popupLinkAgree = "../../../index.php";
} elseif ($requestType === "accountActivationFailed") {
  $title = "Échec activation";
  $popupTitle = "Échec de l'activation du compte";
  $popupText = "L'activation du compte vient d'échouer, veuillez contacter notre service";
  $popupLinkAgree = "../../../index.php";
}


$content = require('templates/layoutSuccess.php');
