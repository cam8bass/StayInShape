<?php
session_start();
$allTechnicien = $_SESSION['allTechnicien'] ?? [];
unset($_SESSION['allTechnicien']);
echo json_encode($allTechnicien);
