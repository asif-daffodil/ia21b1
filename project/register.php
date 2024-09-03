<?php  
    require_once 'header.php';
    if(isset($_SESSION['user']) && $_SESSION['user']['token'] = "ia21b1"){
        header('location: ./');
    }
    if(isset($_POST['signUp'])){
        $yourName = $conn->real_escape_string(safeData($_POST['yourName']));
        $email = $conn->real_escape_string(safeData($_POST['email']));
        $password = $conn->real_escape_string(safeData($_POST['password']));
        $confirmPassword = $conn->real_escape_string(safeData($_POST['confirmPassword']));
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
                        <input type="checkbox" id="showPassword" class="form-check-input">
                        <label for="showPassword" class="form-check-label">Show Password</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="signUp">Sign Up</button>
                    </div>
                </form>
                <!-- login link -->
                <small>Already have an account? <a href="./login.php" class="">Log in</a></small>
            </div>
        </div>
    </div>
    <script>
        const showPassword = document.querySelector('#showPassword');
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="confirmPassword"]');

        showPassword.addEventListener('click', () => {
            if(showPassword.checked){
                password.type = "text";
                confirmPassword.type = "text";
            }else{
                password.type = "password";
                confirmPassword.type = "password";
            }
        });
    </script>
<?php  
    require_once 'footer.php';
?>