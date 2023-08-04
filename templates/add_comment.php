<?php
include "db_config.php"; // Include the database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$imageId = $_POST["imageId"]; // Getting the image ID
	$comment = $_POST["comment"]; // Getting the comment from the form

	// Insert the comment into the comments table
	$query = "INSERT INTO comments (image_id, comment) VALUES ('$imageId', '$comment')";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		$response = [
			'success' => false,
			'error' => mysqli_error($conn)
		];
	} else {
		$response = ['success' => true];
	}

	// Close the database connection
	mysqli_close($conn);

	// Send the response back to the AJAX request
	header('Content-Type: application/json');
	echo json_encode($response);
}
?>
