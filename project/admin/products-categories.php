<?php  
    require_once "./header.php";
    if(isset($_POST['addCat'])){
        $category = $_POST['category'];
        $sql = "INSERT INTO categories (`name`) VALUES ('$category')";
        $result = $conn->query($sql);
        if($result){
            echo "<script>toastr.success('Category added successfully')</script>";
        }else{
            echo "<script>toastr.error('Failed to add category')</script>";
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
        $breadcomb = "Products Categories";
        require_once "./top-header.php"; 
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="">Add Category</h2>
                    <form action="" method="post">
                        <div class="form-group-inner">
                            <input type="text" class="form-control" id="category" name="category" placeholder="Category name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="addCat">Add Category</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <h2 class="">Categories</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
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
    </div>
    
    <?php require_once "./footer.php" ?>