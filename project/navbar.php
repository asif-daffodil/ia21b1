<?php

$conn = new mysqli('localhost', 'root', '', 'ecommerce-1');
// Fetch Orders for logged-in user
$orders = [];
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    // Query to get order details along with product names
    $query = "SELECT o.product_id, o.quantity, o.total_price, o.address, o.created_at, o.status, p.name AS product_name 
              FROM orders o 
              JOIN products p ON o.product_id = p.id 
              WHERE o.user_id = ? ORDER BY o.created_at DESC";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        $stmt->close();
    } else {
        $error = "Query error: " . $conn->error;
    }
}


?>
<style>
    /* Custom styles for the orders modal */
    #ordersModal .modal-content {
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
    }

    #ordersModal .modal-header {
        background-color: #007bff;
        /* Bootstrap primary color */
        color: #fff;
        /* White text */
        border-top-left-radius: 10px;
        /* Match border radius */
        border-top-right-radius: 10px;
        /* Match border radius */
    }

    #ordersModal .modal-body {
        background-color: #f8f9fa;
        /* Light background for body */
    }

    #ordersModal .btn-secondary {
        background-color: #6c757d;
        /* Bootstrap secondary color */
        border: none;
        /* Remove border */
        transition: background-color 0.3s;
        /* Smooth transition */
    }

    #ordersModal .btn-secondary:hover {
        background-color: #5a6268;
        /* Darker shade on hover */
    }
</style>


<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">E-commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./" style="line-height: 40px">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="line-height: 40px">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="line-height: 40px">Contact</a>
                </li>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./assets/images/<?= !empty($_SESSION['user']['image']) ? $_SESSION['user']['image'] : "profile_picture.png" ?>" alt="" class="img-fluid me-1 d-inline rounded-circle" style="height:40px; width:40px; object-fit: cover">
                            <?= explode(' ', $_SESSION['user']['name'])[0] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./update-profile.php">Update Profile</a></li>
                            <li><a class="dropdown-item" href="./change-password.php">Change Password</a></li>
                            <li><a class="dropdown-item" href="./profile-picture.php">Profile Picture</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ordersModal">Your Orders</a></li>
                            <?php if ($_SESSION['user']['role'] == "admin") { ?>
                                <li><a class="dropdown-item" href="./admin">Admin Panel</a></li>
                            <?php } ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php" style="line-height: 40px">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./register.php" style="line-height: 40px">Register</a>
                    </li>
                <?php } ?>
            </ul>
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="dropend position-relative">
            <button class="btn btn-primary ms-2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-shopping-cart"></i>
                <span class="position-absolute start-100 top-0 bg-danger translate-middle rounded-circle small" style="width: 24px; line-height: 24px;" id="cartCount">0</span>
            </button>
            <div class="dropdown-menu position-absolute p-2" style="top: 106%; transform: translateX(-100%); width: max-content; max-width:350px" id="proList">
                Product List
            </div>
        </div>
    </div>
</nav>

<!-- Modal for Orders -->
<div class="modal fade" id="ordersModal" tabindex="-1" aria-labelledby="ordersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ordersModalLabel">Your Orders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($orders)) { ?>
                    <table class="table display" id="userOrderTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Address</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['product_name']) ?></td>
                                    <td><?= htmlspecialchars($order['quantity']) ?></td>
                                    <td><?= htmlspecialchars($order['total_price']) ?></td>
                                    <td><?= htmlspecialchars($order['address']) ?></td>
                                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                                    <td><?= htmlspecialchars($order['status']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No orders found.</p>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#userOrderTable').DataTable({
            "lengthMenu": [5, 10, 25, 50]
        });
    });
</script>