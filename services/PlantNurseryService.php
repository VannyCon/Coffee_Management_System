<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class PlantInfo extends config {

    public function getPlantInfos() {
        try {
            $query = "SELECT 
                            n.id,
                            n.nursery_id,
                            n.nursery_field,
                            n.bought_price,
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

    public function create($nursery_field, $source_id, $type_id, $variety_id, $bought_price, $quantity, $planted_date) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_nursery`(`nursery_id`, `nursery_field`, `source_id`, `type_id`, `variety_id`,`bought_price`,`quantity`, `planted_date`) 
                      VALUES (UUID(), :nursery_field, :source_id, :type_id, :variety_id, :bought_price, :quantity, :planted_date)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':nursery_field', $nursery_field);
            $stmt->bindParam(':source_id', $source_id);
            $stmt->bindParam(':type_id', $type_id);
            $stmt->bindParam(':variety_id', $variety_id);
            $stmt->bindParam(':bought_price', $bought_price);
            $stmt->bindParam(':quantity', $quantity);
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
                                n.id,
                                n.nursery_id,
                                n.nursery_field,
                                n.bought_price,
                                n.source_id,
                                n.type_id,
                                t.type_name,
                                n.variety_id,
                                v.variety_name,
                                n.quantity,
                                n.planted_date,
                                s.source_fullname,
                                s.source_id
                            FROM 
                                tbl_nursery n
                            JOIN 
                                tbl_type t ON n.type_id = t.type_id
                            JOIN 
                                tbl_variety v ON n.variety_id = v.variety_id
                            JOIN 
                                tbl_source s ON n.source_id = s.source_id
                            WHERE
                                n.id =  :id
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

    public function getPlantDataByID($nurseryID) {
        try {
            $query = "SELECT 
                            n.id,
                            n.nursery_id,
                            n.nursery_field,
                            n.bought_price,
                            n.type_id,
                            t.type_name,
                            t.description AS type_description,
                            n.variety_id,
                            v.variety_name,
                            v.description AS variety_description,
                            n.quantity,
                            n.planted_date,
                            n.created_date,
                            s.source_fullname,
                            s.source_id,
                            -- This will count the number of harvested plants for the specific nursery ID
                            (SELECT COUNT(*) 
                             FROM tbl_timeline 
                             WHERE timeline_title = 'Harvested' AND nursery_id_fk = n.nursery_id) AS harvest_count
                        FROM 
                            tbl_nursery n
                        JOIN 
                            tbl_type t ON n.type_id = t.type_id
                        JOIN 
                            tbl_variety v ON n.variety_id = v.variety_id
                        JOIN 
                            tbl_source s ON n.source_id = s.source_id
                        WHERE
                            n.nursery_id = :nurseryID";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':nurseryID', $nurseryID, PDO::PARAM_INT); // Bind the value
            $stmt->execute(); // Execute the query
            return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function update($id, $nursery_field, $source_id, $type_id, $variety_id, $bought_price, $quantity, $planted_date) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_nursery` 
                      SET `nursery_field` = :nursery_field,
                          `source_id` = :source_id,
                          `type_id` = :type_id,
                          `variety_id` = :variety_id,
                          `quantity` = :quantity,
                          `bought_price` = :bought_price,
                          `planted_date` = :planted_date
                      WHERE `id` = :id";
     
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':nursery_field', $nursery_field);
            $stmt->bindParam(':source_id', $source_id);
            $stmt->bindParam(':type_id', $type_id);
            $stmt->bindParam(':variety_id', $variety_id);
            $stmt->bindParam(':bought_price', $bought_price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':planted_date', $planted_date);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Explicitly specify type for $id
     
            // Execute the query
            $stmt->execute();
            return true; // Returns true if at least one row was affected
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }
    
    public function delete($id) {
        try {
            $query = "DELETE FROM `tbl_nursery` WHERE `id` = :id";
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
    

    ///THIS PART RETURN THE HARVEST STATUS OF A SPECIFIED NURSEY ID
    /// The query checks if there is a 'Harvested' timeline entry for the given nursery ID.
    /// If the timeline entry exists, it returns the most recent harvest date.
    /// If the timeline entry does not exist, it returns the planted date of the nursery.
    /// The 'Harvested' timeline entry is assumed to be the last entry for the given nursery ID.
    /// The status is also returned as 'True' if a harvest entry exists, or 'False' otherwise. 
    // The function to retrieve harvest status for a specific nursery ID. 
    // Note: This function assumes that there is a 'Harvested' timeline entry for each nursery.
    // If the timeline entry does not exist for a particular nursery, it will return the planted date. 
    public function getHarvestStatus($nurseryID) {
        try {
            $query = "
                SELECT 
                    CASE
                        WHEN EXISTS (
                            SELECT 1 FROM tbl_timeline WHERE nursery_id_fk = :nurseryID AND timeline_title = 'Harvested'
                        ) 
                        THEN (
                            SELECT MAX(history_date) FROM tbl_timeline WHERE nursery_id_fk = :nurseryID AND timeline_title = 'Harvested'
                        )
                        ELSE (
                            SELECT planted_date FROM tbl_nursery WHERE nursery_id = :nurseryID
                        )
                    END AS relevant_date, 					
                    CASE
                        WHEN EXISTS (
                            SELECT 1 
                            FROM tbl_timeline 
                            WHERE nursery_id_fk = :nurseryID 
                            AND timeline_title = 'Harvested'
                        ) 
                        THEN 'True'
                        ELSE 'False'
                    END AS status
            ";
    
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':nurseryID', $nurseryID); // Bind the value
            $stmt->execute(); // Execute the query
            return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getFertilizationStatus() {
        try {
            $query = "
                SELECT 
                    n.id,
                    n.nursery_id,
                    n.nursery_field,
                    n.source_id,
                    n.type_id,
                    n.variety_id,
                    n.bought_price,
                    n.quantity,
                    n.planted_date,
                    n.created_date,
                    CASE 
                        WHEN EXISTS (
                            SELECT 1 
                            FROM tbl_timeline t
                            WHERE t.timeline_title = 'Fertilized' AND t.nursery_id_fk = n.nursery_id
                        ) THEN (
                            SELECT MAX(t.history_date) 
                            FROM tbl_timeline t
                            WHERE t.timeline_title = 'Fertilized' AND t.nursery_id_fk = n.nursery_id
                        )
                        ELSE n.planted_date
                    END AS relevant_date,
                    DATE_ADD(
                        CASE 
                            WHEN EXISTS (
                                SELECT 1 
                                FROM tbl_timeline t
                                WHERE t.timeline_title = 'Fertilized' AND t.nursery_id_fk = n.nursery_id
                            ) THEN (
                                SELECT MAX(t.history_date) 
                                FROM tbl_timeline t
                                WHERE t.timeline_title = 'Fertilized' AND t.nursery_id_fk = n.nursery_id
                            )
                            ELSE n.planted_date
                        END,
                        INTERVAL 6 MONTH
                    ) AS next_fertilization_date
                FROM tbl_nursery n
                HAVING next_fertilization_date = CURDATE()
            ";
    
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all matching results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function getAllHarvestStatus() {
        try {
            $query = "
                SELECT 
                    n.id,
                    n.nursery_id,
                    n.nursery_field,
                    n.source_id,
                    n.type_id,
                    n.variety_id,
                    n.bought_price,
                    n.quantity,
                    n.planted_date,
                    n.created_date,
                    CASE 
                        WHEN EXISTS (
                            SELECT 1 
                            FROM tbl_timeline t
                            WHERE t.timeline_title = 'Harvested' AND t.nursery_id_fk = n.nursery_id
                        ) THEN (
                            SELECT MAX(t.history_date) 
                            FROM tbl_timeline t
                            WHERE t.timeline_title = 'Harvested' AND t.nursery_id_fk = n.nursery_id
                        )
                        ELSE n.planted_date
                    END AS relevant_date,
                    DATE_ADD(
                        CASE 
                            WHEN EXISTS (
                                SELECT 1 
                                FROM tbl_timeline t
                                WHERE t.timeline_title = 'Harvested' AND t.nursery_id_fk = n.nursery_id
                            ) THEN (
                                SELECT MAX(t.history_date) 
                                FROM tbl_timeline t
                                WHERE t.timeline_title = 'Harvested' AND t.nursery_id_fk = n.nursery_id
                            )
                            ELSE n.planted_date
                        END,
                        INTERVAL 2 YEAR
                    ) AS harvestable_date
                FROM tbl_nursery n
                HAVING harvestable_date = CURDATE()
            ";
    
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all matching results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

}




?>
