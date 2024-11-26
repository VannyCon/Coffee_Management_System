<?php 
  $title = "Center";
  include_once('../../components/header.php');
  include_once('../../../controller/PlantCenterController.php');
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


<div class="p-3">
<a class="btn btn-outline-danger m-2" href="../dashboard/index.php" width="200"> Back </a>
    <div class="card p-4">

    <h3>Manage Center Deployment</h3>

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for Center...">
    </div>
    <div class="mb-3">

        <!-- Mobile Button (visible only on mobile) -->
        <a type="button" class="btn btn-warning btn-sm d-md-none" href="create.php">Add Deploy</a>
        <a type="button" class="btn btn-primary btn-sm d-md-none mx-2" href="../plant_nursery/index.php">Check Plant List</a>
        <!-- Desktop Button (visible only on medium and larger screens) -->
        <a type="button" class="btn btn-warning d-none d-md-inline-block" href="create.php">Add Deploy</a>
        <a type="button" class="btn btn-primary d-none d-md-inline-block mx-2" href="../plant_nursery/index.php">Check Plant List</a>

    </div>
    <div class="table-responsive">
       <!-- Table for nursery owners -->
        <table border="1" class="table" id="nurseryOwnersTable">
            <thead>
                <tr>
                    <th>Center Name</th>
                    <th>Center Address</th>
                    <th>Fieldname</th>
                    <th>Quantity</th>
                    <th>Datetime</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($centers)): ?>
                    <?php foreach ($centers as $center): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($center['center_name']); ?></td>
                            <td><?php echo htmlspecialchars($center['center_address']); ?></td>
                            <td><?php echo htmlspecialchars($center['nursery_field']); ?></td>
                            <td class="text-success"><?php echo htmlspecialchars($center['center_quantity']); ?></td>
                            <td><?php echo htmlspecialchars($center['center_created_datetime']); ?></td>
                            <td class="justify-content-center align-items-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-info" href="update.php?ID=<?php echo htmlspecialchars($center['center_id']); ?>">
                                        <i class='bx bx-edit icon text-white'></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-id="<?php echo htmlspecialchars($center['center_id']); ?>" onclick="setDeleteId(this)">
                                        <i class='bx bx-trash icon'></i>
                                    </button>
                                </div>
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
