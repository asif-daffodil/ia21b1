<?php  
    require_once 'header.php';
    if(isset($_POST['forgetPassword'])){
        $email = $conn->real_escape_string(safeData($_POST['email']));
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $token = md5($row['email'].time());
            $sql = "UPDATE `users` SET `token` = '$token' WHERE `id` = ".$row['id'];
            if($conn->query($sql)){
                $to = $row['email'];
                $subject = "Forget Password";
                $message = "Click on the link to reset your password: <a href='http://localhost/ia21b1/project/forget-password.php?token=$token'>Reset Password</a>";
                $headers = "From: asif@dti.ac";
                mail($to, $subject, $message, $headers);
                echo "<script>toastr.success('email sent successfully')</script>";
            }else{
                echo "<script>toastr.error('something went wrong')</script>";
            }
        }else{
            echo "<script>toastr.error('email not found')</script>";
        }
    }

    if(isset($_GET['token'])){
        $token = $conn->real_escape_string(safeData($_GET['token']));
        $sql = "SELECT * FROM `users` WHERE `token` = '$token'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['forgetPassword'] = $row;
        }else{
            echo "<script>toastr.error('invalid token')</script>";
        }
    }

    if(isset($_POST['resetPassword'])){
        $newPassword = $conn->real_escape_string(safeData($_POST['newPassword']));
        $confirmPassword = $conn->real_escape_string(safeData($_POST['confirmPassword']));
        if($newPassword != $confirmPassword){
            echo "<script>toastr.error('password did not matched')</script>";
        }else{
            $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $sql = "UPDATE `users` SET `password` = '$newPassword', `token` = '' WHERE `id` = ".$_SESSION['forgetPassword']['id'];
            if($conn->query($sql)){
                unset($_SESSION['forgetPassword']);
                echo "<script>toastr.success('password reset successfully');setTimeout(()=>{location.href='./login.php'}, 2000)</script>";
            }else{
                echo "<script>toastr.error('something went wrong')</script>";
            }
        }
    }
?>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4 m-auto border rounded shadow p-4">
                <h1>Forget Password</h1>
                <?php if(isset($_SESSION['forgetPassword'])){ ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="New Password" name="newPassword">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="resetPassword">Reset Password</button>
                        </div>
                    </form>
                <?php }else{ ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="forgetPassword">Forget Password</button>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
<?php  
    require_once 'footer.php';
?>
    