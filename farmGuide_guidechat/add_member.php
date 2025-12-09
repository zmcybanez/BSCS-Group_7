<?php
// add_member.php - Add member to group
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$current_user_id = $_SESSION['user_id'];
$group_id = $_POST['group_id'] ?? null;
$target_user_id = $_POST['user_id'] ?? null;

// Validate inputs
if (!is_numeric($group_id) || !is_numeric($target_user_id) || (int)$group_id <= 0 || (int)$target_user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid group ID or user ID"]);
    exit;
}

$group_id = (int)$group_id;
$target_user_id = (int)$target_user_id;

// Optional: Check if current user is a member of the group (to authorize adding members)
// You can enhance this by checking if they are the creator or have admin rights
$auth_check = $conn->prepare("SELECT id FROM group_members WHERE group_id = ? AND user_id = ?");
$auth_check->bind_param("ii", $group_id, $current_user_id);
$auth_check->execute();
$auth_result = $auth_check->get_result();

if ($auth_result->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "You are not authorized to add members to this group"]);
    exit;
}
$auth_check->close();

// Check if user is already in group
$check_stmt = $conn->prepare("SELECT id FROM group_members WHERE group_id = ? AND user_id = ?");
$check_stmt->bind_param("ii", $group_id, $target_user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo json_encode(["status" => "warning", "message" => "User  is already a member of this group"]);
    $check_stmt->close();
    exit;
}
$check_stmt->close();

// Add the user to the group
$insert_stmt = $conn->prepare("INSERT INTO group_members (group_id, user_id) VALUES (?, ?)");
$insert_stmt->bind_param("ii", $group_id, $target_user_id);

if ($insert_stmt->execute()) {
    echo json_encode([
        "status" => "success", 
        "message" => "Member added successfully", 
        "group_id" => $group_id
    ]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Failed to add member: " . $conn->error
    ]);
}

$insert_stmt->close();
$conn->close();
?>