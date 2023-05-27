<?php
/**
 * Lägger till en kommentar
 * 
 * @param $_POST['pid']  pid för post som skall kommenteras
 * @param $_POST['comment_txt']  pid för post som skall kommenteras
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();

include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();

$success = false;

// Kod!
// KOD!
if (isset($_POST['commentMsg'])) {

    $postMsg = $_POST['commentMsg'];
    $result['comment'] = $postMsg;

    $uid = $_SESSION['uid'];
    $result['sessUID'] = $uid;

  
     $stmt = $db->addComment($uid, $pid, $postMsg);

    $success = true; // sätter success till true efter att ha lagt till post till databasen

}


$result['success'] =  $success;

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);