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
    if ($order_quantity && $order_price && $order_total && $source_contact && $source_variety) {


        // Array to hold data to send
        $send_data = [];

        // START - Parameters to Change
        // Set the Sender ID
        $send_data['sender_id'] = "PhilSMS"; // Replace with your sender ID

        // Add recipient(s) - use the international format (e.g., +63 for the Philippines)
        // Remove the first character (assumed to be '0') from $source_contact
        $cleaned_contact = ltrim($source_contact, '0');

        // Prepend "+63" to the cleaned contact number
        $send_data['recipient'] = "+63$cleaned_contact";


        // Add your message content
        $send_data['message'] = "Hello this is Dr. Patrick Escalante, I am placing an order for seeds at your farm. \n"
                 . "Order details:\n"
                 . "  Variety: " . $source_variety. "\n"
                 . "  Quantity: " . $order_quantity . "\n"
                 . "  Asking Price: " . $order_price . "\n"
                 . "  Order Total: " . $order_total . "\n"
                 . "\n"
                 . "Contact us at: 09123456789\n"
                 . "\n"
                 . "Thank you!";

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
    }
} else {
    echo 'Invalid request method.';
}
?>
