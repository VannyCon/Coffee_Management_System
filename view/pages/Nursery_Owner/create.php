<?php
require_once('../../../services/NurseryOwnerService.php');
// Instantiate the class to get nursery owners
$nurseryOwner = new NurseryOwner();

// Check if form is submitted
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    // Clean input data
    $fullname = $nurseryOwner->clean('fullname', 'post');
    $contact_number = $nurseryOwner->clean('contact_number', 'post');
    $address = $nurseryOwner->clean('address', 'post');
    // Call create method to add the new owner
    $owners = $nurseryOwner->create($fullname, $contact_number, $address);
    // Optionally, you can redirect or show a success message after creation
    if($owners == true){
         // Redirect to index.php
         header("Location: index.php"); 
         exit(); // Important to stop the script after the redirection
    }else{
        header("Location: create.php"); 
    }
}

include_once('../../components/header.php');
?>

<div class="p-3 m-5">
    <h1>Create Nursery Owner</h1>
    <div class="card p-4">
        <form method="POST" action="">
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="ex. Juan Dela Cruz" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="number" class="form-control" name="contact_number" id="contact_number" placeholder="ex. 0912341232324" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="ex. Brgy. Banquerohan" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <input type="hidden" name="action" value="create">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
