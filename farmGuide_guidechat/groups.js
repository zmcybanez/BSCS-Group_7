$.ajax({
    url: "create_group.php",
    type: "POST",
    data: {
        group_name: "Farmers Group",
        created_by: 1, // Replace with the logged-in user's ID
        members: [2, 3] // Replace with the selected user IDs
    },
    success: function(response) {
        console.log(response);
        alert(response.message);
    },
    error: function(error) {
        console.error("Error creating group:", error);
    }
});