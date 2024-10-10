<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class PlantInfo extends config {

    public function getPlantInfos() {
        try {
            $query = "SELECT 
                            n.id,
                            n.nursery_id,
                            s.source_fullname,
                            s.source_contact_number,
                            s.source_address,
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
                            tbl_source s ON n.source_id = s.source_id
                        JOIN 
                            tbl_type t ON n.type_id = t.type_id
                        JOIN 
                            tbl_variety v ON n.variety_id = v.variety_id
                        WHERE 
                            1
                        ORDER BY n.planted_date DESC;
                        ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function create($source_id, $type_id, $variety_id, $quantity, $planted_date) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_nursery`(`nursery_id`, `source_id`, `type_id`, `variety_id`,`quantity`, `planted_date`) 
                      VALUES (UUID(), :source_id, :type_id, :variety_id, :quantity, :planted_date)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':source_id', $source_id);
            $stmt->bindParam(':type_id', $type_id);
            $stmt->bindParam(':variety_id', $variety_id);
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
                                s.source_id,
                                s.source_fullname,
                                n.type_id,
                                t.type_name,
                                n.variety_id,
                                v.variety_name,
                                n.quantity,
                                n.planted_date
                            FROM 
                                tbl_nursery n
                            JOIN 
                                tbl_source s ON n.source_id = s.source_id
                            JOIN 
                                tbl_type t ON n.type_id = t.type_id
                            JOIN 
                                tbl_variety v ON n.variety_id = v.variety_id
                            WHERE
                                n.id = :id
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
                                s.source_fullname,
                                s.source_contact_number,
                                s.source_address,
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
                                tbl_source s ON n.source_id = s.source_id
                            JOIN 
                                tbl_type t ON n.type_id = t.type_id
                            JOIN 
                                tbl_variety v ON n.variety_id = v.variety_id
                            WHERE
                                n.nursery_id = :nurseryID";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':nurseryID', $nurseryID); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update($id, $source_id, $type_id, $variety_id, $quantity, $planted_date) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_nursery` 
                      SET `source_id` = :source_id,
                          `type_id` = :type_id,
                          `variety_id` = :variety_id,
                          `quantity` = :quantity,
                          `planted_date` = :planted_date
                      WHERE `id` = :id";
     
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':source_id', $source_id);
            $stmt->bindParam(':type_id', $type_id);
            $stmt->bindParam(':variety_id', $variety_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':planted_date', $planted_date);
            $stmt->bindParam(':id', $id);
     
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
    
    

}




?>
