<?php
/**
 * Returnerar alla användare.
 * Viktigt att returnera uid, och namn
 */
session_start();
$result= [];

// KOD!

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);