<?php
session_start();
$result= [];

// KOD!
    include('../../model/DbEgyTalk.php');
    $db = new DbEgyTalk();
    $uid = $_GET['uid'];
    $result = $db->getPosts($uid);

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);