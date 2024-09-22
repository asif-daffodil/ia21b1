<?php
require_once "./header.php";
if (isset($_POST['addCat'])) {
    $category = $_POST['category'];
    $sql = "INSERT INTO categories (`name`) VALUES ('$category')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>toastr.success('Category added successfully')</script>";
    } else {
        echo "<script>toastr.error('Failed to add category')</script>";
    }
}

$pageNumber = isset($_GET['page']) ? $_GET['page'] : null;
if ($pageNumber === null) {
    echo "<script>location.href='products-categories.php?page=1'</script>";
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
        <?php if (!isset($_GET['editId']) && !isset($_GET['deleteId'])) { ?>
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
                                <th>SN</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $limit = 5;
                            $offset = ($pageNumber - 1) * $limit;

                            $sql = "SELECT * FROM categories";
                            $selectAll = $conn->query($sql);

                            $totalPages = ceil($selectAll->num_rows / $limit);

                            $sql = "SELECT * FROM categories ORDER BY `id` DESC LIMIT $offset, $limit";
                            $result = $conn->query($sql);

                            $sn = $offset + 1;
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $sn++ ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>
                                            <a href="./products-categories.php?page=<?= $pageNumber ?>&editId=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="./products-categories.php?page=<?= $pageNumber ?>&deleteId=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= $pageNumber != 1 ? null : "disabled" ?>"><a class="page-link" href="./products-categories.php?page=<?= $pageNumber != 1 ? $pageNumber - 1 : 1 ?>">Previous</a></li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?= $i == $pageNumber ? "active" : null ?>"><a class="page-link" href="./products-categories.php?page=<?= $i; ?>"><?= $i ?></a></li>
                            <?php } ?>
                            <li class="page-item <?= $pageNumber != $totalPages ? null : "disabled" ?>"><a class="page-link" href="./products-categories.php?page=<?= $pageNumber != $totalPages ? $pageNumber + 1 : $totalPages ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } ?>
        <?php
        if (isset($_POST['editCat'])) {
            $category = $_POST['category'];
            $editId = $_GET['editId'];
            $sql = "UPDATE categories SET `name` = '$category' WHERE id = $editId";
            $result = $conn->query($sql);
            if ($result) {
                echo "<script>toastr.success('Category updated successfully');setTimeout(()=> location.href='products-categories.php?page=" . $pageNumber . "', 2000)</script>";
            } else {
                echo "<script>toastr.error('Failed to update category')</script>";
            }
        }
        if (isset($_GET['editId'])) {
            $editId = $_GET['editId'];
            $sql = "SELECT * FROM categories WHERE id = $editId";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>
            <div class="row">
                <div class="col-md-4">
                    <h2 class="">Edit Category</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="category" name="category" value="<?= $row['name'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="editCat">Edit Category</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        <?php 
        if(isset($_POST['deleteCat'])){
            $deleteId = $_GET['deleteId'];
            $sql = "DELETE FROM categories WHERE id = $deleteId";
            $result = $conn->query($sql);
            if($result){
                echo "<script>toastr.success('Category deleted successfully');setTimeout(()=> location.href='products-categories.php?page=" . $pageNumber . "', 2000)</script>";
            }else{
                echo "<script>toastr.error('Failed to delete category')</script>";
            }
        }
            if(isset($_GET['deleteId'])){
                $deleteId = $_GET['deleteId'];
                $sql = "SELECT * FROM categories WHERE id = $deleteId";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
        ?>
            <div class="row">
                <div class="col-md-4">
                    <h2 class="">Do you really want to delete the category : <?= $row['name'] ?> ?</h2>
                    <form action="" method="post" style="display: inline;">
                        <button type="submit" class="btn btn-danger" name="deleteCat">Yes</button>
                    </form>
                    <a class="btn btn-success" href="products-categories.php?page=<?= $pageNumber ?>">No</a>
                </div>
            </div>
        <?php }} ?>
    </div>
</div>

<?php require_once "./footer.php" ?>