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
                        <h5 class="card-title" style="display: inline-block; max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $row['name']; ?></h5>
                        <!-- regular_price and discount_price -->
                        <p>
                            <span class="text-decoration-line-through me-2 text-muted">BDT<?php echo $row['regular_price']; ?></span>
                            <span class="text-danger">BDT<?php echo $row['discount_price']; ?></span>
                        </p>
                        <!-- add to cart & view button with fontawesome icon -->
                        <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View <i class="fas fa-eye"></i></a>
                        <button class="btn btn-success btn-sm addCart" data-pid="<?= $row['id']; ?>" >Add to cart <i class="fas fa-shopping-cart"></i></button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script>
        // cartCount
        // proList
        $(document).ready(function(){
            $('.addCart').click(function(){
                var pid = $(this).data('pid');
                toastr.success('Product added to cart');
                $.post('./ajax/cartBackend.php', {addCart: 123, pid: pid}, function(data){
                    // response = {"id":"20","name":"President Waterproof Fashionable Backpack Nylon Black PBL810","regular_price":"2000","discount_price":"1690","image":"1727722537_Bag.jpg","short_description":"<p><strong>Lorem Ipsum<\/strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<\/p>\r\n","category_id":"34","brand_id":"17","created_at":"2024-10-01 00:55:37"}
                    // set data into  session storage with count by id
                    var cart = JSON.parse(sessionStorage.getItem('cart'));
                    if(cart == null){
                        cart = {};
                    }
                    if(cart[pid] == undefined){
                        cart[pid] = data;
                        cart[pid].count = 1;
                    }else{
                        cart[pid].count++;
                    }
                    sessionStorage.setItem('cart', JSON.stringify(cart));
                    // set cartCount
                    var count = 0;
                    for(var key in cart){
                        count += cart[key].count;
                    }
                    $('#cartCount').text(count);

                    // set proList
                    var proList = $('#proList');
                    proList.html('');
                    for(var key in cart){
                        proList.append(`
                            <div class="d-flex mb-2">
                                <img src="./assets/images/products/${cart[key].image}" class="img-fluid" style="height: 50px; object-fit: contain">
                                <div class="ms-2">
                                    <p class="mb-0">${cart[key].name}</p>
                                    <p class="mb-0">BDT${cart[key].discount_price} x ${cart[key].count}</p>
                                </div>
                            </div>
                        `);
                    }
                });
            });
        });
    </script>
<?php  
    require_once 'footer.php';
?>
    