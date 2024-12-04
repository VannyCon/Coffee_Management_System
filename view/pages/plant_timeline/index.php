<?php 
  $title = "Timeline";
  require_once('../../../services/PlantTimelineService.php');
  require_once('../../../services/PlantNurseryService.php');
  // Instantiate the class and get nursery owners
  $timeline = new Timeline();
  $plant = new PlantInfo();
  
  ///make a logic here where return to plantINfo if plandID not found
  $nurseryID = $_GET['nurseryID'];
  $timelines = $timeline->getTimelineById($nurseryID);
  $plantData = $plant->getPlantDataByID($nurseryID);
  require_once('../../../controller/PlantContentController.php');
  require_once('../../../controller/PlantTimelineController.php');  
  include_once('../../components/header.php');


?>
<?php include_once('../../components/timelineModals.php'); ?>



    <div class="m-1 p-1 p-lg-5">
        <div class="timeline-container">
        <a class="btn btn-outline-danger m-2" href="../plant_nursery/index.php" width="200"> Back </a>
        <div class="p-3">
            <div class="row">
                <div class="col-md-12 text-left">
                    <p><strong>Nursery Owner:</strong> Doc. Patrick Escalante</p>
                    <p><strong>Address:</strong> Brgy. Daga, Cadiz City, Negros Occidental,6121</p>
                    <p><strong>Field:</strong> <?php echo $plantData['nursery_field']; ?></p>
                    <p><strong>Type:</strong> <?php echo $plantData['type_name']; ?></p>
                    <p><strong>Type Description:</strong> <?php echo $plantData['type_description']; ?></p>
                    <p><strong>Variety:</strong> <?php echo $plantData['variety_name']; ?></p>
                    <p><strong>Variety Description:</strong> <?php echo $plantData['variety_description']; ?></p>
                    <p><strong>Quantity:</strong> <?php echo $plantData['quantity']; ?></p>
                    <p><strong>Seedling Source:</strong> <?php echo $plantData['source_fullname']; ?></p>
                    <p><strong>Age: </strong> <?php
                                                    // Sample planted_date from $plantData
                                                    $plantedDate = $plantData['planted_date']; // Format: YYYY-MM-DD

                                                    // Convert the planted date to a DateTime object
                                                    $plantedDateObj = new DateTime($plantedDate);

                                                    // Get the current date
                                                    $currentDate = new DateTime();

                                                    // Calculate the difference between the current date and the planted date
                                                    $interval = $plantedDateObj->diff($currentDate);

                                                    // Display age based on the difference
                                                    if ($interval->y > 0) {
                                                        // If the difference is in years
                                                        echo $interval->y . ' years old';
                                                    } elseif ($interval->m > 0) {
                                                        // If the difference is in months
                                                        echo $interval->m . ' months old';
                                                    } else {
                                                        // If the difference is in days
                                                        echo $interval->d . ' days old';
                                                    }
                                                    ?>
                                                    </p>
                    <p><strong>Planted Date:</strong> 
                    <?php
                        $plantedDate = new DateTime($plantData['planted_date']);
                        echo $plantedDate->format('F j, Y');
                    ?></p>

                    
                    <p>
                    <strong>Estimated Harvest Date:</strong>
                        <?php 
                            // Example $history_date array with 'relevant_date'
                            $history_date = $plant->getHarvestStatus($plantData['nursery_id']);
                            $relevant_date = $history_date['relevant_date']; // '2024-11-01' (example)

                            // Create a DateTime object from the relevant date (planted date)
                            $start_date = new DateTime($relevant_date);

                            // Clone the date to create the end date range
                            $end_date = clone $start_date;

                            // Add 24 months to get 2 years later
                            $start_date->modify('+24 months');

                            // Add 30 months to get 2 years and 6 months later
                            $end_date->modify('+30 months');

                            // Format and output the date range
                            echo $start_date->format('F j, Y') . ' - ' . $end_date->format('F j, Y');
                        ?>

                    </p>
                    <p><strong>Harvest Count:</strong> <?php echo $plantData['harvest_count']; ?></p>
                    
                    <a class="btn btn-primary px-5" href="download_pdf.php?nurseryID=<?php echo htmlspecialchars($nurseryID); ?>"> 
                        Print 
                    </a>
                </div>
            </div>
        </div>
            <h2>Timeline</h2>
            <div class="timeline">
            <?php if (!empty($timelines)): ?>
                <?php foreach ($timelines as $timelineItem): ?>
                    <!-- START TIMELINE CONTENT -->
                    <div class="timeline-item">
                        <div class="card p-2 timeline-content ml-2 p-1">
                            <div class="row g-0 p-2">
                                <div class="col-6 col-md-9 ml-md-2">
                                    <a class="w-100 text-left text-decoration-none" data-bs-toggle="collapse" href="#collapse<?php echo htmlspecialchars($timelineItem['id']); ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <p class="m-0">
                                            <strong>
                                                <?php echo htmlspecialchars($timelineItem['timeline_title']); ?>
                                            </strong> 
                                        </p>
                                        <p class="m-0">
                                            <small>
                                                <?php 
                                                $historyDate = htmlspecialchars($timelineItem['history_date']);
                                                $dateObject = DateTime::createFromFormat('Y-m-d', $historyDate);
                                                $formattedDate = $dateObject->format('F j, Y');
                                                echo htmlspecialchars($formattedDate); ?>
                                            </small>
                                        </p>
                                    </a>
                                    <?php if ($timelineItem['timeline_title'] === "Harvested") { ?>
                                            <?php 
                                                // Total quantity of plants initially planted
                                                $totalPlanted = $plantData['quantity'];
                                                
                                                // Harvested quantity
                                                $harvestedQuantity = $timelineItem['quantity'];
                                                
                                                // Calculate Total Damage
                                                $totalDamage = $totalPlanted - $harvestedQuantity;
                                                
                                                // Calculate percentages
                                                $harvestPercentage = ($harvestedQuantity / $totalPlanted) * 100; // Harvest percentage
                                                $damagePercentage = ($totalDamage / $totalPlanted) * 100;       // Damage percentage

                                                // Calculate Total Profit (assuming profit is from harvested plants)
                                                $profitPerPlant = 2; // Replace with the actual profit per plant value
                                                $totalProfit = $harvestedQuantity * $profitPerPlant;
                                            ?>
                                                <p>Total Harvest: 
                                                    <span class="text-info">
                                                        <?php echo $harvestedQuantity . "/" . $totalPlanted . " (" . number_format($harvestPercentage, 2) . "%)"; ?>
                                                    </span>
                                                </p>
                                                <p>Total Damage: 
                                                    <span class="text-danger">
                                                        <?php echo $totalDamage . " (" . number_format($damagePercentage, 2) . "%)"; ?>
                                                    </span>
                                                </p>
                                                <p>Survival Rate:  
                                                    <span class="
                                                        <?php 

                                                            // Assuming profit per plant is fixed
                                                            $profitPerPlant = 2; // Replace with the actual profit per plant
                                                            $maxProfit = $plantData['quantity'] * $profitPerPlant; // Maximum possible profit
                                                            $profitPercentage = ($totalProfit / $maxProfit) * 100; // Profit percentage

                                                            if ($profitPercentage <= 50) {
                                                                echo 'text-danger'; // Danger for 50% or less
                                                            } elseif ($profitPercentage <= 90) {
                                                                echo 'text-warning'; // Warning for more than 50% up to 90%
                                                            } else {
                                                                echo 'text-success'; // Success for above 90%
                                                            }
                                                        ?>">
                                                        <?php echo number_format($profitPercentage, 2) . "%"; ?>
                                                    </span>
                                                </p>

                                                <p>Total Profit: 
                                                    <span class="text-success">
                                                        <?php 
                                                            // Assuming profit per plant is fixed
                                                            $profitPerPlant = 2; // Replace with the actual profit per plant
                                                            $maxProfit = $plantData['quantity'] * $profitPerPlant; // Maximum possible profit
                                                            $profitPercentage = ($totalProfit / $maxProfit) * 100; // Profit percentage
                                                            
                                                            // Display total profit with currency formatting and percentage
                                                            echo "₱" . number_format($totalProfit, 2) . " (" . number_format($profitPercentage, 2) . "%)";
                                                        ?>
                                                    </span>
                                                </p>

                                        <?php } ?>

                                </div>
                                <div class="col-6 col-md-2 d-flex justify-content-center align-items-center mt-2 mt-md-0">
                                    <a class="btn btn-info mx-1 px-3 px-md-5" onclick="setEditTimelineData(<?php echo htmlspecialchars(json_encode($timelineItem)); ?>)">
                                        <i class='bx
                                        bx-edit icon text-white'></i>
                                    </a>
                                    <a class="btn btn-danger mx-1 px-3 px-md-5" onclick="setDeleteTimelineId('<?php echo htmlspecialchars($timelineItem['id']); ?>')">
                                     <i class='bx bx-trash icon'></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Collapse here -->
                            <div class="collapse m-2" id="collapse<?php echo htmlspecialchars($timelineItem['id']); ?>">
                            <?php 
                                $contentID = $timelineItem['content_id'];
                                $contents = $timeline->getContentByTimelineId($contentID);
                                if (!empty($contents)):
                                    foreach ($contents as $content):
                            ?>
                                <span class="badge text-bg-secondary py-1 px-2 my-2">
                                    <?php
                                    // Convert history_time from 'HH:MM:SS.000000' to 'HH:MM AM/PM'
                                    $historyTime = htmlspecialchars($content['history_time']); // Access from $content
                                    $timeObject = DateTime::createFromFormat('H:i:s.u', $historyTime);
                                    $formattedTime = $timeObject->format('h:i A'); // 12:27 PM
                                    echo htmlspecialchars($formattedTime); ?>
                                </span>

                                <div class="card mb-2">
                                    <div class="card-body d-flex justify-content-between align-items-center
                                    <?php echo ($content['status'] == 'Success') ? 'my-bg-success' : 'my-bg-info'; ?> 
                                    rounded">
                                        <p class="me-3"><?php echo htmlspecialchars($content['content']); ?></p>
                                        <div>
                                            <a class="btn btn-info mx-1 px-3 px-md-5" onclick="setEditContentData(<?php echo htmlspecialchars(json_encode($content)); ?>)">
                                                <i class='bx
                                                bx-edit icon text-white'></i>
                                            </a>
                                            <a class="btn btn-danger mx-1 px-3 px-md-5" onclick="setDeleteContent('<?php echo htmlspecialchars($content['id']); ?>')">
                                                <i class='bx
                                                bx-trash icon text-white'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                        endforeach;
                                    else:
                                ?>
                                    <p class="text-danger">No content available for this timeline item.</p>
                                <?php endif; ?>
                              
                                <a class="btn btn-outline-warning w-100 my-2" data-bs-toggle="modal" data-target="#createContentModal"  data-id="<?php echo htmlspecialchars($timelineItem['content_id']);?>" onclick="setCreateId(this)">
                                    Create Content
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END TIMELINE CONTENT -->
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center">No records found.</div>
            <?php endif; ?>
            </div>
            <a class="btn btn-warning w-100 my-2" data-bs-toggle="modal" data-bs-target="#createTimelineModal">
                Create
            </a>
           
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
            const timelineTitle = document.getElementById("timeline_title");
            const descriptionField = document.getElementById("description-field");
            const quantityField = document.getElementById("quantity-field");

            timelineTitle.addEventListener("change", function () {
                const selectedValue = timelineTitle.value;

                // Show/hide fields based on selection
                if (selectedValue === "Harvested") {
                    quantityField.style.display = "block";
                    descriptionField.style.display = "none";
                } else if (selectedValue === "Fertilizing" || selectedValue === "Watering") {
                    descriptionField.style.display = "none";
                    quantityField.style.display = "none";
                } else {
                    // Reset fields
                    descriptionField.style.display = "none";
                    quantityField.style.display = "none";
                }
            });
        });
</script>

<?php include_once('../../components/footer.php'); ?>