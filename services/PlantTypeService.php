<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class TypeServices extends config {

    function generateTypeID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "TID-";
        
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
    

    public function getPlantType() {
        try {
            $query = "SELECT `id`, `type_id`, `type_name`, `description` FROM `tbl_type` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function create($type_name, $description) {
        try {
            $type_id = $this->generateTypeID();
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_type`(`type_id`, `type_name`, `description`) VALUES (:type_id, :type_name, :description)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':type_id', $type_id);
            $stmt->bindParam(':type_name', $type_name);
            $stmt->bindParam(':description', $description);
            // Execute the query
            $stmt->execute();
    
            // Return success or other relevant response (e.g., the ID of the inserted row)
            return true; // Return the ID of the newly created record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }


    public function getTypeById($id) {
        try {
                $query = "SELECT `id`, `type_id`, `type_name`, `description` FROM `tbl_type` WHERE `id` = :id";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':id', $id); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
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
