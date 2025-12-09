let selectedUserId = null;

// Fetch and display the list of users
function fetchUsers() {
    $.ajax({
        url: "fetch_users.php", // Backend script to fetch users
        type: "GET",
        success: function(response) {
            const users = JSON.parse(response);
            const userList = document.getElementById("user-list");
            userList.innerHTML = ""; // Clear the user list
            users.forEach(user => {
                const userElement = document.createElement("div");
                userElement.textContent = user.username;
                userElement.dataset.userId = user.id;
                userElement.classList.add("user-item");
                userElement.addEventListener("click", () => selectUser(user.id));
                userList.appendChild(userElement);
            });
        },
        error: function(error) {
            console.error("Error fetching users:", error);
        }
    });
}

// Select a user to chat with
function selectUser(userId) {
    selectedUserId = userId;
    document.getElementById("messages").innerHTML = ""; // Clear chat box
    fetchMessages(userId); // Fetch messages for the selected user
}

// Fetch messages for the selected user
function fetchMessages(userId) {
    $.ajax({
        url: "fetch_message.php",
        type: "POST",
        data: {
            chat_type: "user",
            chat_id: userId
        },
        success: function(response) {
            const messages = JSON.parse(response);
            const messageBox = document.getElementById("messages");
            messageBox.innerHTML = ""; // Clear previous messages
            messages.forEach(message => {
                const messageElement = document.createElement("div");
                messageElement.textContent = `${message.sender_name}: ${message.message}`;
                messageBox.appendChild(messageElement);
            });
        },
        error: function(error) {
            console.error("Error fetching messages:", error);
        }
    });
}

// Send a message to the selected user
document.getElementById("send-message").addEventListener("click", function() {
    const messageInput = document.getElementById("message-input");
    const message = messageInput.value;
    if (!message || !selectedUserId) {
        alert("Please select a user and type a message.");
        return;
    }

    $.ajax({
        url: "send_message.php",
        type: "POST",
        data: {
            sender_id: 1, // Replace with the logged-in user's ID
            receiver_id: selectedUserId,
            message: message
        },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.status === "success") {
                fetchMessages(selectedUserId); // Refresh messages
                messageInput.value = ""; // Clear input
            } else {
                alert(result.message);
            }
        },
        error: function(error) {
            console.error("Error sending message:", error);
        }
    });
});

// Fetch users on page load
fetchUsers();