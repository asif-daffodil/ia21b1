<?php
require_once "./header.php";
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php require_once "./sidebar.php" ?>
<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="logo-pro">
                    <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $breadcomb = "All Orders";
    require_once "./top-header.php";
    ?>
    <div class="container">
        <?php
        // Handle deletion if delete form is submitted
        if (isset($_POST['delete_order'])) {
            $delete_id = $_POST['order_id'];
            $delete_sql = "DELETE FROM orders WHERE id = '$delete_id'";
            if ($conn->query($delete_sql) === TRUE) {
                echo "<script>toastr.success('Order deleted successfully');</script>";
            } else {
                echo "<script>toastr.error('Failed to delete order');</script>";
            }
        }

        // Handle status change if status form is submitted
        if (isset($_POST['change_status'])) {
            $order_id = $_POST['order_id'];
            $new_status = $_POST['status'];
            $update_sql = "UPDATE orders SET status = '$new_status' WHERE id = '$order_id'";
            if ($conn->query($update_sql) === TRUE) {
                echo "<script>toastr.success('Order status updated successfully');</script>";
            } else {
                echo "<script>toastr.error('Failed to update status');</script>";
            }
        }
        ?>

        <div class="row" style="background: white; padding: 20px 0px">
            <div class="col-md-12">
                <table id="ordersTable" class="table display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>User Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT orders.*, products.name as product_name, users.name as user_name 
                                FROM orders 
                                JOIN products ON orders.product_id = products.id 
                                JOIN users ON orders.user_id = users.id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['product_name'] ?></td>
                                    <td><?php echo $row['user_name'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['total_price'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="In Progress" <?php echo $row['status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                                <option value="Delivered" <?php echo $row['status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                                            </select>
                                            <input type="hidden" name="change_status" value="1">
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete-btn" data-order-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this order?
      </div>
      <div class="modal-footer">
        <form method="POST" action="">
            <input type="hidden" name="order_id" id="deleteOrderId" value="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="delete_order" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#ordersTable').DataTable({
            "lengthMenu": [5, 10, 25, 50]
        });

        // Delegate the delete button event to handle dynamically loaded elements
        $(document).on('click', '.delete-btn', function() {
            var orderId = $(this).data('order-id');
            $('#deleteOrderId').val(orderId); // Set the order ID in the modal
        });

        // Handle the form submission for deleting the order
        $('#deleteModal form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var orderId = $('#deleteOrderId').val(); // Get the order ID to delete

            // Make the delete request via AJAX to avoid a full page refresh
            $.ajax({
                url: '', // Ensure this points to the current PHP file handling the deletion
                method: 'POST',
                data: {
                    delete_order: true,
                    order_id: orderId
                },
                success: function(response) {
                    // Hide the modal and show a success message using Toastr
                    $('#deleteModal').modal('hide');
                    toastr.success('Order deleted successfully');

                    // Add a 2-second timeout before reloading the page
                    setTimeout(function() {
                        location.reload(); // Reload the page after 2 seconds
                    }, 1000); // 2 seconds = 2000 milliseconds
                },
                error: function() {
                    toastr.error('Failed to delete the order');
                }
            });
        });
    });
</script>

