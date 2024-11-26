<?php 
require_once("connection/config.php");
require_once("connection/connection.php");


class LoginAccess extends config {
    public function login($username, $password){
        try {
            // Prepare and execute query to get user by username
            $query = "SELECT * FROM tbl_admin_access WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && $password === $user['password']) {
                // Password is correct, start a session
                $_SESSION['user_id'] =  $user['id'];
                $_SESSION['username'] = $user['username'];
                // Redirect to a protected page
                return true;
                exit();
            } else {
                $error = "Invalid username or password.";
                return false;
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
            return false;
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
    
}
?>