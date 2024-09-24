<?php
require_once "./header.php";
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
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


<?php require_once "./footer.php" ?>