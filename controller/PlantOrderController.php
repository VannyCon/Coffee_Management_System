<?php
    require_once('../../../services/PlantOrderService.php');
    // Instantiate the class and get nursery owners
    $orderService = new OrderServices();
    //This part show on index.php
    $orders = $orderService->getAllOrder();
    $plantInfos = $orderService->getPlantInfos();
    


    if (isset($_POST['action']) && $_POST['action'] == 'createOrder') {
            // Clean input data
            $nursery_id = $orderService->clean('nursery_id', 'post');
            $order_name = $orderService->clean('order_name', 'post');
            $order_quantity = $orderService->clean('order_quantity', 'post');
            $order_price = $orderService->clean('order_price', 'post');
            $order_total = $orderService->clean('order_total', 'post');
            $order_datetime = $orderService->clean('order_datetime', 'post');
            // Call create method to add the new owner
            $orderStatus = $orderService->create($nursery_id, $order_name, $order_quantity, $order_price, $order_total, $order_datetime);
            // Optionally, you can redirect or show a success message after creation
            if($orderStatus == true){
                header("Location: index.php"); 
                exit(); // Important to stop the script after the redirection
            }else{
                header("Location: create.php"); 
            }
        }


    // /// THIS PART TO GET NURSERYOWNER
    // $sourceServices = new NurseryOwner();
    
    // $sources = $sourceServices->getNurseryOwners();

    // /// THIS PART TO GET NURSERYOWNER
    // $typeService = new TypeServices();
    // $types = $typeService->getPlantType();

    // /// THIS PART TO GET NURSERYOWNER
    // $varietyService = new VarietyServices();
    // $varietys = $varietyService->getPlantVariety();

    


    // if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    //     $id = $nurseryServices->clean('id', 'post');
    //     error_log("Attempting to delete owner with ID: $id"); // Log the ID
    //     $result = $nurseryServices->delete($id);
        
    //     if ($result) {
    //         header("Location: index.php");
    //         exit();
    //     } else {
    //         error_log("Deletion failed for ID: $id");
    //         header("Location: index.php");
    //         exit();
    //     }
    // } else if (isset($_POST['action']) && $_POST['action'] == 'create') {
    //     // Clean input data
    //     $nursery_field = $nurseryServices->clean('nursery_field', 'post');
    //     $source_id = $nurseryServices->clean('source_id', 'post');
    //     $type_id = $nurseryServices->clean('type_id', 'post');
    //     $variety_id = $nurseryServices->clean('variety_id', 'post');
    //     $quantity = $nurseryServices->clean('quantity', 'post');
    //     $planted_date = $nurseryServices->clean('planted_date', 'post');
    //     // Call create method to add the new owner
    //     $plantStatus = $nurseryServices->create($nursery_field, $source_id, $type_id, $variety_id, $quantity, $planted_date);
    //     // Optionally, you can redirect or show a success message after creation
    //     if($plantStatus == true){
    //         header("Location: index.php"); 
    //         exit(); // Important to stop the script after the redirection
    //     }else{
    //         header("Location: create.php"); 
    //     }
    // }

    // if ($title_Info == "Nursery Update") {
    //     // Check if 'userID' is set in the GET request
    //     if (isset($_GET['ID'])) {
    //         $id = $_GET['ID'];
    //         $nurserySpecificInfo = $nurseryServices->getPlantInfoId($id);
    
    //         // Check if form is submitted
    //         if (isset($_POST['action']) && $_POST['action'] == 'update') {
    //             // Clean input data
    //             $nursery_field = $nurseryServices->clean('nursery_field', 'post');
    //             $source_id = $nurseryServices->clean('source_id', 'post');
    //             $type_id = $nurseryServices->clean('type_id', 'post');
    //             $variety_id = $nurseryServices->clean('variety_id', 'post');
    //             $quantity = $nurseryServices->clean('quantity', 'post');
    //             $planted_date = $nurseryServices->clean('planted_date', 'post');
    //             // Call create method to add the new owner
    //             $plantStatus = $nurseryServices->update($id, $nursery_field, $source_id, $type_id, $variety_id, $quantity, $planted_date);
    //             // Optionally, you can redirect or show a success message after creation
    //             if ($plantStatus == true) {
    //                 // Redirect to index.php
    //                 header("Location: index.php"); 
    //                 exit(); // Important to stop the script after the redirection
    //             } else if ($plantStatus) {
    //                 echo "<br> nursery ID is $id";
    //                 echo "<br> nursery ID is $nursery_field";
    //                 echo "<br> nursery ID is $type_id";
    //                 echo "<br> nursery ID is $variety_id";
    //                 echo "<br> nursery ID is $planted_date";
    //                 exit;
    //             }
    //         }
    //     } else {
    //         // Handle the case where userID is not set
    //         echo "Error: User ID is required.";
    //         exit; // Stop execution if userID is not present
    //     }
    // }
?>