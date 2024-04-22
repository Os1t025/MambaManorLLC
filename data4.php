<?php
// This file is for adding properties to the wishlist
$servername = "localhost";
$username = "bmaldonado4";
$password = "bmaldonado4";
$dbname = "bmaldonado4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if property_id and user_id are set in POST
if (isset($_POST['property_id']) && isset($_POST['user_id'])) {
    $property_id = $_POST['property_id'];
    $user_id = $_POST['user_id'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO wishlist (user_id, property_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $property_id);

    // Execute statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Property added to wishlist successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding property to wishlist']);
    }

    // Close statement
    $stmt->close();
} else {
    // Error message for missing parameters
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
}

// Close the database connection
$conn->close();
?>
