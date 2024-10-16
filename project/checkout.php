<?php
require_once 'header.php';
// Initialize error variables
$nameErr = $addressErr = $phoneErr = '';
$name = $address = $phone = '';
$cartData = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $bkash = trim($_POST['bkash']);
    $cartData = $_POST['cartData']; // This will contain the JSON string of cart items

    // Validate Full Name
    if (empty($name)) {
        $nameErr = 'Full name is required.';
    }

    // Validate Address
    if (empty($address)) {
        $addressErr = 'Address is required.';
    }

    // Validate Phone Number (must be between 10 and 15 digits)
    if (empty($phone)) {
        $phoneErr = 'Phone number is required.';
    } elseif (!preg_match('/^\d{10,15}$/', $phone)) {
        $phoneErr = 'Phone number must be between 10 to 15 digits.';
    }

    // bkash transaction id
    if (empty($bkash)) {
        $bkashErr = 'Bkash transaction id is required.';
    }


    // If no errors, process the order
    if (empty($nameErr) && empty($addressErr) && empty($phoneErr) && empty($bkashErr)) {
        // Decode the cart data from JSON string
        $cart = json_decode($cartData, true);

        // Process the order (e.g., save to the database)
        if (!empty($cart)) {
            $totalAmount = 0;

            // Calculate the total amount and save each item in the database
            foreach ($cart as $item) {
                // table name orders. columns: 	id, product_id, user_id, quantity, total_price, status, address, status, tid
                $totalAmount += $item['discount_price'] * $item['count'];
                // $conn is the mysqli database connection object. dont use pdo
                $stmt = $conn->query("INSERT INTO orders (product_id, user_id, quantity, total_price, status, address, tid) VALUES ('" . $item['id'] . "', '" . $_SESSION['user']['id'] . "', '" . $item['count'] . "', '" . $item['discount_price'] * $item['count'] . "', 'In Progress', '" . $address . "', '" . $bkash . "')");
                if($stmt){
                    echo "<script>toastr.success('Order submitted successfully')</script>";
                    echo "<script>sessionStorage.clear();</script>";
                } else {
                    echo "<script>toastr.error('Order submission failed')</script>";
                }
            }
        } else {
            echo "<script>alert('Your cart is empty. Please add items to the cart.');</script>";
        }
    }
}
?>

<div class="container">
    <h2 class="mt-5">Checkout</h2>

    <!-- Cart Summary Section -->
    <div class="row">
        <div class="col-md-8">
            <h4>Your Cart Items</h4>
            <div id="checkoutCartList" class="border p-3 mb-4"></div>
        </div>

        <!-- Checkout Form -->
        <div class="col-md-4">
            <h4>Shipping Details</h4>
            <form action="" id="checkoutForm" class="needs-validation" novalidate method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    <div class="invalid-feedback">Please provide your full name.</div>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                    <div class="invalid-feedback">Please provide your address.</div>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" pattern="^\d{10,15}$" required>
                    <div class="invalid-feedback">Please provide a valid phone number (10-15 digits).</div>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <!-- bkash transaction id -->
                <div class="mb-3">
                    <label for="bkash" class="form-label">Bkash Transaction ID</label>
                    <p class="small text-muted">
                        Please send the total amount to our bkash account (01955517560) and provide the transaction ID here.
                    </p>
                    <input type="text" name="bkash" id="bkash" class="form-control" required>
                    <div class="invalid-feedback">Please provide your bkash transaction id.</div>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <input type="hidden" name="cartData" id="cartData">
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // if cart is empty, redirect to home page
        setTimeout(() => {
            if (sessionStorage.getItem('cart') === null || sessionStorage.getItem('cart') === '{}') {
                window.location.href = 'index.php';
            }
        }, 2000);
        // Bootstrap 5 validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        // Save the cart data to the hidden input field
                        document.getElementById('cartData').value = sessionStorage.getItem('cart');
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    });
</script>

<?php
require_once 'footer.php';
?>