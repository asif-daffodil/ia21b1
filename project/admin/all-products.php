<?php require_once "./header.php" ?>
<?php require_once "./sidebar.php" ?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>

<!-- ckeditor 4 cdn -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<style>
    .cke_notification_warning {
        display: none !important;
    }
</style>

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
    <?php
    $breadcome = isset($_GET["eid"]) ? "Update Product" : "All Products";
    require_once "./top-header.php";
    ?>
    <?php
    if (isset($_POST['updateProduct'])) {
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $regular_price = $_POST['regular_price'];
        $discount_price = $_POST['discount_price'];
        $short_description = $_POST['short_description'];
        $brand_id = $_POST['brand_id'];
        $eid = $_POST['eid'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        if (empty($image)) {
            $sql = "UPDATE products SET `name` = '$name', `category_id` = $category_id, `regular_price` = $regular_price, `discount_price` = $discount_price, `short_description` = '$short_description', `brand_id` = $brand_id WHERE id = $eid";
            $result = $conn->query($sql);
            if ($result) {
                echo "<script>
                        toastr.success('Product updated successfully');
                        setTimeout(() => {
                            window.location.href = 'all-products.php';
                        }, 2000);
                      </script>";
            } else {
                echo "<script>toastr.error('Failed to update product')</script>";
            }
        } else {
            $new_image = time() . "_" . $image;
            $path = "../assets/images/products/" . $new_image;
            // check the file is image or not
            $file_type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
                echo "<script>toastr.error('Image format is not valid')</script>";
            } else {
                $sql = "UPDATE products SET `name` = '$name', `category_id` = $category_id, `regular_price` = $regular_price, `discount_price` = $discount_price, `short_description` = '$short_description', `brand_id` = $brand_id, `image` = '$new_image' WHERE id = $eid";
                $result = $conn->query($sql);
                if ($result) {
                    move_uploaded_file($tmp_name, $path);
                    echo "<script>
                        toastr.success('Product updated successfully');
                        setTimeout(() => {
                            window.location.href = 'all-products.php';
                        }, 2000);
                      </script>";
                } else {
                    echo "<script>toastr.error('Failed to update product')</script>";
                }
            }
        }
    }
    ?>
    <?php if (!isset($_GET["eid"])) { ?>
        <div class="container">
            <div class="row" style="background: #fff; padding: 20px 0">
                <div class="col-md-12">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Regular Price</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $products = $conn->query("SELECT p.*, b.name as brand_name, c.name as category_name FROM `products` p 
                                                          JOIN `brands` b ON p.brand_id = b.id 
                                                          JOIN `categories` c ON p.category_id = c.id 
                                                          ORDER BY p.id DESC");
                            if ($products->num_rows > 0) {
                                while ($product = $products->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $product['name'] ?></td>
                                        <td><?= $product['category_name'] ?></td>
                                        <td><?= $product['brand_name'] ?></td>
                                        <td><?= $product['regular_price'] ?></td>
                                        <td><img src="../assets/images/products/<?= $product['image'] ?>" alt="" style="width: 50px; height: 50px; object-fit: contain;"></td>
                                        <td>
                                            <a href="all-products.php?eid=<?= $product['id'] ?>" class="btn btn-primary">Edit</a>
                                            <button data-did="<?= $product['id'] ?>" class="btn btn-danger delBtn">Delete</button>
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
    <?php } else {
        // get products info by eid
        $eid = $_GET["eid"];
        $product = $conn->query("SELECT * FROM products WHERE id = $eid")->fetch_assoc();
    ?>
        <div class="container">
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <div class="form-group-inner">
                            <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?= $product['name'] ?>">
                        </div>
                        <div class="form-group">
                            <select name="category_id" id="category_id" class="form-control" style="border: 1px solid #fff">
                                <option value="">Select Category</option>
                                <?php
                                $sql = "SELECT * FROM categories";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row['id'] ?>" <?= $row['id'] == $product['category_id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="eid" value="<?= $_GET['eid'] ?>">
                    <div class="col-md-4">
                        <div class="form-group-inner">
                            <input type="text" name="regular_price" class="form-control" placeholder="Regular Price" value="<?= $product['regular_price'] ?>">
                        </div>
                        <!-- brands -->
                        <div class="form-group">
                            <select name="brand_id" id="brand_id" class="form-control" style="border: 1px solid #fff">
                                <option value="">Select Brand</option>
                                <?php
                                $sql = "SELECT * FROM brands";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row['id'] ?>" <?= $row['id'] == $product['brand_id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-inner">
                            <input type="text" name="discount_price" class="form-control" placeholder="Discount Price" value="<?= $product['discount_price'] ?>">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group-inner">
                            <textarea name="short_description" id="editProduct"><?= $product['short_description'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <label for="image">
                            <img src="../assets/images/products/<?= $product['image'] ?>" alt="" class="img-fluid" style="width:200px; height:200px; object-fit:contain; margin-bottom: 20px;" id="showImage">
                            <h4 style="color: #fff;"> Featured Image</h4>
                            <input type="file" name="image" id="image" style="display: none;">
                        </label>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="updateProduct">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Delete Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Do you really want to delete the product <span id="productName"></span>?</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger" id="yesBtn" data-did="">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "lengthMenu": [5, 10, 25, 50]
        });
        $(document).on('click', '.delBtn', function() {
            const gpd = $(this).attr('data-did');
            $.post({
                url: "ajax/getProductDetails.php",
                data: {
                    gpd: gpd
                },
                success: function(data) {
                    let product = JSON.parse(data);
                    $("#productName").html(product.name);
                }
            });
            $("#yesBtn").attr("data-did", gpd);
            $("#myModal").modal("show");
        });

        $(document).on("click", "#yesBtn", function() {
            let did = $(this).data("did");
            $.post({
                url: "ajax/getProductDetails.php",
                data: {
                    did: did
                },
                success: function(data) {
                    if (data === "success") {
                        toastr.success("Product deleted successfully");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error("Failed to delete product");
                    }
                }
            });
        });
    });
</script>
<script>
    CKEDITOR.replace('editProduct');
</script>
<script>
    document.getElementById('image').addEventListener('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('showImage').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(file);
    });
</script>
<?php require_once "./footer.php" ?>