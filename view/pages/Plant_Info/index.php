<?php 
require_once('../../../services/PlantInfoService.php');

// Instantiate the class and get nursery owners
$plantInfo = new PlantInfo();
$plants = $plantInfo->getPlantInfos();
include_once('../../components/header.php');

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $plantInfo->clean('id', 'post');
    error_log("Attempting to delete owner with ID: $id"); // Log the ID
    $result = $plantInfo->delete($id);
    
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        error_log("Deletion failed for ID: $id");
        header("Location: index.php");
    }
}
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
    <a class="btn btn-outline-danger m-2" href="../Nursery_Owner/index.php" width="200"> Back </a>
    <div class="card p-4">
      
      <h1>Plant List</h1>

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for owner...">
    </div>

    <div class="my-2">
     <a type="button" class="btn btn-warning " href="create.php">Create</a>
    </div>
   
    <!-- Table for nursery owners -->
    <table border="1" class="table" id="nurseryOwnersTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nursery Owner</th>
                <th>Type</th>
                <th>Variety</th>
                <th>Planted Date</th>
                <th>Action</th>
                <th>Timeline</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($plants)): ?>
                <?php foreach ($plants as $plant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($plant['id']); ?></td>
                        <td><?php echo htmlspecialchars($plant['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($plant['plant_type']); ?></td>
                        <td><?php echo htmlspecialchars($plant['plant_variety']); ?></td>
                        <td><?php echo htmlspecialchars($plant['planted_date']); ?></td>
                        <td>
                            <a type="button" class="btn btn-info mx-2" href="update.php?userID=<?php echo htmlspecialchars($plant['id']); ?>">Update</a>
                            <button type="button" class="btn btn-danger" data-id="<?php echo htmlspecialchars($plant['id']); ?>" onclick="setDeleteId(this)">Delete</button>
                        </td>
                        <td>
                        <a type="button" class="btn btn-success mx-2" href="../Timeline/index.php?id=<?php echo htmlspecialchars($plant['id']); ?>&plantID=<?php echo htmlspecialchars($plant['plant_id']); ?>">Create</a>

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


<?php include_once('../../components/footer.php'); ?>
