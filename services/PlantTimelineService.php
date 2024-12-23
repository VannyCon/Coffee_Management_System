<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class Timeline extends config {

    public function create($nurseryID, $timeline_title, $history_date, $quantity) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_timeline`(`nursery_id_fk`, `content_id`, `quantity`, `timeline_title`, `history_date`) 
                      VALUES (:nursery_id_fk, UUID(), :quantity, :timeline_title, :history_date)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':nursery_id_fk', $nurseryID);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':timeline_title', $timeline_title);
            $stmt->bindParam(':history_date', $history_date);
            // Execute the query
            $stmt->execute();
            // Return success or other relevant response (e.g., the ID of the inserted row)
            return true; // Return the ID of the newly created record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }
    
    public function getTimelineById($nursery_id_fk) {
        try {
                $query = "SELECT `id`, `nursery_id_fk`, `content_id`, `quantity`, `timeline_title`, `history_date`
                          FROM `tbl_timeline` 
                          WHERE `nursery_id_fk` = :nursery_id_fk 
                          ORDER BY `history_date` DESC, `created_time` DESC;";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->bindParam(':nursery_id_fk', $nursery_id_fk); // Bind the value
                $stmt->execute(); // Execute the query
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    


    public function updateTimeline($id, $timeline_title, $history_date) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_timeline` 
                      SET `timeline_title` = :timeline_title, `history_date` = :history_date
                      WHERE `id` = :id";
    
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':timeline_title', $timeline_title);
            $stmt->bindParam(':history_date', $history_date);
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
    

    public function deleteTimeline($id) {
        try {
            $query = "DELETE FROM `tbl_timeline` WHERE `id` = :id";
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
    
    
    // CONTENT //
    public function getContentByTimelineId($content_id_fk) {
        try {
            $query = "SELECT `id`, `content_id_fk`, `content`, `status`, `history_time`
                      FROM `tbl_content` 
                      WHERE `content_id_fk` = :content_id_fk 
                      ORDER BY `history_time`";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':content_id_fk', $content_id_fk);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ensure this line returns the content
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createContent($contentID, $content, $status, $history_timeline) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `tbl_content`(`content_id_fk`, `content`, `status`, `history_time`) 
                      VALUES (:content_id_fk, :content, :status, :history_timeline)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':content_id_fk', $contentID);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':history_timeline', $history_timeline);
            // Execute the query
            $stmt->execute();
            // Return success or other relevant response (e.g., the ID of the inserted row)
            return true; // Return the ID of the newly created record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }
    
    public function updateContent($id, $content, $status) {
        try {
            // Define the query with placeholders for updating an existing record
            $query = "UPDATE `tbl_content` 
                      SET `content` = :content, `status` = :status
                      WHERE `id` = :id";
    
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':status', $status);
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
    

    public function deleteContent($id) {
        try {
            $query = "DELETE FROM `tbl_content` WHERE `id` = :id";
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

    public function getHarvestStatus() {
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
    
    
}




?>
