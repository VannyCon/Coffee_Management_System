<?php 
    if(isset($_POST['action']) && $_POST['action'] == 'createContent'){
        // Clean input data
        $contentID = $timeline->clean('contentID', 'post');
        $content = $timeline->clean('content', 'post');
        $status = $timeline->clean('status', 'post');
        // Call create method to add the new owner
        $timelineCreate = $timeline->createContent($contentID,$content, $status);
        // Optionally, you can redirect or show a success message after creation
        if($timelineCreate == true){
            // Redirect to index.php
            header("Location: index.php?plantID=$plantID"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: create.php"); 
        }
    }

?>