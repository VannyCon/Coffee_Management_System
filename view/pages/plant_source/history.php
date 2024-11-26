<?php 
  $title = "Source";
  include_once('../../components/header.php');
  include_once('../../../controller/PlantSourceController.php');
  // Check if 'id' is provided in the URL
if (isset($_GET['sourceID'])) {
    $source_id = $_GET['sourceID'];
    // Fetch the specific center details
    $sourceOrderHistorys = $sourceService->getSourceHistory($source_id);
    

} else {
    echo "<div class='alert alert-danger'>No ID provided!</div>";
    exit();
}

?>



<div class="p-3">
<a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
    <div class="card p-4">

    <h3>Order History</h3>

    <!-- Search Input -->
    <div class="mb-1">
        <p>Source Name:
            <span class="text-success">
                <?php if (!empty($sourceOrderHistorys)): ?>
                            <?php foreach ($sourceOrderHistorys as $sourceOrderHistory): ?>
                                <?php echo htmlspecialchars($sourceOrderHistory['source_fullname']); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No Transaction</td>
                    </tr>
                <?php endif; ?>
            </span>
        </p>
    </div>
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for History...">
    </div>
    <div class="table-responsive">
       <!-- Table for nursery owners -->
        <table border="1" class="table" id="nurseryOwnersTable">
            <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>DateTime</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sourceOrderHistorys)): ?>
                    <?php foreach ($sourceOrderHistorys as $sourceOrderHistory): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sourceOrderHistory['order_quantity']); ?></td>
                            <td>₱<?php echo htmlspecialchars($sourceOrderHistory['order_price']); ?></td>
                            <td class="text-success">₱<?php echo htmlspecialchars($sourceOrderHistory['order_total']); ?></td>
                            <td>
                                    <?php 
                                    $datetime = new DateTime($sourceOrderHistory['order_datetime']);
                                    echo htmlspecialchars($datetime->format('F j, Y g:ia')); 
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

<!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderModalLabel">
                    <i class='bx bx-plus-circle'></i> Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addOrderForm" method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" id="source_id" name="source_id">
                    <div class="mb-3">
                        <label for="source_name" class="form-label">Source Name</label>
                        <input type="text" class="form-control" id="source_name" name="source_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="orderQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="orderQuantity" name="order_quantity" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="orderPrice" class="form-label">Price (₱)</label>
                        <input type="number" class="form-control" id="orderPrice" name="order_price" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="orderTotal" class="form-label">Total Amount (₱)</label>
                        <input type="number" class="form-control bg-light" id="orderTotal" name="order_total" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="orderDatetime" class="form-label">Order Date & Time</label>
                        <input type="datetime-local" class="form-control" id="orderDatetime" name="order_datetime" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="showConfirmationModal()">
                    <i class='bx bx-check-circle'></i> Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideright">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmationModalLabel">
                    <i class='bx bx-check-circle'></i> Confirm Order Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="confirmation-details">
                    <div class="detail-item">
                        <span class="detail-label">Source Name</span>
                        <span id="confirmSourceId" class="detail-value"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Quantity</span>
                        <span id="confirmOrderQuantity" class="detail-value"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Price</span>
                        <span id="confirmOrderPrice" class="detail-value"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Amount</span>
                        <span id="confirmOrderTotal" class="detail-value text-success fw-bold"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date & Time</span>
                        <span id="confirmOrderDatetime" class="detail-value"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="backToAddOrder()">
                    <i class='bx bx-arrow-back'></i> Back
                </button>
                <button type="button" class="btn btn-success" onclick="submitOrder()">
                    <i class='bx bx-check-double'></i> Confirm Order
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addOrderModal = document.getElementById('addOrderModal');
    addOrderModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const sourceId = button.getAttribute('data-source-id');
        const sourceName = button.getAttribute('data-source-name');
            // Set current date/time
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('orderDatetime').value = now.toISOString().slice(0, 16);

        document.getElementById('source_id').value = sourceId;
        document.getElementById('source_name').value = sourceName;
    });

    document.getElementById('orderQuantity').addEventListener('input', calculateTotal);
    document.getElementById('orderPrice').addEventListener('input', calculateTotal);
});

// Calculate total amount
function calculateTotal() {
    const quantity = parseFloat(document.getElementById('orderQuantity').value) || 0;
    const price = parseFloat(document.getElementById('orderPrice').value) || 0;
    const total = (quantity * price).toFixed(2);
    document.getElementById('orderTotal').value = total;
}

// Show confirmation modal
function showConfirmationModal() {
    // Validate form
    const form = document.getElementById('addOrderForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Hide add order modal
    $('#addOrderModal').modal('hide');

    // Update confirmation details
    document.getElementById('confirmSourceId').textContent = document.getElementById('source_id').value;
    document.getElementById('confirmOrderQuantity').textContent = document.getElementById('orderQuantity').value;
    document.getElementById('confirmOrderPrice').textContent = '₱' + parseFloat(document.getElementById('orderPrice').value).toFixed(2);
    document.getElementById('confirmOrderTotal').textContent = '₱' + document.getElementById('orderTotal').value;

    // Format datetime
    const datetime = new Date(document.getElementById('orderDatetime').value);
    const formattedDateTime = datetime.toLocaleString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    });
    document.getElementById('confirmOrderDatetime').textContent = formattedDateTime;

    // Show confirmation modal after a brief delay
    setTimeout(() => {
        $('#confirmationModal').modal('show');
    }, 500);
}

// Handle back button in confirmation modal
function backToAddOrder() {
    $('#confirmationModal').modal('hide');
    setTimeout(() => {
        $('#addOrderModal').modal('show');
    }, 500);
}

// Submit the order form
function submitOrder() {
    document.getElementById('addOrderForm').submit();
    $('#confirmationModal').modal('hide');
}

// Set delete ID for delete modal
function setDeleteId(button) {
    document.getElementById('deleteId').value = button.getAttribute('data-id');
    $('#deleteModal').modal('show');
}
</script>

<?php include_once('../../components/footer.php'); ?>
