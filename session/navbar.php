<a href="./index.php"><button>Home</button></a>
<?php  
    if (!isset($_SESSION['uname'])) {
?>
<a href="./login.php"><button>Login</button></a>
<?php }else{ ?>
<a href="./logout.php"><button>Logout</button></a>
<?php } ?>