<?php
/**
 * Returnerar alla användare.
 * Viktigt att returnera uid, och namn
 */
session_start();
$result = [];
//kod
include_once('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();
$result = $db->getUsers();

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);