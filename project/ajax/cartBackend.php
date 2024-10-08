<?php  
    $conn = mysqli_connect('localhost', 'root', '', 'ecommerce-1');

    if($_POST['addCart'] && $_POST['addCart'] == 123) {
        $pid = $_POST['pid'];
        $getProduct = $conn->query("SELECT * FROM products WHERE id = '$pid'")->fetch_assoc();
        echo json_encode($getProduct);
    }
?>