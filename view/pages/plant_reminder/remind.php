<?php 
    include('sms_fertilized_reminder.php');
    sleep(3); // Delay of 5 seconds

    include('sms_harvest_reminder.php');
    sleep(3); // Delay of 5 seconds

    include('sms_watering_reminder.php');
    sleep(3); // Delay of 5 seconds

    header("Location: index.php");
    exit();
?>
