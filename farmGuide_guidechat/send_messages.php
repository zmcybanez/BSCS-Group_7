<?php
// send_message.php - Handle sending messages for user and group chats with validation, image upload, and error logging
// filepath: c:\xampp\htdocs\farmGuide_guidechat\send_message.php
session_start();
include 'db.php';

header('Content-Type: application/json'); // Ensure JSON response

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log("Send_message.php: Unauthorized access - no session user_id");
    echo json_encode(['success' => false, 'error' => 'Not logged in. Please log in again.']);
    exit();
}

$user_id = (int)$_SESSION['user_id']; // Cast to int for safety
$chat_type = trim($_POST['chat_type'] ?? '');
$chat_id = (int)($_POST['chat_id'] ?? 0);
$message = trim($_POST['message'] ?? '');

// Validate inputs
if (empty($chat_type) || !in_array($chat_type, ['user', 'group'])) {
    error_log("Send_message.php: Invalid chat_type: $chat_type for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => 'Invalid chat type.']);
    exit();
}

if ($chat_id <= 0) {
    error_log("Send_message.php: Invalid chat_id: $chat_id for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => 'Invalid chat ID.']);
    exit();
}

// Don't send completely empty messages (allow images without text)
if (empty($message) && empty($_FILES['image']['name'])) {
    error_log("Send_message.php: Empty message and no image for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => 'Message cannot be empty.']);
    exit();
}

// Handle image upload
$image_path = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            error_log("Send_message.php: Failed to create uploads directory");
            echo json_encode(['success' => false, 'error' => 'Upload directory error.']);
            exit();
        }
    }
    
    // Validate file size (e.g., max 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB
    if ($_FILES['image']['size'] > $max_size) {
        error_log("Send_message.php: Image file too large: " . $_FILES['image']['size'] . " for user_id: $user_id");
        echo json_encode(['success' => false, 'error' => 'Image file too large (max 5MB).']);
        exit();
    }
    
    $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($file_ext, $allowed_exts)) {
        error_log("Send_message.php: Invalid image file type: $file_ext for user_id: $user_id");
        echo json_encode(['success' => false, 'error' => 'Only JPG, PNG, GIF images allowed.']);
        exit();
    }
    
    $file_name = uniqid() . '.' . $file_ext;
    $file_path = $upload_dir . $file_name;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
        // Set proper permissions for the uploaded file
        chmod($file_path, 0644);
        $image_path = $file_name; // Store just the filename (full path can be constructed in frontend)
        error_log("Send_message.php: Image uploaded successfully: $file_name for user_id: $user_id");
    } else {
        error_log("Send_message.php: Image upload failed for user_id: $user_id");
        echo json_encode(['success' => false, 'error' => 'Failed to upload image.']);
        exit();
    }
} elseif (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
    // Handle other upload errors (e.g., UPLOAD_ERR_INI_SIZE, etc.)
    $upload_errors = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    ];
    $error_msg = $upload_errors[$_FILES['image']['error']] ?? 'Unknown upload error';
    error_log("Send_message.php: Image upload error: $error_msg (code: " . $_FILES['image']['error'] . ") for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => $error_msg]);
    exit();
}

// Validate authorization for the chat
if ($chat_type === 'group') {
    // Check if group exists and user is a member
    $stmt = $conn->prepare("SELECT gm.id FROM groups g INNER JOIN group_members gm ON g.id = gm.group_id WHERE g.id = ? AND gm.user_id = ?");
    $stmt->bind_param("ii", $chat_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        error_log("Send_message.php: User $user_id not in group $chat_id or group does not exist");
        echo json_encode(['success' => false, 'error' => 'You are not authorized to send messages in this group.']);
        $stmt->close();
        exit();
    }
    $stmt->close();
} elseif ($chat_type === 'user') {
    // For one-on-one chat, check if receiver exists and is not self
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND id != ?");
    $stmt->bind_param("ii", $chat_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        error_log("Send_message.php: Invalid receiver $chat_id for sender $user_id (user not found or self-messaging)");
        echo json_encode(['success' => false, 'error' => 'Invalid user or cannot message yourself.']);
        $stmt->close();
        exit();
    }
    $stmt->close();
    // Optional: Add check for blocking if you have a blocks table
    // e.g., $stmt = $conn->prepare("SELECT id FROM blocks WHERE (blocker_id = ? AND blocked_id = ?) OR (blocker_id = ? AND blocked_id = ?)");
    // $stmt->bind_param("iiii", $user_id, $chat_id, $chat_id, $user_id);
    // ... if found, deny message
}

// Sanitize message (basic HTML escaping, no scripts allowed)
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Limit message length (e.g., 1000 chars)
if (strlen($message) > 1000) {
    error_log("Send_message.php: Message too long (" . strlen($message) . " chars) for user_id: $user_id");
    echo json_encode(['success' => false, 'error' => 'Message too long (max 1000 characters).']);
    exit();
}

// Prepare INSERT based on chat type (using single 'messages' table with conditional fields)
if ($chat_type === 'user') {
    // One-on-one: set receiver_id, group_id = NULL
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, group_id, message, image_path, created_at) VALUES (?, ?, NULL, ?, ?, NOW())");
    $stmt->bind_param("iiss", $user_id, $chat_id, $message, $image_path);
} else {
    // Group: set group_id, receiver_id = NULL
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, group_id, message, image_path, created_at) VALUES (?, NULL, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $user_id, $chat_id, $message, $image_path);
}

if ($stmt->execute()) {
    $message_id = $conn->insert_id; // Get inserted ID for frontend use (e.g., optimistic UI updates)
    error_log("Send_message.php: Message sent successfully (ID: $message_id) for user_id: $user_id, chat_type: $chat_type, chat_id: $chat_id");
    echo json_encode(['success' => true, 'message_id' => $message_id]);
} else {
    $db_error = $stmt->error;
    error_log("Send_message.php: Database insert failed: $db_error for user_id: $user_id, chat_type: $chat_type, chat_id: $chat_id");
    echo json_encode(['success' => false, 'error' => 'Failed to send message. Database error.']);
}

$stmt->close();
// Note: Connection is closed in db.php if using mysqli_close, or let it auto-close
?>