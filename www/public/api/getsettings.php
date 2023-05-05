<?php
/**
 * Förutsätter att man lagt till mail och phone i tabellen user
 */
session_start();

$result = null;

if (isset($_SESSION['uid'])) {
   include('../../model/DbEgyTalk.php');
   $db = new DbEgyTalk();
   $result = $db->getSettings($_SESSION['uid']);
}

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
