<?php
session_start();
$result= [];

if (isset($_SESSION['uid'])){
   include('../../model/DbEgyTalk.php');
   $db = new DbEgyTalk();
   $result = $db->getAllPosts();
}

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);