<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the POST data
    $order_quantity = $_POST['order_quantity'] ?? null;
    $order_price = $_POST['order_price'] ?? null;
    $order_total = $_POST['order_total'] ?? null;
    $source_contact = $_POST['source_contact'] ?? null;

    // Ensure that all required data is available
    if ($order_quantity && $order_price && $order_total && $source_contact) {
        // Your Infobip API key
        $apiKey = 'cba5c9e80d8390195214918fb620c961-f3ae1174-a83e-4535-9776-553c6e3b0ae1';
        $apiUrl = 'https://m38ve6.api.infobip.com/sms/2/text/advanced';
        $recipient = '+639934778549'; // Adjust recipient based on your requirements
        

        // Correct message format with proper concatenation
        $message = "Hello this is Dr. Patrick Escalante, I am placing an order for seeds at your farm.\n"
                 . "Order details:\n"
                 . "\n"
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
