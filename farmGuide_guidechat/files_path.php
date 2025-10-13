<?php
// filepath: c:\xampp\htdocs\farmGuide_guidechat\fetch_users.php
include 'db.php';

$result = $conn->query("SELECT id, username FROM users");
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>