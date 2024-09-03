<?php  
    require_once 'header.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['token'] != "ia21b1"){
        header('location: ./login.php');
    }

    if(isset($_POST['changePass'])){
        $oldPassword = $conn->real_escape_string(safeData($_POST['oldPassword']));
        $newPassword = $conn->real_escape_string(safeData($_POST['newPassword']));
        $confirmPassword = $conn->real_escape_string(safeData($_POST['confirmPassword']));
        if($newPassword != $confirmPassword){
            echo "<script>toastr.error('password did not matched')</script>";
        }else{
            $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['user']['id'];
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if(password_verify($oldPassword, $row['password'])){
                    $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $sql = "UPDATE `users` SET `password` = '$newPassword' WHERE `id` = ".$_SESSION['user']['id'];
                    if($conn->query($sql)){
                        echo "<script>toastr.success('password changed successfully')</script>";
                    }else{
                        echo "<script>toastr.error('something went wrong')</script>";
                    }
                }else{
                    echo "<script>toastr.error('old password did not matched')</script>";
                }
            }else{
                echo "<script>toastr.error('user not found')</script>";
            }
        }
    }
?>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4 mx-auto border rounded shadow p-4">
                <h2 class="mb-3">Change Password</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Old Password" name="oldPassword">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="New Password" name="newPassword">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="showPassword" class="form-check-input">
                        <label for="showPassword" class="form-check-label">Show Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="changePass">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const showPassword = document.querySelector('#showPassword');
        const password = document.querySelectorAll('input[type="password"]');
        showPassword.addEventListener('change', ()=>{
            if(showPassword.checked){
                password.forEach(pass => pass.type = "text");
            }else{
                password.forEach(pass => pass.type = "password");
            }
        });
    </script>
<?php  
    require_once 'footer.php';
?>