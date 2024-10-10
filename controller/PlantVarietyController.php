<?php
    session_start();
    // Redirect to login if not logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../../../index.php");
        exit();
    }
    require_once('../../../services/PlantVarietyService.php');
    // Instantiate the class and get nursery owners
    $varietyService = new VarietyServices();
    $varietys = $varietyService->getPlantVariety();

    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $varietyService->clean('id', 'post');
        error_log("Attempting to delete owner with ID: $id"); // Log the ID
        $result = $varietyService->delete($id);
        
        if ($result) {
            header("Location: index.php");
            exit();
        } else {
            error_log("Deletion failed for ID: $id");
            header("Location: index.php");
        }
    }else if (isset($_POST['action']) && $_POST['action'] == 'create') {
        // Clean input data
        $variety_name = $varietyService->clean('variety_name', 'post');
        $description = $varietyService->clean('description', 'post');
        // Call create method to add the new owner
        $typeStatus = $varietyService->create($variety_name, $description);
        // Optionally, you can redirect or show a success message after creation
        if($typeStatus == true){
            // Redirect to index.php
            header("Location: index.php"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: create.php"); 
        }
    }

    if($title = "Variety Update"){

        if(isset($_GET['ID'])){
            // Instantiate the class and get nursery owners
            $id = $_GET['ID'];

            $getSpecificType = $varietyService->getVarietyById($id);

            if (isset($_POST['action']) && $_POST['action'] == 'update') {
                // Clean input data
                $variety_name = $varietyService->clean('variety_name', 'post');
                $description = $varietyService->clean('description', 'post');
                // Call create method to add the new owner
                $owners = $varietyService->update($getSpecificType['id'], $variety_name, $description);
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