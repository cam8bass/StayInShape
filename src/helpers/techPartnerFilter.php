<?php
session_start();
$allPartner = $_SESSION['allPartner'] ?? [];
unset($_SESSION['allPartner']);
echo json_encode($allPartner);
