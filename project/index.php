<?php  
    require_once 'header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0 position-relative d-none d-lg-block">
                <img src="./assets/images/banner.jpg" class="img-fluid" alt="">
                <div class="w-50 position-absolute top-50 start-0 p-5 rounded shadow translate-middle-y ms-5" style="background: rgba(0,0,0,0.6);">
                    <h1 class="text-white">Welcome to our website</h1>
                    <p class="text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero minima inventore cumque reiciendis cupiditate similique quisquam harum, esse temporibus. Porro facere reiciendis ullam voluptatibus, nam, aliquam, earum beatae qui repudiandae obcaecati esse aperiam exercitationem numquam magni voluptatum accusamus eveniet magnam? Nisi distinctio voluptatibus magni rem, dolores esse iste nemo dolor soluta in necessitatibus quae mollitia labore numquam iure optio eveniet.</p>
                    <button class="btn btn-primary btn-lg rounded-pill">Read more</button>
                </div>
            </div>
        </div>
    </div>

    <!-- show latest products -->
    <div class="container mt-5">
        <h2 class="text-center">Latest Products</h2>
        <div class="row">
            <?php
                $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="col-md-3 p-2">
                <div class="card shadow">
                    <img src="./assets/images/products/<?php echo $row['image']; ?>" class="card-img-top p-2" alt="..." style="height: 180px; object-fit: contain">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <!-- regular_price and discount_price -->
                        <p>
                            <span class="text-decoration-line-through me-2 text-muted">BDT<?php echo $row['regular_price']; ?></span>
                            <span class="text-danger">BDT<?php echo $row['discount_price']; ?></span>
                        </p>
                        <!-- add to cart & view button with fontawesome icon -->
                        <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View <i class="fas fa-eye"></i></a>
                        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Add to cart <i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php  
    require_once 'footer.php';
?>
    