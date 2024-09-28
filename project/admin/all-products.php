<?php
require_once "./header.php";
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<style>
    .cke_notification {
        display: none !important;
    }
    .form-group-inner {
        margin-bottom: 0;
    }
</style>

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
    $breadcomb = "All Products";
    require_once "./top-header.php";
    ?>
    <div class="container">
        <?php
        if (!isset($_GET['eid']) && !isset($_GET['did'])) {
        ?>
            <div class="row" style="background: white; padding: 20px 0px">
                <div class="col-md-12">
                    <table id="example" class="table display" style="width:100%">
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
                            $sql = "SELECT products.*, categories.name as category_name, brands.name as brand_name FROM products
                            JOIN categories ON products.category_id = categories.id
                            JOIN brands ON products.brand_id = brands.id";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['category_name'] ?></td>
                                        <td><?php echo $row['brand_name'] ?></td>
                                        <td><?php echo $row['regular_price'] ?></td>
                                        <td><img src="../assets/images/products/<?php echo $row['image'] ?>" alt="" style="width: 50px; height: 50px"></td>
                                        <td>
                                            <a href="all-products.php?eid=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                                            <button class="btn btn-danger btndid" data-did="<?= $row['id'] ?>">Delete</button>
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
        <?php } ?>
        
        <?php
        if (isset($_GET['eid'])) {
            $eid = $_GET['eid'];
            $sql = "SELECT * FROM products WHERE id = $eid";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <style>
            .form-control{
                outline: 1px solid white;
            }
            label{
                color: white;
            }

        </style>
            <div class="row" style="padding: 20px 0px">
                <div class="col-md-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php
                                $category_sql = "SELECT * FROM categories";
                                $category_result = $conn->query($category_sql);
                                if ($category_result->num_rows > 0) {
                                    while ($category_row = $category_result->fetch_assoc()) {
                                        $selected = $category_row['id'] == $row['category_id'] ? 'selected' : '';
                                        echo "<option value='{$category_row['id']}' $selected>{$category_row['name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select  name="brand_id" class="form-control" required>
                                <option  value="">Select Brand</option>
                                <?php
                                $brand_sql = "SELECT * FROM brands";
                                $brand_result = $conn->query($brand_sql);
                                if ($brand_result->num_rows > 0) {
                                    while ($brand_row = $brand_result->fetch_assoc()) {
                                        $selected = $brand_row['id'] == $row['brand_id'] ? 'selected' : '';
                                        echo "<option value='{$brand_row['id']}' $selected>{$brand_row['name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Regular Price</label>
                            <input type="text" name="regular_price" class="form-control" value="<?php echo $row['regular_price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" class="form-control" required><?php echo $row['short_description']; ?></textarea>
                            <script>
                                CKEDITOR.replace('short_description');
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="../assets/images/products/<?php echo $row['image']; ?>" alt="" style="width: 100px; height: 100px; margin-top: 10px;">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="updateProduct" class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php 
            }
        }

        if (isset($_POST['updateProduct'])) {
            $product_id = $_POST['product_id'];
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $brand_id = $_POST['brand_id'];
            $regular_price = $_POST['regular_price'];
            $short_description = $_POST['short_description'];

            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $target = "../assets/images/products/" . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            } else {
                $image = $row['image'];
            }

            $update_sql = "UPDATE products SET name='$name', category_id='$category_id', brand_id='$brand_id', regular_price='$regular_price', short_description='$short_description', image='$image' WHERE id='$product_id'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<script>toastr.success('Product updated successfully');setTimeout(()=> 1000)</script>";
            } else {
                echo "<script>toastr.error('Error updating product: " . $conn->error . "');</script>";
            }
        }
        ?>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Do you really want to delete the product <span id="productName"></span>?</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger" id="yesBtn" data-did="" >Yes</button>
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

    // Use event delegation for dynamic elements
    $(document).on("click", ".btndid", function() {
        let gpd = $(this).data("did");
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
            url: "ajax/getProductDetails.php", // Correct endpoint for deletion
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
