<?php
session_start();
include 'top2.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

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

$userId = $_SESSION['user_id']; // Correct session variable for user ID

// Fetch wishlist items for the logged-in user
$stmt = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="wishlistStyles.css"> <!-- Add your wishlist styles -->
</head>
<body>
    <div class="wishlist-container">
        <h1>Wishlist</h1>
        <?php
        if ($result->num_rows > 0) {
            // Output wishlist items
            while ($row = $result->fetch_assoc()) {
                echo "<div class='wishlist-item'>" . $row['property_name'] . "</div>";
            }
        } else {
            echo "<p>Your wishlist is empty.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php include 'bottom.php'; ?>

