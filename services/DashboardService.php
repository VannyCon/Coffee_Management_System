<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class Dashboard extends config {

    public function getPlantInfoSummary() {
        try {
            $query = "SELECT `total_plants`, `total_types`, `total_varieties`, `total_source`, `total_centers`, `total_quantity_center`, `total_quantity_order`, `total_order_price` FROM `nursery_plant_summary` WHERE 1
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
    public function getSalesSummary() {
        try {
            $query = "SELECT `order_id`, `nursery_id`, `nursery_field`, `plant_bought_price`, `plant_selling_price`, `order_quantity`, `order_total`, `profit_per_unit`, `total_profit`, `total_cost`, `net_income_or_loss`, `status`, `order_datetime` FROM `view_sales_summary` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}




?>
