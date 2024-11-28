    <?php 
    $title = "Reminder";
    include_once('../../components/header.php'); 
    ?>
    <div class="container d-flex justify-content-center align-items-center h-100">
                <!-- Centered Card -->
    <div class="card shadow-lg  justify-content-center align-items-center pt-3 px-5" style="width: 20rem;">
        <img src="../../../assets/images/note.png" class="card-img-top" alt="Report Image" style="height: 50px; width: 50px;">
        <div class="card-body text-center">
            <h5 class="card-title">Reminder</h5>
            <p class="card-text">This Reminder will send sms if there is available to harvest,fertilize and watering.</p>
            <a href="remind.php" class="btn btn-info w-100" >
                <i class="bi bi-download"></i>One Click
            </a>
        </div>
    </div>
    </div>

    <?php include_once('../../components/footer.php'); ?>