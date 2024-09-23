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
    }else if (isset($_POST['action']) && $_POST['action'] == 'editContent') {
        $id = $timeline->clean('contentID', 'post'); // Ensure this is retrieving contentID
        $content = $timeline->clean('content', 'post');
        $status = $timeline->clean('status', 'post');
        
        $result = $timeline->updateContent($id, $content, $status);
        if ($result) {
            header("Location: index.php?plantID=$plantID");
            exit();
        }
    }else if (isset($_POST['action']) && $_POST['action'] == 'deleteContent') {
        $contentID = $timeline->clean('contentID', 'post');
        
        $result = $timeline->deleteContent($contentID);
        if ($result) {
            header("Location: index.php?plantID=$plantID");
            exit();
        }
    }

?>