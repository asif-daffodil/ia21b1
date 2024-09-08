<?php  
    require_once 'header.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['token'] != "ia21b1"){
        header('location: ./login.php');
    }

    if(isset($_POST['changeProfilePicture'])){
        $profilePicture = $_FILES['profilePicture'];
        $profilePictureName = $profilePicture['name'];
        $profilePictureTmpName = $profilePicture['tmp_name'];
        $profilePictureSize = $profilePicture['size'];
        $profilePictureError = $profilePicture['error'];
        $profilePictureType = $profilePicture['type'];
        $profilePictureExt = explode('.', $profilePictureName);
        $profilePictureActualExt = strtolower(end($profilePictureExt));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if(in_array($profilePictureActualExt, $allowed)){
            if($profilePictureError === 0){
                if($profilePictureSize < 5000000){
                    $profilePictureNewName = uniqid('', true).".".$profilePictureActualExt;
                    $profilePictureDestination = 'assets/images/'.$profilePictureNewName;
                    move_uploaded_file($profilePictureTmpName, $profilePictureDestination);
                    $sql = "UPDATE `users` SET `image` = '$profilePictureNewName' WHERE `id` = ".$_SESSION['user']['id'];
                    if($conn->query($sql)){
                        $_SESSION['user']['image'] = $profilePictureNewName;
                        echo "<script>toastr.success('profile picture changed successfully')</script>";
                    }else{
                        echo "<script>toastr.error('something went wrong')</script>";
                    }
                }else{
                    echo "<script>toastr.error('file size is too large')</script>";
                }
            }else{
                echo "<script>toastr.error('there was an error uploading the file')</script>";
            }
        }else{
            echo "<script>toastr.error('you cannot upload files of this type')</script>";
        }
    }
?>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4 mx-auto border rounded shadow p-4">
                <h2 class="mb-3 text-center">Profile Picture</h2>
                <form action="" method="post" enctype="multipart/form-data" class="text-center">
                    <div class="mb-3">
                        <label for="pp">
                        <img src="./assets/images/<?= !empty($_SESSION['user']['image']) ? $_SESSION['user']['image'] : "profile_picture.png" ?>" alt="" class="img-fluid" style="height:300px; width:300px; object-fit: cover">
                            <input type="file" class="form-control d-none" name="profilePicture" id="pp">
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="changeProfilePicture">Change Profile Picture</button>
                </form>
            </div>
        </div>
    </div>
<?php  
    require_once 'footer.php';
?>
    