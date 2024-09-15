<?php
require_once "./header.php";

if (isset($_POST['addBrand'])) {
    $brand = $_POST['brand'];
    $sql = "INSERT INTO brands (`name`) VALUES ('$brand')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>toastr.success('Brand added successfully')</script>";
    } else {
        echo "<script>toastr.error('Failed to add brand')</script>";
    }
}
?>

<?php require_once "./sidebar.php" ?>
<!-- Start Welcome area -->
<div class="all-content-wrapper" style="color: white;">
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
    $breadcomb = "Products Brands";
    require_once "./top-header.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h2 class="">Add Brands</h2>
                <form action="" method="post">
                    <div class="form-group-inner">
                        <input type="text" class="form-control" name="brand" placeholder="Brand name">
                    </div>
                    <button type="submit" class="btn btn-primary" name="addBrand">Add Brand</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "./footer.php" ?>