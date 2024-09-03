<?php  
    require_once 'header.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['token'] != "ia21b1"){
        header('location: ./login.php');
    }
?>
    <h1>Hello, world!</h1>
<?php  
    require_once 'footer.php';
?>