<?php
require_once('../../../services/NurseryOwnerService.php');
include_once('../../components/header.php');
// Redirect to login if not logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../../../index.php");
    exit();
}

// Instantiate the class and get nursery owners
$user_id = $_GET['userID'];
$nurseryOwner = new NurseryOwner();
$getSpecificOwner = $nurseryOwner->getNurseryOwnerById($user_id);

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    // Clean input data
    $fullname = $nurseryOwner->clean('fullname', 'post');
    $contact_number = $nurseryOwner->clean('contact_number', 'post');
    $address = $nurseryOwner->clean('address', 'post');
    // Call create method to add the new owner
    $owners = $nurseryOwner->update($getSpecificOwner['id'], $fullname, $contact_number, $address);
    // Optionally, you can redirect or show a success message after creation
    if($owners == true){
        // Redirect to index.php
        header("Location: index.php"); 
        exit(); // Important to stop the script after the redirection
    }else{
        header("Location: create.php"); 
    }
}
?>
<div class="p-3 m-5">
<a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
    <h1>Update Nursery Owner</h1>
    <div class="card p-4">
        <form method="POST" action="">
            
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" value="<?php echo htmlspecialchars($getSpecificOwner['fullname']); ?>" class="form-control" name="fullname" id="fullname" placeholder="ex. Juan Dela Cruz" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="number" value="<?php echo htmlspecialchars($getSpecificOwner['contact_number']); ?>" class="form-control" name="contact_number" id="contact_number" placeholder="ex. 0912341232324" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" value="<?php echo htmlspecialchars($getSpecificOwner['address']); ?>" class="form-control" name="address" id="address" placeholder="ex. Brgy. Banquerohan" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <input type="hidden" name="action" value="update">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
