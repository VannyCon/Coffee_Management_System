<?php 
  $title = "Timeline";
  require_once('../../../services/TimelineService.php');
  require_once('../../../services/PlantInfoService.php');
  // Instantiate the class and get nursery owners
  $timeline = new Timeline();
  $plant = new PlantInfo();
  include_once('../../components/header.php');

  ///make a logic here where return to plantINfo if plandID not found
  $plantID = $_GET['plantID'];
  $timelines = $timeline->getTimelineById($plantID);
  $plantData = $plant->getPlantDataByID($plantID);
  require_once('../../../controller/ContentController.php');
  require_once('../../../controller/TimelineController.php');  

?>
<?php include_once('../../components/timelineModals.php'); ?>



    <div class="m-1 p-1 p-lg-5">
        <div class="timeline-container">
        <a class="btn btn-outline-danger m-2" href="../plantinfo/index.php" width="200"> Back </a>
        <div class="p-3">
            <div class="row">
                <div class="col-md-12 text-left">
                
                    <p><strong>Nursery Owner Fullname:</strong> <?php echo $plantData['nursery_owner_fullname']; ?></p>
                    <p><strong>Type:</strong> <?php echo $plantData['plant_type']; ?></p>
                    <p><strong>Variety:</strong> <?php echo $plantData['plant_variety']; ?></p>
                    <p><strong>Age: </strong> <?php
                                                    // Sample planted_date from $plantData
                                                    $plantedDate = $plantData['planted_date']; // Format: YYYY-MM-DD

                                                    // Convert the planted date to a DateTime object
                                                    $plantedDateObj = new DateTime($plantedDate);

                                                    // Get the current date
                                                    $currentDate = new DateTime();

                                                    // Calculate the difference between the current date and the planted date
                                                    $interval = $plantedDateObj->diff($currentDate);

                                                    
                                                    ?>
                                                    </p>
                    <p><strong>Planted Date:</strong> <?php echo $plantData['planted_date']; ?></p>
                    <a class="btn btn-primary px-5" href="download_pdf.php?plantID=<?php echo htmlspecialchars($plantID); ?>"> 
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
                                </div>
                                <div class="col-6 col-md-2 d-flex justify-content-center align-items-center mt-2 mt-md-0">
                                    <a class="btn btn-info mx-1 px-3 px-md-5" onclick="setEditTimelineData(<?php echo htmlspecialchars(json_encode($timelineItem)); ?>)">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger mx-1 px-3 px-md-5" onclick="setDeleteTimelineId('<?php echo htmlspecialchars($timelineItem['id']); ?>')">
                                        Delete
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
                                        <div>
                                            <a class="btn btn-outline-info mx-1 px-3 px-md-5" onclick="setEditContentData(<?php echo htmlspecialchars(json_encode($content)); ?>)">
                                                Edit
                                            </a>
                                            <a class="btn btn-outline-danger mx-1 px-3 px-md-5" onclick="setDeleteContent('<?php echo htmlspecialchars($content['id']); ?>')">
                                                Delete
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

<?php include_once('../../components/footer.php'); ?>