<?php 
  require_once('../../../services/TimelineService.php');

  // Instantiate the class and get nursery owners
  $timeline = new Timeline();
  include_once('../../components/header.php');

  ///make a logic here where return to plantINfo if plandID not found
  $plantID = $_GET['plantID'];
  $timelines = $timeline->getTimelineById($plantID);

  require_once('../../../controller/ContentController.php');
  require_once('../../../controller/TimelineController.php');  

?>
<?php include_once('../../components/header.php'); ?>
<?php include_once('../../components/timelineModals.php'); ?>



    <div class="m-1 p-1 p-lg-5">
        <div class="timeline-container">
            <h2>Timeline</h2>
            <div class="timeline">
            <?php if (!empty($timelines)): ?>
                <?php foreach ($timelines as $timelineItem): ?>
                    <!-- START TIMELINE CONTENT -->
                    <div class="timeline-item">
                        <div class="card p-2 timeline-content ml-2 p-1">
                            <div class="row g-0 p-2">
                                <div class="col-6 col-md-9 ml-md-2">
                                    <a class="w-100 text-left" data-toggle="collapse" href="#collapse<?php echo htmlspecialchars($timelineItem['id']); ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                                <span class="badge badge-secondary py-1 px-2 my-2">
                                    <?php
                                    // Convert history_time from 'HH:MM:SS.000000' to 'HH:MM AM/PM'
                                    $historyTime = htmlspecialchars($content['history_time']); // Access from $content
                                    $timeObject = DateTime::createFromFormat('H:i:s.u', $historyTime);
                                    $formattedTime = $timeObject->format('h:i A'); // 12:27 PM
                                    echo htmlspecialchars($formattedTime); ?>
                                </span>

                                    <div class="card mb-2">
                                    <div class="card-body 
                                        <?php echo ($content['status'] == 'success') ? 'my-bg-success' : 'my-bg-info'; ?> 
                                        rounded">

                                        <p><?php echo htmlspecialchars($content['content']); ?></p>
                                        </div>
                                    </div>
                                <?php 
                                        endforeach;
                                    else:
                                ?>
                                    <p class="text-danger">No content available for this timeline item.</p>
                                <?php endif; ?>
                              
                                <a class="btn btn-primary w-100 my-2" data-toggle="modal" data-target="#createContentModal"  data-id="<?php echo htmlspecialchars($timelineItem['content_id']);?>" onclick="setCreateId(this)">
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
            <a class="btn btn-warning w-100 my-2" data-toggle="modal" data-target="#createTimelineModal">
                Create
            </a>
        </div>
    </div>

<?php include_once('../../components/footer.php'); ?>