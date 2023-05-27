<?php

/**
 * Lägger till en post
 * 
 * @param $_POST['post_txt']  Postade texten
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();
include_once('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();
$success = false;

// KOD!
if (isset($_POST['postMsg'])) {

        $postMsg = $_POST['postMsg'];
        $result['message'] = $postMsg;

        $uid = $_SESSION['uid'];
        $result['sessUID'] = $uid;

      
         $stmt = $db->addPost($uid, $postMsg);

        $success = true; // sätter success till true efter att ha lagt till post till databasen

}

       


$result['success'] =  $success;

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
