<?php
session_start();
$allClubs = $_SESSION['allClubs'] ?? [];
unset($_SESSION['allClubs']);
echo json_encode($allClubs);
