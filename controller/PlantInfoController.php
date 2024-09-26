<?php
    require_once('../../../services/NurseryOwnerService.php');
    require_once('../../../services/PlantInfoService.php');
    // Instantiate the class and get nursery owners
    $plantInfo = new PlantInfo();
    $plants = $plantInfo->getPlantInfos();

    // Instantiate the class to get nursery owners
    $nurseryOwner = new NurseryOwner();
    $owners = $nurseryOwner->getNurseryOwners();
    include_once('../../components/header.php');

    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $plantInfo->clean('id', 'post');
        error_log("Attempting to delete owner with ID: $id"); // Log the ID
        $result = $plantInfo->delete($id);
        
        if ($result) {
            header("Location: index.php");
            exit();
        } else {
            error_log("Deletion failed for ID: $id");
            header("Location: index.php");
        }
    }else if (isset($_POST['action']) && $_POST['action'] == 'create') {
        // Clean input data
        $nurser_owner_id_fk = $nurseryOwner->clean('nurser_owner_id_fk', 'post');
        $plant_type = $nurseryOwner->clean('plant_type', 'post');
        $plant_variety = $nurseryOwner->clean('plant_variety', 'post');
        $planted_date = $nurseryOwner->clean('planted_date', 'post');
        // Call create method to add the new owner
        $plantStatus = $plantInfo->create($nurser_owner_id_fk, $plant_type, $plant_variety, $planted_date);
        // Optionally, you can redirect or show a success message after creation
        if($owners == true){
            // Redirect to index.php
            header("Location: index.php"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: create.php"); 
        }
    }

    if ($title == "PlantInfo Update") {
        // Check if 'userID' is set in the GET request
        if (isset($_GET['userID'])) {
            $id = $_GET['userID'];
    
            $plantSpecificInfo = $plantInfo->getPlantInfoId($id);
    
            // Check if form is submitted
            if (isset($_POST['action']) && $_POST['action'] == 'update') {
                // Clean input data
                $nurser_owner_id_fk = $plantInfo->clean('nurser_owner_id_fk', 'post');
                $plant_type = $plantInfo->clean('plant_type', 'post');
                $plant_variety = $plantInfo->clean('plant_variety', 'post');
                $planted_date = $plantInfo->clean('planted_date', 'post');
    
                // Call create method to add the new owner
                $plantStatus = $plantInfo->update($id, $nurser_owner_id_fk, $plant_type, $plant_variety, $planted_date);
    
                // Optionally, you can redirect or show a success message after creation
                if ($plantStatus == true) {
                    // Redirect to index.php
                    header("Location: index.php"); 
                    exit(); // Important to stop the script after the redirection
                } else if ($plantStatus === false) {
                    echo "<br> nursery ID is $id";
                    echo "<br> nursery ID is $nurser_owner_id_fk";
                    echo "<br> nursery ID is $plant_type";
                    echo "<br> nursery ID is $plant_variety";
                    echo "<br> nursery ID is $planted_date";
                    exit;
                }
            }
        } else {
            // Handle the case where userID is not set
            echo "Error: User ID is required.";
            exit; // Stop execution if userID is not present
        }
    }
    




?>