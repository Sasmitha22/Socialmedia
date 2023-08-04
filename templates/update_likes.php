<?php
// Include the database configuration file
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $imageId = $_POST["imageId"];

  // Update the like count in the database
  $query = "UPDATE images SET likes = likes + 1 WHERE id = $imageId";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    $response = array("success" => false, "error" => "Failed to update like count.");
  } else {
    $response = array("success" => true);
  }

  // Return the response as JSON
  header("Content-Type: application/json");
  echo json_encode($response);
}
?>
