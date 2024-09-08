<?php  
    require_once 'header.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['token'] != "ia21b1"){
        header('location: ./login.php');
    }
    if(!isset($_GET['id'])){
        header('location: ./');
    }

    if(isset($_POST['deleteUser'])){
        $password = $conn->real_escape_string(safeData($_POST['password']));
        $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['user']['id'];
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $sql = "DELETE FROM `users` WHERE `id` = ".$_SESSION['user']['id'];
                if($conn->query($sql)){
                    session_destroy();
                    echo "<script>toastr.success('user deleted successfully'); setTimeout(()=>{location.href='./login.php'}, 2000)</script>";
                }else{
                    echo "<script>toastr.error('something went wrong')</script>";
                }
            }else{
                echo "<script>toastr.error('password did not matched')</script>";
            }
        }else{
            echo "<script>toastr.error('user not found')</script>";
        }
    }
?>

<div class="container">
    <div class="row py-5">
        <div class="col-md-4 p-4 border shadow rounded mx-auto">
            <form action="" method="post">
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Old Password" name="password">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-danger" name="deleteUser">Delete User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php  
    require_once 'footer.php';
?>