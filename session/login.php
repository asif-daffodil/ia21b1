<?php  
    session_start();

    if(isset($_SESSION['uname'])){
        header('Location: index.php');
    }

    if(isset($_POST['login'])){
        $_SESSION['uname'] = $_POST['uname'];
        setcookie("loginTime", date("Y-m-d H:i:s"), time() + 60);
        header('Location: index.php');
    }

    require_once 'navbar.php';

?>
<br><br>
<form action="" method="post">
    <input type="text" placeholder="Your name" name="uname" required>
    <button type="submit" name="login">Log in</button>
</form>