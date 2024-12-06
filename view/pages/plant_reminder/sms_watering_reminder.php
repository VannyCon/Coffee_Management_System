
<?php
include_once('../../../controller/PlantNurseryController.php');

        // Array to hold data to send
        $send_data = [];

        // START - Parameters to Change
        // Set the Sender ID
        $send_data['sender_id'] = "PhilSMS"; // Replace with your sender ID

        // Add recipient(s) - use the international format (e.g., +63 for the Philippines)
        $send_data['recipient'] = "+639934778549"; // Replace with the recipient's number

        // Add your message content
        $send_data['message'] = "Watering Reminder: Hello, Please Water Your Plant Thanks!";

        // Your API Token
        $token = "1185|QIFNfb8NzFhL4HkbJ0hEgzkgOtrBQptuhkKKKkmF"; // Replace with your API token
        // END - Parameters to Change

        // Convert the data array to JSON
        $parameters = json_encode($send_data);

        // Initialize cURL
        $ch = curl_init();

        // Set the API endpoint for sending SMS
        curl_setopt($ch, CURLOPT_URL, "https://app.philsms.com/api/v3/sms/send");

        // Use POST method
        curl_setopt($ch, CURLOPT_POST, true);

        // Add the JSON data as the request body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);

        // Expect a response from the server
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Add headers
        $headers = [
            "Content-Type: application/json",            // Set content type to JSON
            "Authorization: Bearer $token"              // Add Authorization Bearer Token
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute the request
        $get_sms_status = curl_exec($ch);

        // Close the cURL session
        curl_close($ch);

        // Output the response
        echo "Response from API:\n";
        var_dump($get_sms_status);

?>
