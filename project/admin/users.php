<?php
require_once "./header.php";
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php

if(isset($_POST['addUser'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $sql = "INSERT INTO users (`name`, `email`, `password`, `role`) VALUES ('$name', '$email', '$password', '$role')";
    $result = $conn->query($sql);
    if($result){
        echo "<script>toastr.success('User added successfully')</script>";
    } else {
        echo "<script>toastr.error('Failed to add user')</script>";
    }
}

if (isset($_GET['editId'])){
    $editId = $_GET['editId'];
    $sql = "UPDATE users SET password = '".password_hash('12345678', PASSWORD_DEFAULT)."' WHERE id = '$editId'";
    $result = $conn->query($sql);
    if($result){
        echo "<script>toastr.success('Password reset successfully')</script>";
        echo "<script>setTimeout(() => location.href='users.php', 2000)</script>";
    } else {
        echo "<script>toastr.error('Failed to reset password')</script>";
    }
}

if (isset($_GET['deleteId'])){
    $deleteId = $_GET['deleteId'];
    $sql = "DELETE FROM users WHERE id = $deleteId";
    $result = $conn->query($sql);
    if($result){
        echo "<script>toastr.success('User deleted successfully')</script>";
        echo "<script>setTimeout(() => location.href='users.php', 2000)</script>";
    } else {
        echo "<script>toastr.error('Failed to delete user')</script>";
    }
}

?>

<?php require_once "./sidebar.php" ?>
<!-- Start Welcome area -->
<div class="all-content-wrapper" style="background: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="logo-pro">
                    <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $breadcomb = "Users";
    require_once "./top-header.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="padding: 20px;">
                <h2 class="">Users</h2>
                <table id="usersTable" class="table display">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users ORDER BY id DESC";
                    $result = $conn->query($sql);
                    $sn = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td>
                                    <a href="users.php?editId=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Reset</a>
                                    <a href="users.php?deleteId=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        $('#usersTable').DataTable({
                            "lengthMenu": [5, 10, 25, 50]
                        });
                    });
                </script>
            </div>
            <div class="col-md-6" style="padding: 20px;">
                <h2 class="">Add User</h2>
                <form action="" method="post">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="addUser">Add User</button>
            </div>
        </div>
    </div>

</div>

<?php require_once "./footer.php" ?>