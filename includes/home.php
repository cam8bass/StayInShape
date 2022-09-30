<?php
$currentUser = $_SESSION['currentUser'] ?? "";
?>


<?php if ($currentUser['type'] === "admin" && $currentUser['create'] === 1) : ?>

  <a href="../indexAdmin.php?status=on&action=home" class="sideBar__home">
    <span class="sideBar__home-text">Admin</span>
  </a>
  
<?php else : ?>

  <a href="../index.php?status=on&action=home" class="sideBar__home">
    <span class="sideBar__home-text"><?= strtoupper(substr($currentUser['firstName'], 0, 1)) . strtoupper(substr($currentUser['lastName'], 0, 1))  ?></span>
  </a>

<?php endif ?>

<?php if ($_GET['action'] === 'home' && ($currentUser['type'] === 'admin' || $currentUser['type'] === 'tech')) : ?>

  <div class="sideBar__search">
    <input type="text" name="search" id="search" class="sideBar__search-input" placeholder="Rechercher un profil">
  </div>

<?php endif ?>

