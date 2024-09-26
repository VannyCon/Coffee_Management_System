<?php
$title = "PlantInfo Update";
require_once('../../../controller/PlantInfoController.php');
include_once('../../components/header.php');
?>
<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>

    <div class="card p-4">
    <h1>Plant Update</h1>
        <form method="post" action="">
            <label for="fullname">Nursery Owner</label>
                <div class="col">
                    <div class="dropdown w-100">
                        <input type="text" id="searchInput" value="<?php echo htmlspecialchars($plantSpecificInfo['nursery_owner_fullname']); ?>" class="form-control" name="data" placeholder="Choose" onkeyup="filterFunction()" onclick="toggleDropdown()" required>
                        <!-- Hidden input to store nursery_owner_id, pre-filled with existing value -->
                        <input type="hidden" id="nurser_owner_id_fk" name="nurser_owner_id_fk" value="<?php echo htmlspecialchars($plantSpecificInfo['nurser_owner_id']); ?>">
                        <div id="dropdownContent" class="dropdown-content w-100">
                            <?php if (!empty($owners)): ?>
                                <?php foreach ($owners as $owner): ?>
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
                <input type="text" class="form-control"  value="<?php echo htmlspecialchars($plantSpecificInfo['plant_type']); ?>"  name="plant_type" id="id_plant_type" placeholder="ex. Type A" required>
            </div>
            <div class="form-group">
                <label for="plant_variety">Variety</label>
                <input type="text" class="form-control"  value="<?php echo htmlspecialchars($plantSpecificInfo['plant_variety']); ?>"  name="plant_variety" id="id_plant_variety" placeholder="ex. Class B" required>
            </div>
            <div class="form-group">
                <label for="planted_date">Planted Date</label>
                <input type="date" class="form-control"  value="<?php echo htmlspecialchars($plantSpecificInfo['planted_date']); ?>"  name="planted_date" id="id_planted_date" placeholder="01/01/2024" required>
            </div>
            <input type="hidden" name="action" value="update">
            <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
        </form>
    </div>
</div>
<?php include_once('../../components/footer.php'); ?>
