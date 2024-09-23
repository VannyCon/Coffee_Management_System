<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class Content extends config {

    public function createContent($contentID, $content, $status) {
        try {
            // Define the query with placeholders
            $query = "INSERT INTO `content_tbl`(`content_id_fk`, `content`, `status`) 
                      VALUES (:content_id_fk, :content, :status)";
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the values to the placeholders
            $stmt->bindParam(':content_id_fk', $contentID);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':status', $status);
            // Execute the query
            $stmt->execute();
            // Return success or other relevant response (e.g., the ID of the inserted row)
            return true; // Return the ID of the newly created record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Return false if the operation fails
        }
    }
    public function getContentByTimelineId($content_id_fk) {
        try {
            $query = "SELECT `id`, `content_id_fk`, `content`, `status`, `history_time`
                      FROM `content_tbl` 
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
}

?>
