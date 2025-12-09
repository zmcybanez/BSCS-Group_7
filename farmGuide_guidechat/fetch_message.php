<?php
// filepath: c:\xampp\htdocs\farmGuide_guidechat\fetch_message.php
// Enhanced version: Added session validation, input sanitization, error logging, JSON headers,
// authorization checks, pagination support, and improved query handling for security and performance.
// Assumes database schema: 
// - 'messages' table with columns: id, sender_id, receiver_id, group_id (NULL for user chats), message, image_path, created_at
// - 'users' table with: id, username, profile_image
// - 'groups' table with: id (for group chats)
// - 'group_members' table with: id, group_id, user_id (for group authorization)

session_start();
include 'db.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log("fetch_message.php: Unauthorized access - no session user_id");
    echo json_encode(['success' => false, 'error' => 'Not logged in. Please log in again.', 'messages' => []]);
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$chat_type = trim($_POST['chat_type'] ?? '');
$chat_id = (int)($_POST['chat_id'] ?? 0);
$limit = (int)($_POST['limit'] ?? 50); // Optional limit for pagination, default 50
$last_message_id = (int)($_POST['last_message_id'] ?? 0); // Optional: fetch messages newer than this ID

// Validate inputs
if (empty($chat_type) || !in_array($chat_type, ['user', 'group'])) {
    error_log("fetch_message.php: Invalid chat_type: $chat_type for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => 'Invalid chat type.', 'messages' => []]);
    exit();
}

if ($chat_id <= 0) {
    error_log("fetch_message.php: Invalid chat_id: $chat_id for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => 'Invalid chat ID.', 'messages' => []]);
    exit();
}

// Clamp limit to reasonable value for performance
if ($limit <= 0 || $limit > 100) {
    $limit = 50;
}

// Authorization checks (to prevent unauthorized access)
$authorized = false;
if ($chat_type === 'group') {
    // Check if group exists and user is a member
    $stmt = $conn->prepare("SELECT gm.id FROM groups g INNER JOIN group_members gm ON g.id = gm.group_id WHERE g.id = ? AND gm.user_id = ?");
    $stmt->bind_param("ii", $chat_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $authorized = true;
    }
    $stmt->close();
    
    if (!$authorized) {
        error_log("fetch_message.php: User $user_id not authorized for group $chat_id");
        echo json_encode(['success' => false, 'error' => 'You are not authorized to view messages in this group.', 'messages' => []]);
        exit();
    }
} elseif ($chat_type === 'user') {
    // For one-on-one chats: Ensure chat_id is a valid user and not self
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND id != ?");
    $stmt->bind_param("ii", $chat_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $authorized = true;
    }
    $stmt->close();
    
    if (!$authorized) {
        error_log("fetch_message.php: Invalid receiver $chat_id for user $user_id (not found or self-chat)");
        echo json_encode(['success' => false, 'error' => 'Invalid user or cannot chat with yourself.', 'messages' => []]);
        exit();
    }
    // Optional: Add block check here if you have a 'blocks' table
    // e.g., SELECT * FROM blocks WHERE (blocker_id = ? AND blocked_id = ?) OR (blocker_id = ? AND blocked_id = ?)
}

// Prepare query based on chat type (using original 'messages' table schema with group_id)
$messages = [];
$where_clause = '';
$params = [];
$types = '';
$order_by = 'm.created_at ASC';

if ($chat_type === 'user') {
    // One-on-one: Bidirectional messages where group_id IS NULL
    $base_query = "
        SELECT m.id, m.sender_id, m.receiver_id, m.group_id, m.message, m.image_path, m.created_at, 
               u.username as sender_name, u.profile_image as sender_profile 
        FROM messages m 
        JOIN users u ON m.sender_id = u.id 
        WHERE m.group_id IS NULL 
          AND ((m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?))
    ";
    $params = [$user_id, $chat_id, $chat_id, $user_id];
    $types = "iiii";
    
    if ($last_message_id > 0) {
        $where_clause = " AND m.id > ?";
        $params[] = $last_message_id;
        $types .= "i";
    }
    
    $full_query = $base_query . $where_clause . " ORDER BY " . $order_by . " LIMIT ?";
    $params[] = $limit;
    $types .= "i";
    
    $stmt = $conn->prepare($full_query);
    $stmt->bind_param($types, ...$params);
} else {
    // Group: Messages where group_id = $chat_id
    $base_query = "
        SELECT m.id, m.sender_id, m.receiver_id, m.group_id, m.message, m.image_path, m.created_at, 
               u.username as sender_name, u.profile_image as sender_profile 
        FROM messages m 
        JOIN users u ON m.sender_id = u.id 
        WHERE m.group_id = ?
    ";
    $params = [$chat_id];
    $types = "i";
    
    if ($last_message_id > 0) {
        $where_clause = " AND m.id > ?";
        $params[] = $last_message_id;
        $types .= "i";
    }
    
    $full_query = $base_query . $where_clause . " ORDER BY " . $order_by . " LIMIT ?";
    $params[] = $limit;
    $types .= "i";
    
    $stmt = $conn->prepare($full_query);
    $stmt->bind_param($types, ...$params);
}

// Execute query and handle results
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // Enhance row with useful flags for frontend
        $row['is_self'] = (int)$row['sender_id'] === $user_id;
        $row['timestamp'] = strtotime($row['created_at']); // Unix timestamp for easy JS handling
        $messages[] = $row;
    }
    
    $log_msg = "fetch_message.php: Fetched " . count($messages) . " messages for user_id: $user_id, chat_type: $chat_type, chat_id: $chat_id";
    if ($last_message_id > 0) {
        $log_msg .= ", after ID $last_message_id";
    }
    if ($limit != 50) {
        $log_msg .= ", limit $limit";
    }
    error_log($log_msg);
    
    echo json_encode(['success' => true, 'messages' => $messages]);
} else {
    $error_msg = $stmt->error;
    error_log("fetch_message.php: Query failed for user_id: $user_id - Error: $error_msg");
    echo json_encode(['success' => false, 'error' => 'Failed to fetch messages. Database error occurred.', 'messages' => []]);
}

$stmt->close();
// Note: Connection is closed in db.php if using mysqli_close, or let it auto-close
?>