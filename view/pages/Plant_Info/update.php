<?php

$title = "PlantInfo";
require_once('../../../services/NurseryOwnerService.php');
require_once('../../../services/PlantInfoService.php');
// Instantiate the class to get nursery owners
$nurseryOwner = new NurseryOwner();
$owners = $nurseryOwner->getNurseryOwners();

$plantInfo = new PlantInfo();
$id = $_GET['userID'];

$plantSpecificInfo = $plantInfo->getPlantInfoId($id);

// Check if form is submitted
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    // Clean input data
    $nurser_owner_id_fk = $plantInfo->clean('nurser_owner_id_fk', 'post');
    $plant_type = $plantInfo->clean('plant_type', 'post');
    $plant_variety = $plantInfo->clean('plant_variety', 'post');
    $planted_date = $plantInfo->clean('planted_date', 'post');
    // Call create method to add the new owner
    $plantStatus = $plantInfo->update($id, $nurser_owner_id_fk, $plant_type, $plant_variety, $planted_date);
    // Optionally, you can redirect or show a success message after creation
    if($plantStatus == true){
         // Redirect to index.php
         header("Location: index.php"); 
         exit(); // Important to stop the script after the redirection
    }else if($plantStatus === false) {

        echo "<br> nursery ID is $nurser_owner_id_fk";
        echo "<br> nursery ID is $plant_type";
        echo "Update failed. Error: " . $plantInfo->getLastError(); // Implement getLastError() in PlantInfo class
        exit;
    }
}
include_once('../../components/header.php');
?>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content input {
            padding: 8px;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
        }
        .dropdown-content div {
            padding: 8px;
            cursor: pointer;
            background-color: white;
        }
        .dropdown-content div:hover {
            background-color: #ddd;
        }
        .dropdown-content.show {
            display: block;
        }

    </style>
<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>

    <div class="card p-4">
    <h1>Plant Update</h1>
        <form method="post" action="">
            <label for="fullname">Nursery Owner</label>
                <div class="col">
                    <div class="dropdown">
                        <input type="text" id="searchInput" value="<?php echo htmlspecialchars($plantSpecificInfo['nursery_owner_fullname']); ?>" class="form-control" name="data" placeholder="Choose" onkeyup="filterFunction()" onclick="toggleDropdown()" required>
                        <!-- Hidden input to store nursery_owner_id, pre-filled with existing value -->
                        <input type="hidden" id="nurser_owner_id_fk" name="nurser_owner_id_fk" value="<?php echo htmlspecialchars($plantSpecificInfo['nurser_owner_id']); ?>">
                        <div id="dropdownContent" class="dropdown-content">
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




<script>
            // Toggle dropdown visibility
        function toggleDropdown() {
            document.getElementById("dropdownContent").classList.toggle("show");
        }

        // Filter dropdown options
        function filterFunction() {
            var input, filter, div, i;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("dropdownContent").getElementsByTagName("div");

            for (i = 0; i < div.length; i++) {
                txtValue = div[i].textContent || div[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    div[i].style.display = "";
                } else {
                    div[i].style.display = "none";
                }
            }
        }

        // Select an item from the dropdown, update the search input and hidden input
        function selectItem(element) {
            var selectedValue = element.innerHTML.trim();  // Trim any extra spaces
            var selectedId = element.getAttribute('data-id'); // Get nursery_owner_id from data attribute

            // Set the selected value in the input
            document.getElementById("searchInput").value = selectedValue;
            
            // Set the selected nursery_owner_id in the hidden input
            document.getElementById("nurser_owner_id_fk").value = selectedId;
            
            // Close the dropdown
            document.getElementById("dropdownContent").classList.remove("show");
        }


        // Close the dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('#searchInput')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
        }

</script>
<?php include_once('../../components/footer.php'); ?>
