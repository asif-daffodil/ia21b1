<?php
require_once 'header.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['token'] != "ia21b1") {
    header('location: ./login.php');
}

if (isset($_POST['updateProfile'])) {
    $name = $conn->real_escape_string(safeData($_POST['name']));
    $email = $conn->real_escape_string(safeData($_POST['email']));
    if ($email != $_SESSION['user']['email']) {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>toastr.error('email already exists')</script>";
        } else {
            $address = $conn->real_escape_string(safeData($_POST['address']));
            $sql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `address` = '$address' WHERE `id` = " . $_SESSION['user']['id'];
            if ($conn->query($sql)) {
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['address'] = $address;
                echo "<script>toastr.success('profile updated successfully')</script>";
            } else {
                echo "<script>toastr.error('something went wrong')</script>";
            }
        }
    }
}
?>
<div class="container">
    <div class="row py-5">
        <div class="col-md-4 mx-auto border rounded shadow p-4">
            <?php if(!isset($_GET['delid'])){ ?>
            <h2 class="mb-3">Update Profile</h2>
            <form action="" method="post" class="mb-3">
                <div class="mb-3">
                    <input type="text" placeholder="Your Name" name="name" class="form-control" value="<?= $_SESSION['user']['name'] ?>">
                </div>
                <div class="mb-3">
                    <input type="email" placeholder="Your Email" name="email" class="form-control" value="<?= $_SESSION['user']['email'] ?>">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Your Address" name="address" class="form-control" value="<?= $_SESSION['user']['address'] ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="updateProfile">Update Profile</button>
            </form>
            <a href="<?= basename($_SERVER['PHP_SELF']) ?>?delid=<?= $_SESSION['user']['id'] ?>" class="text-danger small">Delete Profile</a>
            <?php }else{ ?>
                <h2 class="mb-3" >Do you really want to delete the user?</h2>
                <a href="delete-user.php?id=<?= $_SESSION['user']['id'] ?>" class="btn btn-danger">Yes</a>
                <a href="<?= basename($_SERVER['PHP_SELF']) ?>" class="btn btn-primary">No</a>
            <?php } ?>
        </div>
    </div>
</div>
<?php
require_once 'footer.php';
?>