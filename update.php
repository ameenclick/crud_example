<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $id = $_GET['id'];
    $site = $_POST['site'];
    $link = $_POST['link'];
    $description = $_POST['description'];

    // Perform database update or any other required backend operations
    // Create connection to MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql = "UPDATE links SET site = '$site', link = '$link', description = '$description' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Return a response (JSON object) to the frontend
        $response = [
            'success' => true,
            'message' => 'Link updated successfully.'
        ];
    } else {
        $response = [
            'error' => true,
            'message' => 'Error updating the link.'
        ];
    }

    echo json_encode($response);
    exit;
}
?>
