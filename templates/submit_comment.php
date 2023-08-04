<?php
	include "db_config.php"; // Include the database configuration file

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$imageId = $_POST["image_id"];
		$comment = $_POST["comment"];

		$query = "INSERT INTO comments (image_id, comment) VALUES ('$imageId', '$comment')";
		$result = mysqli_query($conn, $query);

		if (!$result) {
			echo "Error: " . mysqli_error($conn);
		} else {
			echo "Comment inserted into the database<br />";
		}
	}

	// Close the database connection
	mysqli_close($conn);
?>
