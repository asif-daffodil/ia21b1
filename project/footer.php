<div class="container-fluid mt-5">

  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-white row"
          style="background-color: #1c2331"
          >
    <!-- Section: Social media -->
    <section
             class="d-flex justify-content-between p-4"
             style="background-color: #6351ce"
             >
      <!-- Left -->
      <div class="me-5">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">Company name</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              Here you can use rows and columns to organize your footer
              content. Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Products</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-white">MDBootstrap</a>
            </p>
            <p>
              <a href="#!" class="text-white">MDWordPress</a>
            </p>
            <p>
              <a href="#!" class="text-white">BrandFlow</a>
            </p>
            <p>
              <a href="#!" class="text-white">Bootstrap Angular</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Useful links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-white">Your Account</a>
            </p>
            <p>
              <a href="#!" class="text-white">Become an Affiliate</a>
            </p>
            <p>
              <a href="#!" class="text-white">Shipping Rates</a>
            </p>
            <p>
              <a href="#!" class="text-white">Help</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
            <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/"
         >MDBootstrap.com</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Function to parse cart items
        function parseCartItems(cart) {
            for (var key in cart) {
                if (typeof cart[key] === 'string') {
                    cart[key] = JSON.parse(cart[key]);
                }
            }
        }

        // Function to update cart count, product list, and checkout button
        function updateCartDisplay() {
            var cart = JSON.parse(sessionStorage.getItem('cart')) || {};
            parseCartItems(cart);

            var count = Object.values(cart).reduce((sum, item) => sum + item.count, 0);
            $('#cartCount').text(count);

            var proList = $('#proList').html('');
            $.each(cart, function(key, item) {
                proList.append(`
                    <div class="d-flex align-items-center mb-2 border-bottom py-1">
                        <img src="./assets/images/products/${item.image}" class="img-fluid" style="height: 50px; object-fit: contain">
                        <div class="ms-2">
                            ${item.name}
                        </div>
                        <div class="ms-2">
                            ${item.count} x BDT${item.discount_price}
                        </div>
                        <button class="btn btn-danger btn-sm ms-2 deleteProduct" data-pid="${key}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `);
            });

            // Attach click event to delete buttons
            $('.deleteProduct').click(function() {
                var pid = $(this).data('pid');
                delete cart[pid];
                sessionStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay(); // Refresh the cart display
            });

            // Checkout button logic
            var checkoutBtn = $('#checkoutBtnContainer');
            if (count > 0) {
                if (checkoutBtn.length === 0) {
                    $('#proList').append(`
                        <div id="checkoutBtnContainer" class="mt-3 text-end">
                            <button id="checkoutBtn" class="btn btn-success">Proceed to Checkout</button>
                        </div>
                    `);
                }
            } else {
                checkoutBtn.remove(); // Remove checkout button if cart is empty
            }
        }

        // Initial update on page load
        updateCartDisplay();

        // On Add to Cart button click
        $('.addCart').click(function() {
            var pid = $(this).data('pid');
            toastr.success('Product added to cart');

            $.post('./ajax/cartBackend.php', { addCart: 123, pid: pid }, function(data) {
                var cart = JSON.parse(sessionStorage.getItem('cart')) || {};
                parseCartItems(cart);

                var responseData = typeof data === 'object' ? data : JSON.parse(data);

                if (!cart[pid]) {
                    cart[pid] = { ...responseData, count: 1 };
                } else {
                    cart[pid].count++;
                }

                sessionStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            });
        });

        $('#checkoutBtn').click(function() {
            window.location.href = './checkout.php';
        });
    });
</script>
</body>
</html>