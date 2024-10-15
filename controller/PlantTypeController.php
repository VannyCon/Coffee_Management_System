<?php
require_once('../../../services/PlantTypeService.php');

$typeServices = new TypeServices();
$types = $typeServices->getPlantType();



    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $typeServices->clean('id', 'post');
        error_log("Attempting to delete owner with ID: $id"); // Log the ID
        $result = $typeServices->delete($id);
        
        if ($result) {
            header("Location: index.php");
            exit();
        } else {
            error_log("Deletion failed for ID: $id");
            header("Location: index.php");
        }
    }else if (isset($_POST['action']) && $_POST['action'] == 'create') {
        // Clean input data
        $type_name = $typeServices->clean('type_name', 'post');
        $description = $typeServices->clean('description', 'post');
        // Call create method to add the new owner
        $typeStatus = $typeServices->create($type_name, $description);
        // Optionally, you can redirect or show a success message after creation
        if($typeStatus == true){
            // Redirect to index.php
            header("Location: index.php"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: create.php"); 
        }
    }

    if($title = "NurseryOwner Update"){

        if(isset($_GET['ID'])){
            // Instantiate the class and get nursery owners
            $user_id = $_GET['ID'];

            $getSpecificType = $typeServices->getTypeById($user_id);

            if (isset($_POST['action']) && $_POST['action'] == 'update') {
                // Clean input data
                $type_name = $typeServices->clean('type_name', 'post');
                $description = $typeServices->clean('description', 'post');
                // Call create method to add the new owner
                $owners = $typeServices->update($getSpecificType['id'], $type_name, $description);
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