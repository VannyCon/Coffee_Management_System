<?php 
    include_once('controller/LoginController.php');

// Ensure $harvestableNurseries is populated
if (!empty($harvestableNurseries)) {
    foreach ($harvestableNurseries as $nursery) {
        // Prepare SMS message
        $message = "Harvest Reminder: Field {$nursery['nursery_field']} can be Harvested Now!";

        // Your Infobip API key
        $apiKey = '00b76d32504ca8a887765dbc398f01b1-424273f6-0a31-4c03-823f-1e49682f3cbf';
        $apiUrl = 'https://api.infobip.com/sms/2/text/advanced';
        $recipient = '+639948226443'; // Adjust recipient based on your requirements

        // Prepare the payload
        $payload = [
            'messages' => [
                [
                    'from' => 'YourSenderID',  // Sender ID (can be alphanumeric)
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

        // Execute the request and log the response
        $response = curl_exec($ch);

        // Error handling for the request
        if (curl_errno($ch)) {
            // Log error with nursery ID for debugging
            // echo "Error for nursery {$nursery['nursery_id']}: " . curl_error($ch) . "\n";
        } else {
            // Log the response for debugging
            // echo "SMS sent for nursery {$nursery['nursery_id']}: " . $response . "\n";
        }

        // Close cURL
        curl_close($ch);

        // Optional: Delay between requests to avoid rate limiting
        sleep(2); // Sleep for 1 second between each request (adjust as needed)
    }
} else {
    // Log if no nurseries are available for harvesting
    // echo "No harvestable nurseries available.\n";
}
