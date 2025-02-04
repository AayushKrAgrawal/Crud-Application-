<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'ml_website_db');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

function sanitize($data) {
    global $db;
    return mysqli_real_escape_string($db, htmlspecialchars(trim($data)));
}
?>
