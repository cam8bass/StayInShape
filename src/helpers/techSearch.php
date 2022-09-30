<?php
session_start();
$allUsers = $_SESSION['allUsers'] ?? [];
unset($_SESSION['allUsers']);
echo json_encode($allUsers);


