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
  
          // If no errors, process the order
          if (empty($nameErr) && empty($addressErr) && empty($phoneErr)) {
              // Decode the cart data from JSON string
              $cart = json_decode($cartData, true);
  
              // Process the order (e.g., save to the database)
              if (!empty($cart)) {
                  $totalAmount = 0;
                  
                  // Calculate the total amount and save each item in the database
                  foreach ($cart as $item) {
                      $totalAmount += $item['discount_price'] * $item['count'];
                      // Save each cart item in the order details table (example SQL query)
                      $stmt = $conn->prepare("INSERT INTO order_items (product_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
                      $stmt->bind_param('isii', $item['id'], $item['name'], $item['count'], $item['discount_price']);
                      $stmt->execute();
                  }
  
                  // Save the order in the orders table
                  $stmt = $conn->prepare("INSERT INTO orders (customer_name, address, phone, total_amount) VALUES (?, ?, ?, ?)");
                  $stmt->bind_param('sssi', $name, $address, $phone, $totalAmount);
                  $stmt->execute();
  
                  // After processing the order, redirect to a success page or clear the cart
                  echo "<script>alert('Order successfully placed!');</script>";
                  echo "<script>sessionStorage.clear(); window.location.href = 'thank_you.php';</script>";
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
            <form id="checkoutForm" class="needs-validation" novalidate method="POST">
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
                <input type="hidden" name="cartData" id="cartData">
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
</div>

<?php  
    require_once 'footer.php';
?>

<script>
    $(document).ready(function() {
        // Load Cart Data from sessionStorage
        var cart = JSON.parse(sessionStorage.getItem('cart')) || {};
        var checkoutCartList = $('#checkoutCartList');

        // Display cart items in checkout page
        $.each(cart, function(key, item) {
            checkoutCartList.append(`
                <div class="d-flex align-items-center mb-2 border-bottom py-2">
                    <img src="./assets/images/products/${item.image}" class="img-fluid" style="height: 50px; object-fit: contain">
                    <div class="ms-3">
                        <strong>${item.name}</strong>
                        <p class="mb-0">BDT ${item.discount_price} x ${item.count}</p>
                    </div>
                </div>
            `);
        });

        // Bootstrap 5 validation
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        $('#cartData').val(JSON.stringify(cart)); // Set cart data to hidden input before form submission
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    });
</script>
