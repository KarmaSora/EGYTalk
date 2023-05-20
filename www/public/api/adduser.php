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
if (isset($_POST['firstname'], $_POST['surname'], $_POST['user'], $_POST['pwd'])) {

    //karam: testa skapa if sats som loopar igenom befintliga användare så inga dubbletter tillåts,
    //om inga dubletter => sätt success till true
    $existingUsers = $db->getusers();
    $usernameExists = false;

    foreach ($existingUsers as $existingUser) {
        if ($_POST['user'] == $existingUser['username']) {
            $usernameExists = true;
            break;
        }
    }

    // Om användarnamnet inte finns då läggs det nya kontot till db
    if (!$usernameExists) {
        $stmt = $db->addUser($_POST['firstname'], $_POST['surname'], $_POST['user'], $_POST['pwd']);
        $success = true; // sätter success till true efter att ha lagt till användaren
    }
}


$result['success'] =  $success;


header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
