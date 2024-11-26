<?php

// Your Infobip API key
$apiKey = '00b76d32504ca8a887765dbc398f01b1-424273f6-0a31-4c03-823f-1e49682f3cbf';

// The endpoint for sending SMS
$apiUrl = 'https://api.infobip.com/sms/2/text/advanced';

// Recipient phone number
$recipient = '+639948226443';

// Message content
$message = 'Watering Reminder: Hello, Please Water Your Plant Thanks!';

// Prepare the payload
$payload = [
    'messages' => [
        [
            'from' => 'YourSenderID', // Sender ID (can be alphanumeric)
            'destinations' => [
                ['to' => $recipient]
            ],
            'text' => $message
        ]
    ]
];

// Initialize cURL
$ch = curl_init($apiUrl);

// Set the necessary cURL options
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: App $apiKey",
    'Content-Type: application/json',
    'Accept: application/json'
]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    // echo 'Error:' . curl_error($ch);
} else {
    // echo 'Response:' . $response;
}

// Close cURL
curl_close($ch);

// Optional: Delay between requests to avoid rate limiting
sleep(2); // Sleep for 1 second between each request (adjust as needed)
