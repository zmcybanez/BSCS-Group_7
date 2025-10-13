<?php
// chat.php - Main chat interface with error handling
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch current user's username
$username = 'User '; // Default fallback
$user_query = $conn->query("SELECT username FROM users WHERE id = $user_id");
if ($user_query && $row = $user_query->fetch_assoc()) {
    $username = $row['username'];
}

// Fetch all users except self
$users = [];
$res = $conn->query("SELECT id, username FROM users WHERE id != $user_id");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $users[] = $row;
    }
}

// Get user's groups
$groups = [];
$groups_query = $conn->query("
    SELECT g.id, g.name 
    FROM groups g 
    JOIN group_members gm ON g.id = gm.group_id 
    WHERE gm.user_id = $user_id
");
if ($groups_query) {
    while ($row = $groups_query->fetch_assoc()) {
        $groups[] = $row;
    }
} else {
    error_log("Error fetching groups: " . $conn->error);
}

// Get current chat (either user or group) with validation
$current_chat = null;
$error_message = null;

if (isset($_GET['user_id'])) {
    $chat_user_id = (int)$_GET['user_id'];
    if ($chat_user_id > 0) {
        $chat_user_query = $conn->query("SELECT username FROM users WHERE id = $chat_user_id");
        if ($chat_user_query && $chat_user_query->num_rows > 0) {
            $current_chat = [
                'type' => 'user',
                'id' => $chat_user_id,
                'name' => $chat_user_query->fetch_assoc()['username']
            ];
        } else {
            $error_message = "User  not found or invalid user ID.";
            error_log("Invalid user_id in chat: " . $chat_user_id);
        }
    } else {
        $error_message = "Invalid user ID.";
    }
} elseif (isset($_GET['group_id'])) {
    $group_id = (int)$_GET['group_id'];
    if ($group_id > 0) {
        $group_query = $conn->query("SELECT name FROM groups WHERE id = $group_id");
        if ($group_query && $group_query->num_rows > 0) {
            $current_chat = [
                'type' => 'group',
                'id' => $group_id,
                'name' => $group_query->fetch_assoc()['name']
            ];
            // Check if user is in the group
            $membership_query = $conn->query("SELECT id FROM group_members WHERE group_id = $group_id AND user_id = $user_id");
            if (!$membership_query || $membership_query->num_rows == 0) {
                $error_message = "You are not a member of this group.";
                $current_chat = null;
                error_log("User  $user_id not in group $group_id");
            }
        } else {
            $error_message = "Group not found or invalid group ID.";
            error_log("Invalid group_id in chat: " . $group_id);
        }
    } else {
        $error_message = "Invalid group ID.";
    }
}

// If no chat selected, auto-redirect to first user (or show welcome if no users)
if (!$current_chat && empty($error_message)) {
    if (!empty($users)) {
        header("Location: chat.php?user_id=" . $users[0]['id']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmGuide Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="chat-body">
    <div class="chat-container">
        <!-- Sidebar 1: Users List -->
        <div class="sidebar users-sidebar">
            <div class="sidebar-header">
                <h3>Online Farmers</h3>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($username); ?></span>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search farmers..." id="user-search">
            </div>
            <div class="users-list">
                <?php if (empty($users)): ?>
                    <p>No other users found.</p>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <div class="user-item" data-user-id="<?php echo $user['id']; ?>">
                            <div class="user-avatar"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></div>
                            <div class="user-details">
                                <span class="username"><?php echo htmlspecialchars($user['username']); ?></span>
                                <span class="status online">Online</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar 2: Groups & Actions -->
        <div class="sidebar groups-sidebar">
            <div class="sidebar-header">
                <h3>Groups</h3>
                <button class="create-group-btn" onclick="showCreateGroup()">+ New Group</button>
            </div>
            <div class="groups-list">
                <?php if (empty($groups)): ?>
                    <p>No groups yet. Create one!</p>
                <?php else: ?>
                    <?php foreach ($groups as $group): ?>
                        <div class="group-item" data-group-id="<?php echo $group['id']; ?>">
                            <div class="group-avatar">#</div>
                            <span class="group-name"><?php echo htmlspecialchars($group['name']); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Create Group Modal -->
            <div id="createGroupModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="hideCreateGroup()">&times;</span>
                    <h3>Create New Group</h3>
                    <form id="createGroupForm" action="create_group.php" method="POST">
                        <input type="text" name="group_name" placeholder="Group Name" required>
                        <div class="members-selection">
                            <h4>Add Members</h4>
                            <?php foreach ($users as $user): ?>
                                <label>
                                    <input type="checkbox" name="members[]" value="<?php echo $user['id']; ?>">
                                    <?php echo htmlspecialchars($user['username']); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit">Create Group</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="main-chat-area">
            <?php if ($error_message): ?>
                <div class="error"><?php echo htmlspecialchars($error_message); ?> <a href="chat.php">Go back</a></div>
            <?php elseif ($current_chat): ?>
                <div class="chat-header">
                    <h3><?php echo htmlspecialchars($current_chat['name']); ?></h3>
                    <?php if ($current_chat['type'] === 'group'): ?>
                        <button class="add-member-btn" onclick="showAddMember()">Add Member</button>
                    <?php endif; ?>
                </div>
                
                <div class="messages-container" id="messagesContainer">
                    <!-- Messages will be loaded here via AJAX -->
                    <div id="loading">Loading messages...</div>
                </div>
                
                <div class="message-input">
                    <form id="messageForm" enctype="multipart/form-data">
                        <input type="hidden" name="chat_type" value="<?php echo htmlspecialchars($current_chat['type']); ?>">
                        <input type="hidden" name="chat_id" value="<?php echo $current_chat['id']; ?>">
                        <input type="text" name="message" placeholder="Type your message..." id="messageInput">
                        <label for="imageUpload" class="file-upload-btn">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTQgMTZMMTAgMTBNMTAgMTBMMTYgMTZNMTYgMTZMMjIgMTBNMTYgMTBMMjIgMTZNMTAgMTBMMTAgMTZNMTAgMTBMMTAgNE0xNiAxMEwxNiA0TTQgMTZINCBNNCBNNCAxNkw0IDIyTTE2IDE2TDE2IDIyTTIyIDE2TDIyIDIyIiBzdHJva2U9IiM0OTUwNTciIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo=" alt="Upload image">
                        </label>
                        <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;">
                        <button type="submit">Send</button>
                    </form>
                </div>

                <!-- Add Member Modal -->
                <?php if ($current_chat['type'] === 'group'): ?>
                    <div id="addMemberModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="hideAddMember()">&times;</span>
                            <h3>Add Member to Group</h3>
                            <form id="addMemberForm" action="add_member.php" method="POST">
                                <input type="hidden" name="group_id" value="<?php echo $current_chat['id']; ?>">
                                <select name="user_id" required>
                                    <option value="">Select a user</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Add to Group</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="welcome-message">
                    <h2>Welcome to FarmGuide Chat</h2>
                    <p>Select a user or group to start chatting</p>
                    <?php if (empty($users) && empty($groups)): ?>
                        <p>No users or groups available. <a href="register.php">Invite more farmers</a> or create a group.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Chat functionality with debugging
        let currentChat = <?php echo json_encode($current_chat); ?>;
        let refreshInterval;

        console.log('Current chat loaded:', currentChat); // Debug log

        // Load messages for current chat
        function loadMessages() {
            if (!currentChat) {
                console.log('No current chat to load messages');
                return;
            }
            
            const formData = new FormData();
            formData.append('chat_type', currentChat.type);
            formData.append('chat_id', currentChat.id);
            
            console.log('Fetching messages for:', currentChat.type, currentChat.id); // Debug log
            
            fetch('fetch_messages.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(messages => {
                console.log('Messages loaded:', messages.length); // Debug log
                const container = document.getElementById('messagesContainer');
                const loading = document.getElementById('loading');
                if (loading) loading.remove();
                
                container.innerHTML = '';
                
                messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `message ${message.sender_id == <?php echo $user_id; ?> ? 'sent' : 'received'}`;
                    
                    let content = '';
                    if (message.image_path) {
                        content = `<img src="uploads/${message.image_path}" alt="Shared image" class="message-image">`;
                    }
                    if (message.message) {
                        content += `<p>${message.message}</p>`;
                    }
                    
                    messageDiv.innerHTML = `
                        <div class="message-content">${content}</div>
                        <span class="message-time">${message.created_at}</span>
                    `;
                    
                    container.appendChild(messageDiv);
                });
                
                container.scrollTop = container.scrollHeight;
            })
            .catch(error => {
                console.error('Error loading messages:', error); // Debug log
                document.getElementById('messagesContainer').innerHTML = '<div class="error">Failed to load messages. Please refresh.</div>';
            });
        }

        // Send message with error handling
        document.getElementById('messageForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!currentChat) {
                console.error('No current chat selected');
                alert('Please select a chat first.');
                return;
            }
            
            const formData = new FormData(this);
            const message = document.getElementById('messageInput').value.trim();
            const image = document.getElementById('imageUpload').files[0];
            
            if (!message && !image) {
                console.log('Empty message and no image');
                return;
            }
            
            console.log('Sending message to:', currentChat.type, currentChat.id); // Debug log
            
            fetch('send_message.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Send response:', data); // Debug log
                if (data.success) {
                    document.getElementById('messageInput').value = '';
                    document.getElementById('imageUpload').value = '';
                    loadMessages();
                } else {
                    alert('Error sending message: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Send error:', error); // Debug log
                alert('Failed to send message. Check console for details.');
            });
        });

        // Set up auto-refresh
        if (currentChat) {
            loadMessages();
            refreshInterval = setInterval(loadMessages, 3000);
        }

        // Enhanced click handlers with validation
        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', () => {
                const userId = item.getAttribute('data-user-id');
                console.log('Clicked user ID:', userId); // Debug log
                if (userId && userId > 0) {
                    window.location.href = `chat.php?user_id=${userId}`;
                } else {
                    console.error('Invalid user ID:', userId);
                    alert('Invalid user selected.');
                }
            });
        });

        document.querySelectorAll('.group-item').forEach(item => {
            item.addEventListener('click', () => {
                const groupId = item.getAttribute('data-group-id');
                console.log('Clicked group ID:', groupId); // Debug log
                if (groupId && groupId > 0) {
                    window.location.href = `chat.php?group_id=${groupId}`;
                } else {
                    console.error('Invalid group ID:', groupId);
                    alert('Invalid group selected.');
                }
            });
        });

        // User search functionality
        document.getElementById('user-search')?.addEventListener('input', function(e) {
            const search = e.target.value.toLowerCase();
            document.querySelectorAll('.user-item').forEach(item => {
                const name = item.querySelector('.username')?.textContent.toLowerCase() || '';
                item.style.display = name.includes(search) ? 'block' : 'none';
            });
        });

        // Modal functions
        function showCreateGroup() { 
            document.getElementById('createGroupModal').style.display = 'block'; 
        }
        function hideCreateGroup() { 
            document.getElementById('createGroupModal').style.display = 'none'; 
        }
        function showAddMember() { 
            document.getElementById('addMemberModal').style.display = 'block'; 
        }
        function hideAddMember() { 
            document.getElementById('addMemberModal').style.display = 'none'; 
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Clean up interval on page unload
        window.addEventListener('beforeunload', function() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        });
    </script>
</body>
</html>