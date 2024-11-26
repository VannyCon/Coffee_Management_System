<?php 
  $title = "Variety";
  include_once('../../components/header.php');
  include_once('../../../controller/PlantVarietyController.php');
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

    <h3>Manage Plant Variety</h3>

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for Variety...">
    </div>
    <div class="mb-3">
        <a type="button" class="btn btn-sm d-md-none btn-warning " href="create.php">Add Record</a>
        <a type="button" class="btn btn-sm d-md-none btn-primary mx-2" href="../plant_nursery/index.php">Check Plant List</a>

        <a type="button" class="btn d-none d-md-inline-block btn-warning " href="create.php">Add Record</a>
        <a type="button" class="btn d-none d-md-inline-block btn-primary mx-2" href="../plant_nursery/index.php">Check Plant List</a>

    </div>
    <div class="table-responsive">
       <!-- Table for nursery owners -->
        <table border="1" class="table" id="nurseryOwnersTable">
            <thead>
                <tr>
                    <th>Variety Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($varietys)): ?>
                    <?php foreach ($varietys as $variety): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($variety['variety_name']); ?></td>
                            <td><?php echo htmlspecialchars($variety['description']); ?></td>
                            <td class=" justify-content-center align-items-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-info" href="update.php?ID=<?php echo htmlspecialchars($variety['id']); ?>">
                                        <i class='bx bx-edit icon text-white'></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-id="<?php echo htmlspecialchars($variety['id']); ?>" onclick="setDeleteId(this)">
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
