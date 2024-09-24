<?php 
    $conn = mysqli_connect("localhost", "root", "", "ecommerce-1");
    if(isset($_POST['gpd'])){
       $productData = $conn->query("SELECT * FROM products WHERE id = ".$_POST['gpd'])->fetch_assoc();
        echo json_encode($productData);
    }

    if(isset($_POST['did'])){
        $preData = $conn->query("SELECT * FROM products WHERE id = ".$_POST['did'])->fetch_assoc();
        if($conn->query("DELETE FROM products WHERE id = ".$_POST['did'])){
            unlink("../../assets/images/products/".$preData['image']);
            echo "success";
        }else{
            echo "failed";
        }
    }
?>