<?php  
    require_once 'header.php';
    if(isset($_SESSION['user']) && $_SESSION['user']['token'] = "ia21b1"){
        header('location: ./');
    }
    if(isset($_POST['login'])){
        $email = $conn->real_escape_string(safeData($_POST['email']));
        $password = $conn->real_escape_string(safeData($_POST['password']));
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<script>toastr.error('invalid email')</script>";
            exit();
        }
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $row['token'] = "ia21b1";
                $_SESSION['user'] = $row;
                echo "<script>toastr.success('user logged in successfully'); setTimeout(()=>{location.href='./'}, 2000)</script>";
            }else{
                echo "<script>toastr.error('password did not matched')</script>";
            }
        }else{
            echo "<script>toastr.error('user not found')</script>";
        }
    }
?>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-4 m-auto border rounded shadow p-4">
                <h1>Log in</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="showPassword" class="form-check-input">
                        <label for="showPassword" class="form-check-label">Show Password</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="login">Log in</button>
                    </div>
                </form>
                <!-- register link -->
                <small>Don't have an account? <a href="./register.php" class="">Register</a></small>
            </div>
        </div>
    </div>
    <script>
        const showPassword = document.querySelector('#showPassword');
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="confirmPassword"]');
        showPassword.addEventListener('change', ()=>{
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