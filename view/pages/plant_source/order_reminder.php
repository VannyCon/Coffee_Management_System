<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the POST data
    $order_quantity = $_POST['order_quantity'] ?? null;
    $order_price = $_POST['order_price'] ?? null;
    $order_total = $_POST['order_total'] ?? null;
    $source_contact = $_POST['source_contact'] ?? null;
    $source_variety = $_POST['source_variety'] ?? null;
    // Ensure that all required data is available
    if ($order_quantity && $order_price && $order_total && $source_contact ) {
        // Your Infobip API key
// Your Infobip API key
$apiKey = '00b76d32504ca8a887765dbc398f01b1-424273f6-0a31-4c03-823f-1e49682f3cbf';

// The endpoint for sending SMS
$apiUrl = 'https://api.infobip.com/sms/2/text/advanced';

// Recipient phone number
$recipient = '+639948226443';

        // Correct message format with proper concatenation
        $message = "Placing Order:.\n"
                 . "Order details:\n"
                 . "  Variety: Testings\n"
                 . "  Quantity: " . $order_quantity . "\n"
                 . "  Asking Price: " . $order_price . "\n"
                 . "  Order Total: " . $order_total . "\n"
                 . "\n"
                 . "Thank you!";

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
            echo 'Error:' . curl_error($ch);
        } else {
            echo 'Response:' . $response;
        }

        // Close cURL
        curl_close($ch);
    } else {
        echo 'Missing required fields.';
    }
} else {
    echo 'Invalid request method.';
}
?>
