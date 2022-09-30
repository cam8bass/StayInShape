<?php
require_once('src/controllers/ControllerSession.php');
require_once("src/controllers/ControllerAdmin.php");
require_once('src/lib/Database.php');
require_once('src/config/config.php');

use App\controllers\ControllerAdmin\Admin;
use App\controllers\ControllerSession\Session;


try {

  if (isset($_GET['status']) && isset($_GET['action'])) {

    if (($_GET['status'] === 'off') && ($_GET['action'] === 'login')) {
      // Permet de lancer la vérification du formulaire de login
      (new Session())->loginAdmin("location: ../../indexAdmin.php?status=on&action=home", "src/views/viewsAdmin/ViewAdminLogin.php");
    }

    if ($_GET['status'] === "on") {
      // Permet de démarrer la session et récupérer le profil de l'utilisateur courant
      $currentUser = (new Session())->alreadyLoggin();

      if ($currentUser) {
        // === Section Admin ===
        if (($currentUser['type'] === 'admin') && ($currentUser['create'] === 1) && ($currentUser['write'] === 1) && ($currentUser['read'] === 1)) {

          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // === Request POST ===
            if ($_GET['action'] === 'confirmAdd') {
              // Permet de lancer la vérification avant de soumettre la création d'un nouvel utilisateur
              (new Admin())->adminAddAccount();
            } elseif ($_GET['action'] === 'delete') {
              // Permet de lancer la vérification de l'email avant de soumettre la suppression du compte utilisateur
              (new Admin())->adminDeleteAccount();
            } else (throw new Exception('Erreur de redirection'));
          } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // === Request GET ===
            if ($_GET["action"] === 'home') {
              //Permet de confirmer le login si la confirmation est réussi redirection vers la page home
              (new Admin())->searchTech();
              require('src/views/ViewHome.php');
            } elseif ($_GET['action'] === 'logout') {
              // Permet d'afficher la page de confirmation de déconnection
              $requestType = "adminLogout";
              require('src/views/ViewConfirmationPage.php');
            } elseif ($_GET['action'] === 'confirmLogout') {
              // Permet de confirmer la déconnection la session 
              (new Session())->logout("location: ../../../indexAdmin.php");
            } elseif ($_GET['action'] === 'add') {
              // Permet d'afficher la page de création de nouveau compte
              require('src/views/viewsAdmin/ViewAdminAddAccount.php');
            } elseif ($_GET['action'] === 'confirmAdd') {
              //Permet de confirmer la creation d'un nouveau compte
              (new Admin)->adminConfirmAddAccount();
            } elseif ($_GET['action'] === 'delete') {
              // Permet d'afficher la page de suppression de compte
              require('src/views/viewsAdmin/ViewAdminDeleteAccount.php');
            } elseif ($_GET['action'] === 'confirmDelete') {
              // Permet de confirmer la suppression du compte
              (new Admin())->adminConfirmDeleteAccount();
            } else (throw new Exception('Erreur de redirection'));
          }
        } else {
          //Supprime la session si le currentUser n'est pas égal à admin
          (new Session())->logout("location: ../../../index.php");
        }
      } else {
        throw new Exception(ERROR_ACCESS_DENIED);
      }
    }
  } elseif (!isset($_GET['status']) && !isset($_GET["action"])) {
    // Permet de récupérer la session de l'utilisateur pour une durée de 14 jours 
    $currentUser = (new Session())->alreadyLoggin();

    if ($currentUser) {
      header("location: ../../indexAdmin.php?status=on&action=home");
    } else {
      // Permet d'afficher la page de login si aucune action est présente et si il n'y a pas de status
      require('src/views/viewsAdmin/ViewAdminLogin.php');
    }
  }
} catch (Exception $e) {
  $errorMessage = $e->getMessage();
  require('src/views/viewsAdmin/ViewAdminError.php');
}
