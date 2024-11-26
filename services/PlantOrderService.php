<?php

require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class OrderServices extends config {

    function generateOrderID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "ORDER-";
        
        // Get the current timestamp in microseconds
        $timestamp = microtime(true);
        
        // Generate a random number to add more uniqueness
        $randomNumber = mt_rand(100000, 999999);
        
        // Hash the timestamp and random number to create a unique identifier
        $uniqueHash = hash('sha256', $timestamp . $randomNumber);
        
        // Take the first 12 characters of the hash (or any desired length)
        $patientID = substr($uniqueHash, 0, 10);
        
        // Return the final patient ID with prefix
        return $prefix . strtoupper($patientID);
    }
    

    public function getAllOrder() {
        try {
            $query = "SELECT 
                        o.id,
                        o.order_id,
                        o.nursery_id,
                        o.order_name,
                        o.order_quantity,
                        o.order_price,
                        o.order_total,
                        o.order_datetime,
                        n.id,
                        n.nursery_field,
                        n.source_id,
                        n.type_id,
                        n.variety_id,
                        n.quantity AS nursery_quantity,
                        n.planted_date,
                        n.created_date
                    FROM 
                        tbl_order o
                    JOIN 
                        tbl_nursery n 
                    ON 
                        o.nursery_id = n.nursery_id
                    WHERE 
                        1
                    ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function create($nursery_id, $order_name, $order_quantity, $order_price, $order_total, $order_datetime) {
        try {
            $order_id = $this->generateOrderID();
            // Define the query with corrected placeholders
            $query = "INSERT INTO `tbl_order` (`order_id`, `nursery_id`, `order_name`, `order_quantity`, `order_price`, `order_total`, `order_datetime`) 
                      VALUES (:order_id, :nursery_id, :order_name, :order_quantity, :order_price, :order_total, :order_datetime)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':nursery_id', $nursery_id);
            $stmt->bindParam(':order_name', $order_name);
            $stmt->bindParam(':order_quantity', $order_quantity);
            $stmt->bindParam(':order_price', $order_price);
            $stmt->bindParam(':order_total', $order_total);
            $stmt->bindParam(':order_datetime', $order_datetime);
            // Execute the query
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function getPlantInfos() {
        try {
            $query = "SELECT 
                            n.id,
                            n.nursery_id,
                            n.nursery_field,
                            n.type_id,
                            t.type_name,
                            t.description AS type_description,
                            n.variety_id,
                            v.variety_name,
                            v.description AS variety_description,
                            n.quantity,
                            n.planted_date,
                            n.created_date
                        FROM 
                            tbl_nursery n
                        JOIN 
                            tbl_type t ON n.type_id = t.type_id
                        JOIN 
                            tbl_variety v ON n.variety_id = v.variety_id
                        WHERE 
                            1;
                        ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update($id, $type_name, $description) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_type` 
                      SET `type_name` = :type_name, `description` = :description
                      WHERE `id` = :id";
    
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':type_name', $type_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id', $id); // Bind the ID to identify which record to update
    
            // Execute the query
            $stmt->execute();
    
            // Return success or other relevant response
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }
    

    public function delete($id) {
        try {
            $query = "DELETE FROM `tbl_type` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            // Check if the deletion was successful
            return $stmt->rowCount() > 0; // Return true if at least one row was deleted
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    

}




?>
