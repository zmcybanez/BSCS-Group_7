<?php
// filepath: c:\xampp\htdocs\farmGuide_guidechat\create_group.php
// create_group.php - Create a new group
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$group_name = trim($_POST['group_name'] ?? '');
$members = $_POST['members'] ?? [];

// Ensure members is an array
if (!is_array($members)) {
    $members = [];
}

// Add the creator to the members list if not already included
if (!in_array($user_id, $members)) {
    $members[] = $user_id;
}

if (empty($group_name) || empty($user_id) || empty($members)) {
    echo json_encode(["status" => "error", "message" => "Invalid input: Group name and at least one member (including creator) are required"]);
    exit;
}

// Create the group
$stmt = $conn->prepare("INSERT INTO groups (name, created_by) VALUES (?, ?)");
$stmt->bind_param("si", $group_name, $user_id);

if ($stmt->execute()) {
    $group_id = $conn->insert_id;

    // Insert members into the group_members table (use INSERT IGNORE to avoid duplicates if any)
    $stmt_members = $conn->prepare("INSERT IGNORE INTO group_members (group_id, user_id) VALUES (?, ?)");
    if ($stmt_members) {
        foreach ($members as $member) {
            // Basic validation: ensure member is an integer
            if (is_numeric($member) && $member > 0) {
                $stmt_members->bind_param("ii", $group_id, (int)$member);
                $stmt_members->execute();
            }
        }
        $stmt_members->close();
    }

    $stmt->close();
    $conn->close();
    echo json_encode(["status" => "success", "message" => "Group created successfully", "group_id" => $group_id]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to create group: " . $conn->error]);
    $stmt->close();
    $conn->close();
}
?>