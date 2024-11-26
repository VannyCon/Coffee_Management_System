<?php 
  $title = "User";
  require_once('../../../services/PlantTimelineService.php');
  require_once('../../../services/PlantNurseryService.php');
  // Instantiate the class and get nursery owners
  $timeline = new Timeline();
  $plant = new PlantInfo();

  ///make a logic here where return to plantINfo if plandID not found
  $nurseryID = $_GET['nurseryID'];
  $timelines = $timeline->getTimelineById($nurseryID);
  $plantData = $plant->getPlantDataByID($nurseryID);

  include_once('../../components/header.php');
?>


    <div class="m-1 p-1 p-lg-5">
        <div class="timeline-container">
        <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>

        <h4 class="m-3"> <strong>Plant Information</strong></h4>
        <div class="p-3">
            <div class="row">
                <div class="col-md-12 text-left">
                <p><strong>Nursery Owner:</strong> Doc. Patrick Escalante</p>
                    <p><strong>Field:</strong> <?php echo $plantData['nursery_field']; ?></p>
                    <p><strong>Type:</strong> <?php echo $plantData['type_name']; ?></p>
                    <p><strong>Type Description:</strong> <?php echo $plantData['type_description']; ?></p>
                    <p><strong>Variety:</strong> <?php echo $plantData['variety_name']; ?></p>
                    <p><strong>Variety Description:</strong> <?php echo $plantData['variety_description']; ?></p>
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
                    <strong>Harvest Date:</strong>
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
                                <div class="col-12 col-md-12 ml-md-2">
                                    <a class="w-100 text-left  text-decoration-none" data-bs-toggle="collapse" href="#collapse<?php echo htmlspecialchars($timelineItem['id']); ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                                    <?php echo ($content['status'] == 'success') ? 'my-bg-success' : 'my-bg-info'; ?> 
                                    rounded">
                                        <p class="me-3"><?php echo htmlspecialchars($content['content']); ?></p>
                                    </div>
                                </div>

                                <?php 
                                        endforeach;
                                    else:
                                ?>
                                    <p class="text-danger">No content available for this timeline item.</p>
                                <?php endif; ?>
                              
                             
                            </div>
                        </div>
                    </div>
                    <!-- END TIMELINE CONTENT -->
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center">No records found.</div>
            <?php endif; ?>
            </div>
        </div>
    </div>

<?php include_once('../../components/footer.php'); ?>