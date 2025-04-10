<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lilo&Stitch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $film_id = isset($_POST['film_id']) ? (int) $_POST['film_id'] : 0;
    $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $comment_text = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : '';

    if ($film_id > 0 && !empty($user_name) && !empty($comment_text)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO Comments (user_name, comment_text, film_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssi", $user_name, $comment_text, $film_id);

        if ($stmt->execute()) {
            // Redirect back to the film page
            header("Location: filmDetails.php?id=" . $film_id);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid input. Please fill all fields.";
    }
}

$conn->close();
?>
