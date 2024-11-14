<?php 

  $title = "Nursery";
  require_once('../../../services/PlantNurseryService.php');
  include_once('../../../controller/PlantNurseryController.php');
  include_once('../../components/header.php');
?>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" id="deleteId">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div>
    <a class="btn btn-outline-danger my-2" href="../dashboard/index.php" width="200"> Back </a>
    <div class="card p-4">
      
      <h3>Manage Nursery</h3>

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for Nursery...">
    </div>

    <div class="my-2">
     <a type="button" class="btn btn-warning btn-sm d-md-none" href="create.php">Add Record</a>
     <a type="button" class="btn btn-warning d-none d-md-inline-block" href="create.php">Add Record</a>
    </div>
      <div class="table-responsive">
                <!-- Table for nursery owners -->
                <table border="1" class="table" id="nurseryOwnersTable">
                    <thead>
                        <tr>
                            
                            <th>Field</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Variety</th>
                            <th>Planted Date</th>
                            <th>Action</th>
                            <th>QR</th>
                            <th>Timeline</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($nurserys)): ?>
                            <?php foreach ($nurserys as $nursery): ?>
                                <tr> 
                                    
                                    <td><?php echo htmlspecialchars($nursery['nursery_field']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['type_name']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['variety_name']); ?></td>
                                    <td>
                                        <?php 
                                            // Convert the planted date to a DateTime object
                                            $plantedDate = new DateTime($nursery['planted_date']);
                                            
                                            // Format the date as 'F j, Y' (e.g., September 19, 2024)
                                            echo $plantedDate->format('F j, Y');
                                        ?>
                                    </td>

                                    <td>
                                        <a type="button" class="btn  btn-info mx-0 mx-md-2 my-1 my-md-0" href="update.php?ID=<?php echo htmlspecialchars($nursery['id']); ?>"><i class='bx bx-edit icon text-white'></i></a>
                                        <button type="button" class="btn  btn-danger" data-id="<?php echo htmlspecialchars($nursery['id']); ?>" onclick="setDeleteId(this)"><i class='bx bx-trash icon'></i></button>
                                    </td>
                                    <td>
                                      <a type="button" class="btn btn-sm d-md-none btn-primary mx-2" href="qr.php?plantID=<?php echo htmlspecialchars($nursery['nursery_id']); ?>">Donwload</a>

                                      <a type="button" class="btn d-none d-md-inline-block btn-primary mx-2" href="qr.php?plantID=<?php echo htmlspecialchars($nursery['nursery_id']); ?>">Donwload</a>
                                    </td>
                                    <td>
                                      <a type="button" class="btn btn-sm d-md-none btn-outline-success mx-2" href="../plant_timeline/index.php?id=<?php echo htmlspecialchars($nursery['id']); ?>&nurseryID=<?php echo htmlspecialchars($nursery['nursery_id']); ?>">Check</a>
                                      <a type="button" class="btn d-none d-md-inline-block btn-outline-success mx-2" href="../plant_timeline/index.php?id=<?php echo htmlspecialchars($nursery['id']); ?>&nurseryID=<?php echo htmlspecialchars($nursery['nursery_id']); ?>">Check</a>
                                    </td>
                                    <td>
                                      <?php 
                                          // Get the relevant date (e.g., harvest date or planted date)
                                          $history_date = $nurseryServices->getHarvestStatus($nursery['nursery_id']);

                                          // Get the current date
                                          $now = new DateTime();

                                          // Ensure the relevant_date is in 'Y-m-d' format (or adjust accordingly)
                                          $relevant_date = new DateTime($history_date['relevant_date']);

                                          // Calculate the difference between now and the relevant date
                                          $interval = $now->diff($relevant_date);

                                          // Check if the relevant date is today
                                          if ($relevant_date->format('Y-m-d') == $now->format('Y-m-d') && $history_date['status'] == 'True') {
                                              echo '<span class="badge text-bg-success">Harvested</span>';
                                          }
                                          // Check if the difference is 3 months or more
                                          else if ($interval->y > 0 || $interval->m >= 24) {
                                              echo '<span class="badge text-bg-warning text-white">Ready</span>';
                                          }
                                          // Otherwise, show "Not Ready"
                                          else {
                                              echo '<span class="badge text-bg-danger">Not Ready</span>';
                                          }
                                      ?>
                                  </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Button if no records are found -->
                <div id="noRecords" class="text-center mt-3" style="display: none;">
                    <p>No results found.</p>
                    <a type="button" class="btn btn-warning" href="create.php">Create</a>
                </div>
                </div>
            </div>

      </div>
    

<?php include_once('../../components/footer.php'); ?>
