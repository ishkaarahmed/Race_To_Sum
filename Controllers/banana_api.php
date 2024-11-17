<?php
// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Set up the URL for the Banana API
$api_url = "http://marcconrad.com/uob/banana/api.php";

// Call the API and get the response
$response = file_get_contents($api_url);

// Check if the API call was successful
if ($response === FALSE) {
    echo json_encode(["error" => "Failed to retrieve data from the Banana API"]);
} else {
    // Check if response is a valid JSON
    $json_data = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo $response; // Send the valid JSON back to the client
    } else {
        echo json_encode(["error" => "Invalid JSON received from the API"]);
    }
}
?>
