<?php 
$title = "Order";
include_once('../../components/header.php');
include_once('../../../controller/PlantOrderController.php');
?>


<!-- Main Content -->
<div class="p-3">
    <a class="btn btn-outline-danger m-2" href="../dashboard/index.php">
        <i class='bx bx-arrow-back'></i> Back
    </a>
    
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Manage Orders</h3>
            <div>
                <button type="button" class="btn btn-warning btn-sm d-md-none" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                    <i class='bx bx-plus'></i> Add Order
                </button>
                <button type="button" class="btn btn-warning d-none d-md-inline-block" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                    <i class='bx bx-plus'></i> Add Order
                </button>
                <a class="btn btn-primary d-none d-md-inline-block ms-2" href="../plant_nursery/index.php">
                    <i class='bx bx-list-ul'></i> Check Plant List
                </a>
            </div>
        </div>

        <!-- Search Input -->
        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class='bx bx-search'></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Search orders...">
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="nurseryOwnersTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Field</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>DateTime</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['nursery_field']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_quantity']); ?></td>
                                <td>₱<?php echo number_format($order['order_price'], 2); ?></td>
                                <td class="text-success fw-bold">₱<?php echo number_format($order['order_total'], 2); ?></td>
                                <td>
                                    <?php 
                                    $datetime = new DateTime($order['order_datetime']);
                                    echo htmlspecialchars($datetime->format('F j, Y g:ia')); 
                                    ?>
                                </td>
                                <!-- <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="update.php?ID=<?php echo htmlspecialchars($order['id']); ?>" title="Edit">
                                            <i class='bx bx-edit-alt text-white'></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo htmlspecialchars($order['id']); ?>" onclick="setDeleteId(this)" title="Delete">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </div>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">No orders found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderModalLabel">
                    <i class='bx bx-plus-circle'></i> Add New Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addOrderForm" method="POST">

                    <!-- Source Dropdown -->
                    <div class="form-group my-1">
                        <label for="nursery_id">Field</label>
                        <div class="dropdown w-100">
                            <input type="text" id="searchOrderPlantsInput" class="form-control" name="nursery_id" placeholder="Choose Source" onkeyup="filterOrderPlantsOptions()" onclick="toggleOrderPlantsDropdown()" required autocomplete="off">
                            <input type="hidden" id="nurseryId" name="nursery_id">
                            <input type="hidden" id="nurseryField" />
                            <div id="orderPlantsDropdownContent" class="dropdown-content w-100">
                                <?php if (!empty($plantInfos)): ?>
                                    <?php foreach ($plantInfos as $plantInfo): ?>
                                        <div onclick="selectOrderPlants(this)" data-id="<?php echo $plantInfo['nursery_id']; ?>" data-field="<?php echo $plantInfo['nursery_field']; ?>">
                                            <?php echo htmlspecialchars(trim($plantInfo['nursery_field'])); ?>
                                        </div>
                                       
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div>No records found</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    
                    <!-- <div class="mb-3">
                        <label for="nurseryId" class="form-label">Nursery ID</label>
                        <input type="text" class="form-control" id="nurseryId" name="nursery_id" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="orderName" class="form-label">Order Name</label>
                        <input type="text" class="form-control" id="orderName" name="order_name" required>
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
                    <input type="hidden" name="action" value="createOrder">
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
                        <span class="detail-label">Field</span>
                        <span id="confirmNurseryField" class="detail-value"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Order Name</span>
                        <span id="confirmOrderName" class="detail-value"></span>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class='bx bx-trash'></i> Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete this order? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteId">
                    <button type="submit" class="btn btn-danger">
                        <i class='bx bx-trash'></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize variables and event listeners when the document loads
document.addEventListener('DOMContentLoaded', function() {
    // Set current date/time
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('orderDatetime').value = now.toISOString().slice(0, 16);
    
    // Add event listeners for total calculation
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
    document.getElementById('confirmNurseryField').textContent = document.getElementById('nurseryField').value;
    document.getElementById('confirmOrderName').textContent = document.getElementById('orderName').value;
    document.getElementById('confirmOrderQuantity').textContent = document.getElementById('orderQuantity').value;
    document.getElementById('confirmOrderPrice').textContent = '₱' + parseFloat(document.getElementById('orderPrice').value).toFixed(2);
    document.getElementById('confirmOrderTotal').textContent = '₱' + document.getElementById('orderTotal').value;
    // document.getElementById('confirmNurseryId').textContent = document.getElementById('nurseryField').value;

    

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