<?php
session_start();

if (isset($_SESSION['username'])) {
    $servername = "localhost";
    $username = "mclaros1";
    $password = "mclaros1";
    $dbname = "mclaros1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve username from session
    $username = $_SESSION['username'];

    // Retrieve property name from the form
    $propertyName = $_POST['property_name'];

    // Get property ID from database
    $sql = "SELECT id FROM properties WHERE name = '$propertyName'";
    $result = $conn->query($sql);
    echo '<pre>';
    var_dump($_SESSION);
    var_dump($_POST);
    echo '</pre>';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $propertyId = $row['id'];

        // Add property to wishlist
        $sql = "INSERT INTO wishlist (user_id, username, property_id, property_name) VALUES ('$username', '$propertyName', '$propertyId')";
        if ($conn->query($sql) === TRUE) {
            echo "Property added to wishlist successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Property not found.";
    }

    $conn->close();
} else {
    echo "User not logged in.";
}
?>

