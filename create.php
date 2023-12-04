<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $site = $_POST['site'];
    $link = $_POST['link'];
    $description = $_POST['description'];

    // Perform database insertion or any other required backend operations
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
    $sql = "INSERT INTO links (site, link, description) VALUES ('$site', '$link', '$description')";

    if(mysqli_query($conn, $sql))
    {
        // Return a response (JSON object) to the frontend
        $response = [
            'success' => true,
            'message' => 'Link added successfully.'
        ];
    }
    else
    {
        $response = [
            'error' => true,
            'message' => 'Query Error with data added.'
        ];
    }

    echo json_encode($response);
    exit;
}

// Function to sanitize user input
// function sanitizeInput($input) {
//     // Use htmlspecialchars to convert special characters to HTML entities
//     $sanitizedInput = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
//     return $sanitizedInput;
// }
?>
