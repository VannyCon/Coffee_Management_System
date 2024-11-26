<?php

require_once('../../../services/PlantSourceService.php');

// Instantiate the class and get nursery owners
$sourceService = new SourceService();
$owners = $sourceService->getNurseryOwners();
////// IF DELETE ACTION
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $sourceService->clean('id', 'post');
    error_log("Attempting to delete owner with ID: $id"); // Log the ID
    $result = $sourceService->delete($id);
    
    if ($result) {
        header("Location: index.php");
    } else {
        error_log("Deletion failed for ID: $id");
        header("Location: index.php");
    }
///// IF CREATE ACTION
}else if (isset($_POST['action']) && $_POST['action'] == 'create') {
    // Clean input data
    $fullname = $sourceService->clean('fullname', 'post');
    $source_email = $sourceService->clean('source_email', 'post');
    $source_variety = $sourceService->clean('source_variety', 'post');
    $source_quantity = $sourceService->clean('source_quantity', 'post');
    $contact_number = $sourceService->clean('contact_number', 'post');
    $address = $sourceService->clean('address', 'post');
    // Call create method to add the new owner
    $owners = $sourceService->create($fullname,  $source_variety, $source_quantity, $contact_number, $source_email,  $address);
    // Optionally, you can redirect or show a success message after creation
    if($owners == true){
         // Redirect to index.php
         header("Location: index.php"); 
         exit(); // Important to stop the script after the redirection
         
    }else{
        header("Location: create.php"); 
    }
}else if (isset($_POST['action']) && $_POST['action'] == 'addSourceOrder') {
    // Clean input data
    $source_id = $sourceService->clean('source_id', 'post');
    $order_quantity = $sourceService->clean('order_quantity', 'post');
    $order_price = $sourceService->clean('order_price', 'post');
    $order_total = $sourceService->clean('order_total', 'post');
    $source_contact = $sourceService->clean('source_contact', 'post');
    
    
    // Call create method to add the new order
    $owners = $sourceService->createSourceOrder($source_id, $order_quantity, $order_price, $order_total);
    
    if ($owners == true) {
        // POST data to order_reminder.php
        $postData = [
            'order_quantity' => $order_quantity,
            'order_price' => $order_price,
            'order_total' => $order_total,
            'source_contact' => $source_contact
        ];
        
        $ch = curl_init('http://localhost:8080/new_project/coffee-tracking-system/view/pages/plant_source/order_reminder.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        
        $response = curl_exec($ch);
        curl_close($ch);

        // After posting to order_reminder.php, redirect to index.php
        header("Location: index.php");
        exit(); // Important to stop the script after the redirection
    } else {
        // Redirect to create.php on failure
        header("Location: create.php");
        exit();
    }
}



///// IF UPDATE ACTION
if($title = "NurseryOwner Update"){

    if(isset($_GET['userID'])){
        // Instantiate the class and get nursery owners
        $user_id = $_GET['userID'];
        $getSpecificOwner = $sourceService->getNurseryOwnerById($user_id);

        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            // Clean input data
            $fullname = $sourceService->clean('fullname', 'post');
            $source_email = $sourceService->clean('source_email', 'post');
            $source_variety = $sourceService->clean('source_variety', 'post');
            $source_quantity = $sourceService->clean('source_quantity', 'post');
            $contact_number = $sourceService->clean('contact_number', 'post');
            $address = $sourceService->clean('address', 'post');
            // Call create method to add the new owner
            $owners = $sourceService->update($getSpecificOwner['id'], $source_variety, $source_quantity, $fullname, $contact_number,$source_email, $address);
            // Optionally, you can redirect or show a success message after creation
            if($owners == true){
                // Redirect to index.php
                header("Location: index.php"); 
                exit(); // Important to stop the script after the redirection
            }else{
                header("Location: create.php"); 
            }
        }
    }
}

?>