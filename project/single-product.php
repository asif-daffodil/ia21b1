<?php 
require_once './header.php';
require_once './navbar.php';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // Fetch product information along with category and brand from the database
    $query = "SELECT p.*, c.name AS category_name, b.name AS brand_name 
              FROM products p
              JOIN categories c ON p.category_id = c.id
              JOIN brands b ON p.brand_id = b.id
              WHERE p.id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}

// Set image path
$image_path = "./assets/images/products/" . htmlspecialchars($product['image']);

// If image doesn't exist, set a default placeholder image
if (!file_exists($image_path)) {
    $image_path = "./assets/images/products/default-placeholder.png"; // Default image
}
?>

<link rel="stylesheet" href="./common-css.css">
<div class="container mt-5">
    <div class="card shadow-lg rounded-lg">
        <div class="row no-gutters">
            <div class="col-md-5 image-container">
                <img src="<?php echo $image_path; ?>" class="card-img img-fluid rounded-start product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>

            <div class="col-md-7">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="card-title mb-4" style="font-weight: 600; color: #343a40;">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h2>
                        <p class="card-text text-muted" style="font-size: 1.1rem;">
                            <?php echo htmlspecialchars_decode($product['short_description']); ?>
                        </p>

                        <!-- Display Category and Brand -->
                        <p class="mt-3"><strong>Category:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>
                        <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand_name']); ?></p>
                    </div>

                    <!-- Enhanced Price Section -->
                    <div class="mt-4 price-section">
                        <!-- Discount Price -->
                        <h4 class="discount-price text-danger" style="font-weight: 700;">
                            ৳<?php echo htmlspecialchars($product['discount_price']); ?>
                        </h4>

                        <!-- Regular Price with a Badge for Discount -->
                        <p class="regular-price" style="font-size: 1.2rem;">
                            <span class="text-muted" style="text-decoration: line-through;">
                                ৳<?php echo htmlspecialchars($product['regular_price']); ?>
                            </span>
                            <span class="badge badge-danger ml-2" style="font-size: 1rem;">
                                <?php
                                $discount_percentage = 100 - ($product['discount_price'] / $product['regular_price']) * 100;
                                echo round($discount_percentage) . '% OFF';
                                ?>
                            </span>
                        </p>

                        <!-- Taxes Note -->
                        <p class="text-muted small">
                            (Inclusive of all taxes)
                        </p>
                    </div>

                    <!-- Add to Cart Button with Font Awesome Icon -->
                    <a href="javascript:void(0)" class="btn btn-gradient btn-lg btn-block mt-4 addCart" data-pid="<?= $product['id']; ?>>
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </>
                    
                    <!-- Back Button -->
                    <a href="javascript:history.back()" class="btn btn-gradient-back btn-lg btn-block mt-3">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php'; ?>

<!-- Styling for the enhanced buttons and price section -->
<style>
.btn-gradient {
    background: linear-gradient(45deg, #ff416c, #ff4b2b); /* Brighter, eye-catching gradient */
    color: white;
    font-weight: bold;
    border: none;
    padding: 12px 20px;
    font-size: 1.2rem;
    transition: background 0.3s ease-in-out, transform 0.2s;
    box-shadow: 0 4px 15px rgba(255, 65, 108, 0.4);
    border-radius: 8px;
}

.btn-gradient:hover {
    background: linear-gradient(45deg, #ff4b2b, #ff416c); /* Reverse the gradient for hover effect */
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(255, 65, 108, 0.6);
}

/* Back Button with cool blue gradient */
.btn-gradient-back {
    background: linear-gradient(45deg, #36d1dc, #5b86e5); /* Blue gradient */
    color: white;
    font-weight: 500;
    border: none;
    padding: 12px 20px;
    font-size: 1.1rem;
    transition: background 0.3s ease-in-out, transform 0.2s;
    box-shadow: 0 4px 15px rgba(91, 134, 229, 0.4);
    border-radius: 8px;
}

.btn-gradient-back:hover {
    background: linear-gradient(45deg, #5b86e5, #36d1dc); /* Reverse the gradient for hover effect */
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(91, 134, 229, 0.6);
}

/* Button Icons */
.btn i {
    margin-right: 10px;
}

/* Image Container Styling */
.image-container {
    overflow: hidden; /* Hide overflow for zoom effect */
    height: 100%; /* Ensure the image container fills the column */
}

.product-image {
    width: 100%; /* Fill the width of the container */
    height: 100%; /* Fill the height of the container */
    object-fit: cover; /* Maintain aspect ratio and cover the area */
    transition: transform 0.5s ease; /* Smooth transition for zoom effect */
}

.image-container:hover .product-image {
    transform: scale(1.1); /* Zoom in on hover */
}

/* General Styling */
.container {
    max-width: 1080px;
}

/* Price Section Styling */
.price-section .discount-price {
    font-size: 2rem;
    color: #e74c3c;
    font-weight: 700;
}

.price-section .regular-price {
    font-size: 1.2rem;
}

.price-section .badge-danger {
    background-color: #e74c3c;
    padding: 5px 10px;
    font-size: 0.9rem;
    border-radius: 5px;
}
</style>
