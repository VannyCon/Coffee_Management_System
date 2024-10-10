<?php
$title = "PlantInfo Update";
require_once('../../../controller/PlantNurseryController.php');
include_once('../../components/header.php');
?>
<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>

    <div class="card p-4">
    <h1>Plant Update</h1>
        <form method="post" action="">
     
            <!-- Source Dropdown -->
            <label for="fullname">Nursery Owner</label>
            <div class="col">
                <div class="dropdown w-100">
                    <input type="text" id="searchSourceInput" value="<?php echo htmlspecialchars($nurserySpecificInfo['source_fullname']); ?>" class="form-control"  name="source_id" placeholder="Choose" onkeyup="filterSourceOptions()" onclick="toggleSourceDropdown()" required>
                    <input type="hidden" id="source_id" name="source_id" value="<?php echo htmlspecialchars($nurserySpecificInfo['source_id']); ?>">
                    <div id="sourceDropdownContent" class="dropdown-content w-100">
                        <?php if (!empty($sources)): ?>
                            <?php foreach ($sources as $source): ?>
                                <div onclick="selectSource(this)" data-id="<?php echo $source['source_id']; ?>">
                                    <?php echo htmlspecialchars(trim($source['source_fullname'])); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>No records found</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Type Dropdown -->
            <div class="form-group my-1">
                <label for="plant_type">Type</label>
                <div class="dropdown w-100">
                    <input type="text" id="searchTypeInput" value="<?php echo htmlspecialchars($nurserySpecificInfo['type_name']); ?>" class="form-control" name="type_id" placeholder="Choose" onkeyup="filterTypeOptions()" onclick="toggleTypeDropdown()" required>
                    <input type="hidden" id="type_id" name="type_id" value="<?php echo htmlspecialchars($nurserySpecificInfo['type_id']); ?>">
                    <div id="typeDropdownContent" class="dropdown-content w-100">
                        <?php if (!empty($types)): ?>
                            <?php foreach ($types as $type): ?>
                                <div onclick="selectType(this)" data-id="<?php echo $type['type_id']; ?>">
                                    <?php echo htmlspecialchars(trim($type['type_name'])); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>No records found</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Variety Dropdown -->
            <div class="form-group my-1">
                <label for="plant_variety">Variety</label>
                <div class="dropdown w-100">
                    <input type="text" id="searchVarietyInput" value="<?php echo htmlspecialchars($nurserySpecificInfo['variety_name']); ?>" class="form-control" name="variety_id" placeholder="Choose" onkeyup="filterVarietyOptions()" onclick="toggleVarietyDropdown()" required>
                    <input type="hidden" id="variety_id" name="variety_id" value="<?php echo htmlspecialchars($nurserySpecificInfo['variety_id']); ?>">
                    <div id="varietyDropdownContent" class="dropdown-content w-100">
                        <?php if (!empty($varietys)): ?>
                            <?php foreach ($varietys as $variety): ?>
                                <div onclick="selectVariety(this)" data-id="<?php echo $variety['variety_id']; ?>">
                                    <?php echo htmlspecialchars(trim($variety['variety_name'])); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>No records found</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Quantity and Planted Date -->
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" value="<?php echo htmlspecialchars($nurserySpecificInfo['quantity']); ?>" name="quantity" id="quantity" placeholder="5" required>
            </div>

            <div class="form-group">
                <label for="planted_date">Planted Date</label>
                <input type="date" class="form-control"  value="<?php echo htmlspecialchars($nurserySpecificInfo['planted_date']); ?>"  name="planted_date" id="id_planted_date" placeholder="01/01/2024" required>
            </div>
            <input type="hidden" name="action" value="update">
            <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
        </form>
    </div>
</div>
<?php include_once('../../components/footer.php'); ?>