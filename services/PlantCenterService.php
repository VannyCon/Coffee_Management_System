<?php

require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class CenterServices extends config {

    function generateCenterID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "CENTER-";
        
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
    

    public function getAllCenter() {
        try {
            $query = "SELECT 
                        n.id AS main_nursery_id,
                        n.nursery_id,
                        n.nursery_field,
                        n.source_id,
                        n.type_id,
                        n.variety_id,
                        n.quantity AS nursery_quantity,
                        n.planted_date,
                        n.created_date AS nursery_created_date,
                        c.id AS center_id,
                        c.center_id AS center_identifier,
                        c.center_name,
                        c.center_address,
                        c.nursery_id AS center_nursery_id,
                        c.quantity AS center_quantity,
                        c.created_datetime AS center_created_datetime
                    FROM 
                        tbl_nursery n
                    JOIN 
                        tbl_center c 
                    ON 
                        n.nursery_id = c.nursery_id
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

    public function getCenterById($id) {
        try {
            $query = "SELECT 
                            c.id AS center_id,
                            c.center_name,
                            c.center_address,
                            c.nursery_id AS center_nursery_id,
                            c.quantity AS center_quantity,
                            n.id AS nursery_id,
                            n.nursery_field,
                            n.source_id,
                            n.type_id,
                            n.variety_id,
                            n.quantity AS nursery_quantity,
                            n.planted_date,
                            n.created_date AS nursery_created_date
                        FROM 
                            tbl_center c
                        JOIN 
                            tbl_nursery n
                        ON 
                            c.nursery_id = n.nursery_id
                        WHERE 
                            c.id = :center_id
                        "; // Placeholder corrected to match bindParam
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':center_id', $id, PDO::PARAM_INT); // Corrected placeholder name
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
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
    
    

    public function create($center_name, $center_address, $nursery_id, $quantity, $created_datetime) {
        try {
            $center_id = $this->generateCenterID();
            $query = "INSERT INTO `tbl_center` (`center_id`, `center_name`, `center_address`, `nursery_id`, `quantity`, `created_datetime`) 
                      VALUES (:center_id, :center_name, :center_address, :nursery_id, :quantity, :created_datetime)";
            $stmt = $this->pdo->prepare($query);
    
            // Bind parameters
            $stmt->bindParam(':center_id', $center_id);
            $stmt->bindParam(':center_name', $center_name);
            $stmt->bindParam(':center_address', $center_address);
            $stmt->bindParam(':nursery_id', $nursery_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':created_datetime', $created_datetime);
    
            // Execute the query
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage()); // Log errors instead of echoing them
            return false;
        }
    }
    


    public function update($id, $center_name, $center_address, $nursery_id, $quantity) {
        try {
            $center_id = $this->generateCenterID();
            $query = "UPDATE `tbl_center` SET `center_name`=:center_name,`center_address`=:center_address,`nursery_id`=:nursery_id,`quantity`=:quantity WHERE `id` = :id";
            $stmt = $this->pdo->prepare($query);
    
            // Bind parameters
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':center_name', $center_name);
            $stmt->bindParam(':center_address', $center_address);
            $stmt->bindParam(':nursery_id', $nursery_id);
            $stmt->bindParam(':quantity', $quantity);
    
            // Execute the query
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage()); // Log errors instead of echoing them
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM `tbl_center` WHERE `id` = :id";
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
