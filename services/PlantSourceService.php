<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class NurseryOwner extends config {

    public function getNurseryOwners() {
        try {
            $query = "SELECT `id`, `source_id`, `source_fullname`, `source_contact_number`, `source_address`, `created_date` FROM `tbl_source` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function create($fullname, $contact_number, $address) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_source` (`source_id`, `source_fullname`, `source_contact_number`, `source_address`, `created_date`) 
                      VALUES (UUID(), :fullname, :contact_number, :address, NOW())";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->bindParam(':address', $address);
            // Execute the query
            $stmt->execute();
    
            // Return success or other relevant response (e.g., the ID of the inserted row)
            return true; // Return the ID of the newly created record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }


    public function getNurseryOwnerById($id) {
        try {
                $query = "SELECT `id`, `source_id`, `source_fullname`, `source_contact_number`, `source_address`, `created_date` FROM `tbl_source` WHERE `id` = :id";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':id', $id); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function update($id, $fullname, $contact_number, $address) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_source` 
                      SET `source_fullname` = :fullname, `source_contact_number` = :contact_number, `source_address` = :address
                      WHERE `id` = :id";
    
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->bindParam(':address', $address);
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
            $query = "DELETE FROM `tbl_source` WHERE `id` = :id";
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
