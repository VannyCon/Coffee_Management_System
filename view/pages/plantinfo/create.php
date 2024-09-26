<?php
    $title = "PlantInfo Create";
    include_once('../../components/header.php');
    include_once('../../../controller/PlantInfoController.php');
?>

<div>
   <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>

    <div class="card p-4">
    <h1>Create Plant</h1>
        <form method="POST" action="">
            <label for="fullname">Nursery Owner</label>
            <div class="col">
                <div class="dropdown w-100">
                    <input type="text" id="searchInput" class="form-control" name="nurser_owner_id_fk" placeholder="Choose" onkeyup="filterFunction()" onclick="toggleDropdown()" required>
                    <!-- Hidden input to store nurserowner_id -->
                    <input type="hidden" id="nurser_owner_id_fk" name="nurser_owner_id_fk">
                    <div id="dropdownContent" class="dropdown-content w-100">
                        <?php if (!empty($owners)): ?>
                            <?php foreach ($owners as $owner): ?>
                                <!-- Pass nurserowner_id as a data attribute -->
                                <div onclick="selectItem(this)" data-id="<?php echo $owner['nurser_owner_id']; ?>">
                                    <?php echo htmlspecialchars(trim($owner['fullname'])); ?>

                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div onclick="selectItem(this)">No Found</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="plant_type">Type</label>
                <input type="text" class="form-control" name="plant_type" id="plant_type" placeholder="ex. Type A" required>
            </div>
            <div class="form-group">
                <label for="plant_variety">Variety</label>
                <input type="text" class="form-control" name="plant_variety" id="plant_variety" placeholder="ex. Class B" required>
            </div>
            <div class="form-group">
                <label for="planted_date">Planted Date</label>
                <input type="date" class="form-control" name="planted_date" id="planted_date" placeholder="01/01/2024" required>
            </div>
            <input type="hidden" name="action" value="create">
            <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
        </form>
    </div>
</div>
<?php include_once('../../components/footer.php'); ?>
