<?php
session_start();

$result['success'] = false;

// KOD!

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE); 