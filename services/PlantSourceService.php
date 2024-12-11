<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class SourceService extends config {

    function generateSourceID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "SRC-";
        
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

    function generateOrderID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "SRCORDER-";
        
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

    public function getNurseryOwners() {
        try {
            $query = "SELECT `id`, `source_id`, `source_fullname`, `source_variety`, `source_quantity`, `source_contact_number`, `source_email`, `source_address`, `created_date` FROM `tbl_source` WHERE `id` != 26";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllNurseryOwners() {
        try {
            $query = "SELECT `id`, `source_id`, `source_fullname`, `source_variety`, `source_quantity`, `source_contact_number`, `source_email`, `source_address`, `created_date` FROM `tbl_source` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    
    public function create($fullname,  $source_variety, $source_quantity, $contact_number, $source_email,  $address) {
        try {

            $sourceID = $this->generateSourceID(); // Generate a unique source ID
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_source` (`source_id`, `source_fullname`, `source_variety`, `source_quantity`, `source_contact_number`, `source_email`,  `source_address`, `created_date`) 
                      VALUES (:sourceID, :fullname, :source_variety, :source_quantity, :contact_number, :source_email,  :address, NOW())";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':sourceID',  $sourceID);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':source_variety', $source_variety);
            $stmt->bindParam(':source_quantity', $source_quantity);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->bindParam(':source_email', $source_email);
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

    public function createSourceOrder($source_id,  $order_quantity, $order_price, $order_total) {
        try {

            $account_id = $this->generateOrderID(); // Generate a unique source ID
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_source_account`(`account_id`, `source_id`, `order_quantity`, `order_price`, `order_total`, `order_datetime`) VALUES (:account_id, :source_id, :order_quantity, :order_price, :order_total, NOW())";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':account_id',  $account_id);
            $stmt->bindParam(':source_id', $source_id);
            $stmt->bindParam(':order_quantity', $order_quantity);
            $stmt->bindParam(':order_price', $order_price);
            $stmt->bindParam(':order_total', $order_total);
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
                $query = "SELECT `id`, `source_id`, `source_fullname`, `source_variety`, `source_quantity`, `source_contact_number`, `source_email`, `source_address`, `created_date` FROM `tbl_source` WHERE `id` = :id";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':id', $id); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function getSourceHistory($source_id) {
        try {
            $query = "SELECT 
                            sa.source_id,
                            sa.order_quantity,
                            sa.order_price,
                            sa.order_total,
                            sa.order_datetime,
                            s.id,
                            s.source_fullname,
                            s.source_variety,
                            s.source_quantity,
                            s.source_contact_number,
                            s.source_email,
                            s.source_address,
                            s.created_date
                        FROM 
                            tbl_source_account sa
                        INNER JOIN 
                            tbl_source s
                        ON 
                            sa.source_id = s.source_id
                        WHERE 
                            sa.source_id = :source_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':source_id', $source_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result ? $result : [];
        } catch (PDOException $e) {
            error_log("Error fetching source history: " . $e->getMessage());
            return false;
        }
    }
    

    public function update($id, $source_variety, $source_quantity, $fullname, $contact_number,$source_email, $address) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_source` 
                      SET `source_fullname` = :fullname, `source_variety` = :source_variety, `source_quantity` = :source_quantity, `source_contact_number` = :contact_number, `source_email` = :source_email, `source_address` = :address
                      WHERE `id` = :id";
    
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':source_variety', $source_variety);
            $stmt->bindParam(':source_quantity', $source_quantity);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->bindParam(':source_email', $source_email);
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
