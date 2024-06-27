<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST); // Add this line to print the contents of the $_POST array

    $mail = $_POST['mail'];
    $psw = $_POST['psw'];
    $psw2 = $_POST['psw2'];

    // Create connection
    $conn = mysqli_connect('localhost', 'root', '', 'test');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO registration (mail, psw, psw2) VALUES (?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    // Bind parameters
    if (!$stmt->bind_param("sss", $mail, $psw, $psw2)) {
        die("Binding parameters failed: " . htmlspecialchars($stmt->error));
    }

    // Execute the statement
    if (!$stmt->execute()) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    } else {
        echo "Successfully added";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No POST data received.";
}
?>
