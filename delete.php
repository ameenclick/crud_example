<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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
// Check if the ID parameter is present
    if (isset($_POST['id'])) 
    {
        $id = $_POST['id'];
        // Prepare the SQL statement
        $sql = "DELETE FROM links WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            // Return a success response
            $response = [
            'success' => true,
            'message' => 'Record deleted successfully.'
            ];
        } else {
            // Return an error response
            $response = [
            'success' => false,
            'message' => 'Error deleting record: ' . mysqli_error($conn)
            ];
        }

        echo json_encode($response);
    } else {
    // Return an error response if the ID parameter is missing
    $response = [
        'success' => false,
        'message' => 'Invalid request. ID parameter is missing.'
    ];

    echo json_encode($response);
    }
}
?>