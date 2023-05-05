<?php
/**
 * Förutsätter att man lagt till mail och phone i tabellen user
 */
session_start();

$result['success'] = false;
$settings = [];

if (isset($_SESSION['uid'])) {
   // KOD!
}

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE); 