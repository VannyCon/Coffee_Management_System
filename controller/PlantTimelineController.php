<?php 
    // Redirect to login if not logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../../../index.php");
        exit();
    }
    // Check if form is submitted
    if (isset($_POST['action']) && $_POST['action'] == 'createTimeline') {
        // Clean input data
        $timeline_title = $timeline->clean('timeline_title', 'post');
        $history_date = $timeline->clean('history_date', 'post');
        // Call create method to add the new owner
        $timelineCreate = $timeline->create($nurseryID,$timeline_title, $history_date);
        // Optionally, you can redirect or show a success message after creation
        if($timelineCreate == true){
            // Redirect to index.php
            header("Location: index.php?nurseryID=$nurseryID"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: create.php"); 
        }
    }else if (isset($_POST['action']) && $_POST['action'] == 'editTimeline') {
        $timelineID = $timeline->clean('timelineID', 'post');
        $timeline_title = $timeline->clean('timeline_title', 'post');
        $history_date = $timeline->clean('history_date', 'post');
        
        $result = $timeline->updateTimeline($timelineID, $timeline_title, $history_date);
        if ($result) {
            header("Location: index.php?nurseryID=$nurseryID");
            exit();
        }
    } else if (isset($_POST['action']) && $_POST['action'] == 'deleteTimeline') {
        $timelineID = $timeline->clean('timelineID', 'post');
        
        $result = $timeline->deleteTimeline($timelineID);
        if ($result) {
            header("Location: index.php?nurseryID=$nurseryID");
            exit();
        }
    }
?>