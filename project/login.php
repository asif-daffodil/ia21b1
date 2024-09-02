<?php  
    require_once 'header.php';
    if(isset($_SESSION['user'])){
        header('location: ./');
    }
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['user'] = ["id" => $row['id'], "name" => $row['name'], "email" => $row['email'], "image" => $row['image']];
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
                        <button type="submit" class="btn btn-primary" name="login">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php  
    require_once 'footer.php';
?>