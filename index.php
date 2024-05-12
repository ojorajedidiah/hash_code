<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the payload from the request
  $payload = file_get_contents('php://input');

  // Specify the file where the payload will be stored
  $file = 'payload.txt';

  // Write the payload to the specified file
  file_put_contents($file, $payload,FILE_APPEND);

  // get the originating IP
  // Check if the IP is IPv6 and get the originating IP address
  $ip = $_SERVER['REMOTE_ADDR'];
  if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    $originatingIP = "\nOriginating IP is ".$ip;
    file_put_contents($file,$ip,FILE_APPEND);
  } else {
    echo "\nNot an IPv6 address";
  }

  // Send a response back to the client
  echo "\nPayload received and written to file.";
} else {
  // Handle other request methods or send an error message
  http_response_code(405); // Method Not Allowed
  echo "Invalid request method. Only POST is supported.";
}

?>