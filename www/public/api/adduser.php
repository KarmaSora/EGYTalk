<?php
/**
 * Lägger till en användare
 * 
 * @param $_POST['firstname']   förnamn
 * @param $_POST['surname']     eftrenamn
 * @param $_POST['user']        användarnamn
 * @param $_POST['pwd']         lösen
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();

include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();

$success = false;

// KOD!

$result['success'] =  $success;

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);