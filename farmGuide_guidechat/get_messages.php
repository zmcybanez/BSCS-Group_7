<?php
// get_messages.php
session_start();
include 'db.php';
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) { /* handle error */ }

$user_id = (int)$_SESSION['user_id'];
$chat_type = trim($_POST['chat_type'] ?? '');
$chat_id = (int)$_POST['chat_id'] ?? 0;
$limit = (int)$_POST['limit'] ?? 50; // For pagination

if ($chat_type === 'user') {
    $stmt = $conn->prepare("
        SELECT m.*, u.username as sender_name 
        FROM messages m 
        LEFT JOIN users u ON m.sender_id = u.id 
        WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?) 
        ORDER BY m.created_at DESC LIMIT ?
    ");
    $stmt->bind_param("iiiii", $user_id, $chat_id, $chat_id, $user_id, $limit);
} else { // group
    $stmt = $conn->prepare("
        SELECT gm.*, u.username as sender_name 
        FROM group_messages gm 
        LEFT JOIN users u ON gm.sender_id = u.id 
        WHERE gm.group_id = ? 
        ORDER BY gm.created_at DESC LIMIT ?
    ");
    $stmt->bind_param("ii", $chat_id, $limit);
}
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
echo json_encode(['success' => true, 'messages' => array_reverse($result)]); // Reverse to chronological order
$stmt->close();
?>