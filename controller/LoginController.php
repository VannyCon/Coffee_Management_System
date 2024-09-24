<?php 
    require('services/LoginAccessService.php');
    // Instantiate the class to get nursery owners
    $access = new LoginAccess();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'login') {
        // Retrieve form input
        $username = $access->clean('username', 'post');
        $password = $access->clean('password', 'post');

        if (!empty($username) && !empty($password)) { 
            $status = $access->login($username,$password);
            if($status == true){
                header("Location: view/pages/Nursery_Owner/index.php");
                exit();
            }else{
                header("Location: index.php?error=1");
            }
           
        } else {
            $error = "Please fill in both fields.";
        }
    }

?>