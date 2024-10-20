<?php  
    require_once "./header.php";
?>

    <?php require_once "./sidebar.php" ?>
    <!-- Start Welcome area -->
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
        <?php require_once "./top-header.php" ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="alert alert-success">
                        <?php  
                            // total products
                            $sql = "SELECT COUNT(id) as total_products FROM products";
                            $result = mysqli_query($conn, $sql);
                            $total_products = mysqli_fetch_assoc($result)['total_products'];
                            echo "<h1>Total Products</h1> <h5>- $total_products</h5>";
                        ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-info">
                        <?php  
                            // total categories
                            $sql = "SELECT COUNT(id) as total_categories FROM categories";
                            $result = mysqli_query($conn, $sql);
                            $total_categories = mysqli_fetch_assoc($result)['total_categories'];
                            echo "<h1>Total Categories</h1> <h5>- $total_categories</h5>";
                        ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-warning">
                        <?php  
                            // total brands
                            $sql = "SELECT COUNT(id) as total_brands FROM brands";
                            $result = mysqli_query($conn, $sql);
                            $total_brands = mysqli_fetch_assoc($result)['total_brands'];
                            echo "<h1>Total Brands</h1> <h5>- $total_brands</h5>";
                        ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-danger">
                        <?php  
                            // total orders
                            $sql = "SELECT COUNT(id) as total_orders FROM orders";
                            $result = mysqli_query($conn, $sql);
                            $total_orders = mysqli_fetch_assoc($result)['total_orders'];
                            echo "<h1>Total Orders</h1> <h5>- $total_orders</h5>";
                        ?>
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-12">
                    <iframe src="../index.php" frameborder="0" style="width: 100%; height: 400px"></iframe>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once "./footer.php" ?>