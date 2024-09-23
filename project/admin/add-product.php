<?php
require_once "./header.php";
?>
<!-- ckeditor 4 cdn -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<style>
    .cke_notification_warning{
        display: none !important;
    }
</style>

<?php require_once "./sidebar.php" ?>

<?php  
    if(isset($_POST['addProduct'])){
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $regular_price = $_POST['regular_price'];
        $discount_price = $_POST['discount_price'];
        $short_description = $_POST['short_description'];
        $brand_id = $_POST['brand_id'];
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $new_image = time()."_".$image;
        $path = "../assets/images/products/".$new_image;
        // check the file is image or not
        $file_type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif"){
            echo "<script>toastr.error('Image format is not valid')</script>";
        }else{
            $sql = "INSERT INTO products (`name`, `category_id`, `regular_price`, `discount_price`, `short_description`, `brand_id`, `image`) VALUES ('$name', $category_id, $regular_price, $discount_price, '$short_description', $brand_id, '$new_image')";
            $result = $conn->query($sql);
            if($result){
                move_uploaded_file($tmp_name, $path);
                echo "<script>toastr.success('Product added successfully')</script>";
            }else{
                echo "<script>toastr.error('Failed to add product')</script>";
            }
        }
    }
?>
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
    $breadcomb = "Add New Products";
    require_once "./top-header.php";
    ?>
    <div class="container" style="color: white">
        <div class="row">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-4">
                    <div class="form-group-inner">
                        <input type="text" name="name" class="form-control" placeholder="Product Name">
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
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-inner">
                        <input type="text" name="regular_price" class="form-control" placeholder="Regular Price">
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
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-inner">
                        <input type="text" name="discount_price" class="form-control" placeholder="Discount Price">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group-inner">
                        <textarea name="short_description" id="example">
                            Short Description
                        </textarea>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <label for="image">
                        <img src="../assets/images/image_thumbnail.png" alt="" class="img-fluid" style="width:200px; height:200px; object-fit:cover; margin-bottom: 20px;">
                        <h4>Featured Image</h4>
                        <input type="file" name="image" id="image" style="display: none;">
                    </label>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('example');
</script>

<?php require_once "./footer.php" ?>