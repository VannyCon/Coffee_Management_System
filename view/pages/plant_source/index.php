<?php 
  $title = "Source";
  include_once('../../components/header.php');
  include_once('../../../controller/PlantSourceController.php');
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


<div class="p-3">
<a class="btn btn-outline-danger m-2" href="../dashboard/index.php" width="200"> Back </a>
    <div class="card p-4">

    <h3>Manage Sources</h3>

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for Source...">
    </div>
    <div class="mb-3">
        <a type="button" class="btn btn-warning " href="create.php">Add Record</a>
        <a type="button" class="btn btn-primary mx-2" href="../plant_nursery/index.php">Check Plant List</a>
    </div>
    <div class="table-responsive">
       <!-- Table for nursery owners -->
        <table border="1" class="table" id="nurseryOwnersTable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($owners)): ?>
                    <?php foreach ($owners as $owner): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($owner['source_fullname']); ?></td>
                            <td><?php echo htmlspecialchars($owner['source_contact_number']); ?></td>
                            <td><?php echo htmlspecialchars($owner['source_email']); ?></td>
                            <td><?php echo htmlspecialchars($owner['source_address']); ?></td>
                            <td>
                                <a type="button" class="btn btn-info mx-0 mx-md-2 my-1 my-md-0" href="update.php?userID=<?php echo htmlspecialchars($owner['id']); ?>">Update</a>
                                <button type="button" class="btn btn-danger" data-id="<?php echo htmlspecialchars($owner['id']); ?>" onclick="setDeleteId(this)">Delete</button>
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
