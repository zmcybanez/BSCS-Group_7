<?php
// get_users.php
session_start();
include 'db.php';
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) { /* handle error */ }

$user_id = (int)$_SESSION['user_id'];
$search = trim($_POST['search'] ?? ''); // Optional search

$sql = "SELECT id, username, email FROM users WHERE id != ?"; // Exclude self
$params = [$user_id];
$types = "i";

if (!empty($search)) {
    $sql .= " AND (username LIKE ? OR email LIKE ?)";
    $search_param = "%$search%";
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "ss";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
echo json_encode(['success' => true, 'users' => $users]);
$stmt->close();
?>