<?php
$servername = "localhost";
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['property_id']) && isset($_POST['user_id'])){
        // Retrieve form data
        $propertyId = $_POST['property_id'];
        $userId = $_POST['user_id'];

        // Insert data into 'wishlist' table
        $sql = "INSERT INTO wishlist (user_id, property_id) 
                VALUES ('$userId', '$propertyId')";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            // Send JSON response indicating success
            echo json_encode(array('success' => true, 'message' => 'Property added to wishlist.'));
            exit();
        } else {
            // Send JSON response with error message
            echo json_encode(array('success' => false, 'message' => 'Error adding property to wishlist.'));
        }
    } else {
        // Send JSON response indicating missing parameters
        echo json_encode(array('success' => false, 'message' => 'Missing parameters.'));
    }
}
?>
