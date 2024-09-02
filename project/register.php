<?php  
    require_once 'header.php';
    if(isset($_SESSION['user'])){
        header('location: ./');
    }
    if(isset($_POST['signUp'])){
        $yourName = $_POST['yourName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if($password == $confirmPassword){
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$yourName', '$email', '$password')";
            if($conn->query($sql) === TRUE){
                echo "<script>toastr.success('user registered successfully'); setTimeout(()=>{location.href='./login.php'}, 2000)</script>";
            }else{
                echo "<script>toastr.error('Something went wrong')</script>";
            }
        }else{
            echo "<script>toastr.error('password did not matched')</script>";
        }
    }
?>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-4 m-auto border rounded shadow p-4">
                <h1>Register</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username">Your Name</label>
                        <input type="text" name="yourName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="signUp">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php  
    require_once 'footer.php';
?>