<?php 
    $title = "Nursery";
include_once('../../components/header.php');
include_once('../../../controller/NurseryController.php');
?>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this owner?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
<a class="btn btn-outline-danger m-2" href="../Dashboard/index.php" width="200"> Back </a>
    <div class="card p-4">

    <h1>Choose Nursery Owner</h1>

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for owner...">
    </div>
    <div class="mb-3">
        <a type="button" class="btn btn-warning " href="create.php">Create</a>
        <a type="button" class="btn btn-primary mx-2" href="../plant_info/index.php">Check Plant List</a>
    </div>
    <div class="table-responsive">
       <!-- Table for nursery owners -->
        <table border="1" class="table" id="nurseryOwnersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($owners)): ?>
                    <?php foreach ($owners as $owner): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($owner['id']); ?></td>
                            <td><?php echo htmlspecialchars($owner['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($owner['contact_number']); ?></td>
                            <td><?php echo htmlspecialchars($owner['address']); ?></td>
                            <td>
                                <a type="button" class="btn btn-info mx-2" href="update.php?userID=<?php echo htmlspecialchars($owner['id']); ?>">Update</a>
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
