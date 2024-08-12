<?php  
    session_start();
    if(!isset($_SESSION['uname'])) {
        header('Location: login.php');
    }
    require_once 'navbar.php';
    if(isset($_COOKIE['loginTime'])){
        echo "You last logged in at: ".$_COOKIE['loginTime'];
    }else{
        header('Location: logout.php');
    }

    $comIfo = [
        "name" => "Toto Company",
        "address" => "Shara Prithibi",
        "phone" => "01742042042",
    ];
    echo "<br>";
    echo json_encode($comIfo);
    echo "<br>";
    print_r(json_decode('{"name":"Toto Company","address":"Shara Prithibi","phone":"01742042042"}', true));
?>
<br><br>
<h1>
    Welcome <?= $_SESSION['uname'] ?>
</h1>

<script>
    const comInfo = {
        name: "Toto Company",
        address: "Shara Prithibi",
        phone: "01742042042",
    }
</script>
