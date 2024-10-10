<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class Dashboard extends config {

    public function getPlantInfoSummary() {
        try {
            $query = "SELECT `total_plants`, `total_types`, `total_varieties`, `total_source` FROM `nursery_plant_summary` WHERE 1;
            ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getThisYearSummary() {
        try {
            $query = "SELECT `year`, `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Decs` FROM `yearly_planting_summary` WHERE 1;
            ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}




?>
