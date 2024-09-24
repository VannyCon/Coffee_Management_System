<?php
require_once('../../../services/NurseryOwnerService.php');
require_once('../../../services/PlantInfoService.php');
// Instantiate the class to get nursery owners
$nurseryOwner = new NurseryOwner();
$owners = $nurseryOwner->getNurseryOwners();


$plantInfo = new PlantInfo();

// Check if form is submitted
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    // Clean input data
    $nurser_owner_id_fk = $nurseryOwner->clean('nurser_owner_id_fk', 'post');
    $plant_type = $nurseryOwner->clean('plant_type', 'post');
    $plant_variety = $nurseryOwner->clean('plant_variety', 'post');
    $planted_date = $nurseryOwner->clean('planted_date', 'post');
    // Call create method to add the new owner
    $plantStatus = $plantInfo->create($nurser_owner_id_fk, $plant_type, $plant_variety, $planted_date);
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
<div class="p-3 m-5">
   <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
    <h1>Create Plant</h1>
    <div class="card p-4">
        <form method="POST" action="">
            <label for="fullname">Nursery Owner</label>
            <div class="col">
                <div class="dropdown">
                    <input type="text" id="searchInput" class="form-control" name="nurser_owner_id_fk" placeholder="Choose" onkeyup="filterFunction()" onclick="toggleDropdown()" required>
                    <!-- Hidden input to store nursery_owner_id -->
                    <input type="hidden" id="nurser_owner_id_fk" name="nurser_owner_id_fk">
                    <div id="dropdownContent" class="dropdown-content">
                        <?php if (!empty($owners)): ?>
                            <?php foreach ($owners as $owner): ?>
                                <!-- Pass nursery_owner_id as a data attribute -->
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
            <button type="submit" class="btn btn-primary">Submit</button>
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
