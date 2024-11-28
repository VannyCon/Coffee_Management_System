<?php 
include_once('controller/LoginController.php');

// Check if fertilizationDue is properly populated
if (!empty($fertilizationDue)) {
    foreach ($fertilizationDue as $nursery) {
        // Prepare SMS message
        $message = "Fertilized Reminder: Field {$nursery['nursery_field']} in Can be Fertilized Now! ";

        $apiKey = 'cba5c9e80d8390195214918fb620c961-f3ae1174-a83e-4535-9776-553c6e3b0ae1';
        $apiUrl = 'https://m38ve6.api.infobip.com/sms/2/text/advanced';
        $recipient = '+639934778549'; // Adjust recipient based on your requirements
        
        

        // Prepare the payload
        $payload = [
            'messages' => [
                [
                    'from' => 'YourSenderID',
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
            // Log or display the response for debugging
            // echo 'Response:' . $response;
        }

        // Close cURL
        curl_close($ch);

        // Optional: Delay between requests to avoid rate limiting
        sleep(2); // Sleep for 1 second between each request (adjust as needed)
    }
} else {
    // echo "No fertilization reminders available.";
}
