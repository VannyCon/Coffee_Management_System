<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class PlantInfo extends config {

    public function getPlantInfos() {
        try {
            $query = "SELECT 
                p.id,
                p.plant_id,
                p.plant_type,
                p.plant_variety,
                p.planted_date,
                n.fullname,
                n.created_date
            FROM plant_info_tbl p
            JOIN nursery_owner_tbl n
            ON p.nurser_owner_id_fk = n.nurser_owner_id
            ORDER BY p.planted_date DESC;
            ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function create($nurser_owner_id_fk, $plant_type, $plant_variety, $planted_date) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `plant_info_tbl`(`plant_id`, `nurser_owner_id_fk`, `plant_type`, `plant_variety`, `planted_date`) 
                      VALUES (UUID(), :nurser_owner_id_fk, :plant_type, :plant_variety, :planted_date)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':nurser_owner_id_fk', $nurser_owner_id_fk);
            $stmt->bindParam(':plant_type', $plant_type);
            $stmt->bindParam(':plant_variety', $plant_variety);
            $stmt->bindParam(':planted_date', $planted_date);
            // Execute the query
            $stmt->execute();
            // Return success or other relevant response (e.g., the ID of the inserted row)
            return true; // Return the ID of the newly created record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }


    public function getPlantInfoId($id) {
        try {


                $query = "SELECT 
                                p.id,
                                p.plant_id,
                                n.fullname AS nursery_owner_fullname,
                                n.nurser_owner_id,
                                p.plant_type,
                                p.plant_variety,
                                p.planted_date
                            FROM 
                                plant_info_tbl p
                            JOIN 
                                nursery_owner_tbl n
                            ON 
                                p.nurser_owner_id_fk = n.nurser_owner_id
                            WHERE 
                                p.id = :id;
                            ";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':id', $id); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getPlantDataByID($plant_id) {
        try {
                $query = "SELECT 
                                p.id,
                                p.plant_id,
                                n.fullname AS nursery_owner_fullname,
                                p.plant_type,
                                p.plant_variety,
                                p.planted_date
                            FROM 
                                plant_info_tbl p
                            JOIN 
                                nursery_owner_tbl n
                            ON 
                                p.nurser_owner_id_fk = n.nurser_owner_id
                            WHERE 
                                p.plant_id = :plant_id;
                            ";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':plant_id', $plant_id); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update($id, $nurser_owner_id_fk, $plant_type, $plant_variety, $planted_date) {
        try {
            // Fetch current values from the database
            $currentQuery = "SELECT `nurser_owner_id_fk`, `plant_type`, `plant_variety`, `planted_date` 
                             FROM `plant_info_tbl` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($currentQuery);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $currentValues = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if the values are different
            if ($currentValues['nurser_owner_id_fk'] == $nurser_owner_id_fk && 
                $currentValues['plant_type'] == $plant_type && 
                $currentValues['plant_variety'] == $plant_variety && 
                $currentValues['planted_date'] == $planted_date) {
                // No changes detected, return early
                return true; // Or some indication that no changes were made
            }
    
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `plant_info_tbl` 
                      SET `nurser_owner_id_fk` = :nurser_owner_id_fk,
                          `plant_type` = :plant_type,
                          `plant_variety` = :plant_variety,
                          `planted_date` = :planted_date
                      WHERE `id` = :id";
     
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':nurser_owner_id_fk', $nurser_owner_id_fk);
            $stmt->bindParam(':plant_type', $plant_type);
            $stmt->bindParam(':plant_variety', $plant_variety);
            $stmt->bindParam(':planted_date', $planted_date);
            $stmt->bindParam(':id', $id);
     
            // Execute the query
            $stmt->execute();
            return $stmt->rowCount() > 0; // Returns true if at least one row was affected
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }
    

    public function delete($id) {
        try {
            $query = "DELETE FROM `plant_info_tbl` WHERE `id` = :id";
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
