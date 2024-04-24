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
    echo "property name" . $propertyName . "<br>";

    switch($propertyName){
        case 'phineas':
            $propertyName='Phineas';
            break;
        case 'simpsons':
            $propertyName='Simpsons';
            break;
        case 'spongebob':
            $propertyName='Spongebob';
            break;
        case 'familyguy':
            $propertyName='FamilyGuy';
            break;
        case 'gravityfall':
            $propertyName='Gravity Falls';
            break;
        case 'teentitans':
            $propertyName='Teen Titans';
            break;
    }

    // Get property ID from database
    $sql = "SELECT id FROM properties WHERE name = '$propertyName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $propertyId = $row['id'];

        // Add property to wishlist
        $sql = "INSERT INTO wishlist (user_id, property_id) VALUES (user_id, (SELECT id FROM properties WHERE name = '$propertyName'))";
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

