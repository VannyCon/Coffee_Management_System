<?php 

  $title = "PlantNursery";
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
        Are you sure you want to delete this owner?
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
        <input type="text" id="searchInput" class="form-control" placeholder="Search for owner...">
    </div>

    <div class="my-2">
     <a type="button" class="btn btn-warning " href="create.php">Create</a>
    </div>
      <div class="table-responsive">
                <!-- Table for nursery owners -->
                <table border="1" class="table" id="nurseryOwnersTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Source Fullname</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Variety</th>
                            <th>Planted Date</th>
                            <th>Action</th>
                            <th>Timeline</th>
                            <th>QR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($nurserys)): ?>
                            <?php foreach ($nurserys as $nursery): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($nursery['id']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['source_fullname']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['type_name']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['variety_name']); ?></td>
                                    <td><?php echo htmlspecialchars($nursery['planted_date']); ?></td>
                                    <td>
                                        <a type="button" class="btn btn-info mx-0 mx-md-2 my-1 my-md-0" href="update.php?ID=<?php echo htmlspecialchars($nursery['id']); ?>">Update</a>
                                        <button type="button" class="btn btn-danger" data-id="<?php echo htmlspecialchars($nursery['id']); ?>" onclick="setDeleteId(this)">Delete</button>
                                    </td>
                                    <td>
                                      <a type="button" class="btn btn-success mx-2" href="../plant_timeline/index.php?id=<?php echo htmlspecialchars($nursery['id']); ?>&nurseryID=<?php echo htmlspecialchars($nursery['nursery_id']); ?>">Check</a>
                                    </td>
                                    <td>
                                      <a type="button" class="btn btn-primary mx-2" href="qr.php?plantID=<?php echo htmlspecialchars($nursery['nursery_id']); ?>">Donwload</a>
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
