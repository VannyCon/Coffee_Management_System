<?php

require_once('../../../services/PlantSourceService.php');
// Instantiate the class and get nursery owners
$nurseryOwner = new NurseryOwner();
$owners = $nurseryOwner->getNurseryOwners();

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $nurseryOwner->clean('id', 'post');
    error_log("Attempting to delete owner with ID: $id"); // Log the ID
    $result = $nurseryOwner->delete($id);
    
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        error_log("Deletion failed for ID: $id");
        header("Location: index.php");
    }
}else if (isset($_POST['action']) && $_POST['action'] == 'create') {
    // Clean input data
    $fullname = $nurseryOwner->clean('fullname', 'post');
    $contact_number = $nurseryOwner->clean('contact_number', 'post');
    $address = $nurseryOwner->clean('address', 'post');
    // Call create method to add the new owner
    $owners = $nurseryOwner->create($fullname, $contact_number, $address);
    // Optionally, you can redirect or show a success message after creation
    if($owners == true){
         // Redirect to index.php
         header("Location: index.php"); 
         exit(); // Important to stop the script after the redirection
    }else{
        header("Location: create.php"); 
    }
}

if($title = "NurseryOwner Update"){

    if(isset($_GET['userID'])){
        // Instantiate the class and get nursery owners
        $user_id = $_GET['userID'];
        $nurseryOwner = new NurseryOwner();
        $getSpecificOwner = $nurseryOwner->getNurseryOwnerById($user_id);

        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            // Clean input data
            $fullname = $nurseryOwner->clean('fullname', 'post');
            $contact_number = $nurseryOwner->clean('contact_number', 'post');
            $address = $nurseryOwner->clean('address', 'post');
            // Call create method to add the new owner
            $owners = $nurseryOwner->update($getSpecificOwner['id'], $fullname, $contact_number, $address);
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