<?php  
    $conn = mysqli_connect("localhost", "root", "", "id21crudb1");

    if (isset($_POST['addStudent'])) {
        $name = $_POST['name'];
        $city = $_POST['city'];

        $query = "INSERT INTO studentss (`name`, `city`) VALUES ('$name', '$city')";
        $insert = $conn->query($query);

        if ($insert) {
            echo "<script>alert('Student added successfully!')</script>";
        } else {
            echo "<script>alert('Failed to add student!')</script>";
        }
    }

    $selectQuery = "SELECT * FROM `studentss`";
    $students = $conn->query($selectQuery);
?>
<?php if(!isset($_GET['edit']) && !isset($_GET['delete'])){ ?>
<form action="" method="post">
    <h2>Add Student</h2>
    <input type="text" placeholder="Your name" name="name" required>
    <br><br>
    <input type="text" placeholder="Your city" name="city" required>
    <br><br>
    <button type="submit" name="addStudent">Add Student</button>
</form>

<table border="1" cellspacing="0">
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>City</th>
        <th>Action</th>
    </tr>
    <?php 
    $sl = 1;
    while($student = $students->fetch_object()){ 
    ?>
        <tr>
            <td><?= $sl++ ?></td>
            <td><?= $student->name ?></td>
            <td><?= $student->city ?></td>
            <td>
                <a href="./<?= basename($_SERVER['PHP_SELF']) ?>?edit=<?= $student->id ?>">Edit</a>
                <a href="./<?= basename($_SERVER['PHP_SELF']) ?>?delete=<?= $student->id ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
<?php } ?>

<?php 
if(isset($_GET['edit'])){
     $editId = $_GET['edit'];
     if(isset($_POST['editStudent'])){
            $name = $_POST['name'];
            $city = $_POST['city'];
            $updateQuery = "UPDATE `studentss` SET `name` = '$name', `city` = '$city' WHERE id = $editId";
            $update = $conn->query($updateQuery);
            if($update){
                echo "<script>alert('Student updated successfully!')</script>";
            }else{
                echo "<script>alert('Failed to update student!')</script>";
            }
     }
     $selectEditDataQuery = "SELECT * FROM `studentss` WHERE id = $editId";
     $selectEditData = $conn->query($selectEditDataQuery);
     $editData = $selectEditData->fetch_object();
?>
<form action="" method="post">
    <h2>Edit Student</h2>
    <input type="text" placeholder="Your name" name="name" required value="<?= $editData->name ?>">
    <br><br>
    <input type="text" placeholder="Your city" name="city" required value="<?= $editData->city ?>">
    <br><br>
    <button type="submit" name="editStudent">Edit Student</button>
    <a href="./<?= basename($_SERVER['PHP_SELF']) ?>">
        <button type="button">Back</button>
    </a>
</form>
<?php } ?>

<?php 
if(isset($_GET['delete'])){ 
    if(isset($_POST['deleteStudent'])){
        $deleteId = $_POST['deleteId'];
        $deleteQuery = "DELETE FROM `studentss` WHERE id = $deleteId";
        $delete = $conn->query($deleteQuery);
        if($delete){
            echo "<script>alert('Student deleted successfully!');location.href='". basename($_SERVER['PHP_SELF']) ."'</script>";
        }else{
            echo "<script>alert('Failed to delete student!')</script>";
        }
    }
?>
    <h2>Do you really want to delete the data?</h2>
    <form action="" method="post" style="display: inline">
        <input type="hidden" name="deleteId" value="<?= $_GET['delete'] ?>">
        <button type="submit" name="deleteStudent">Yes</button>
    </form>
    <a href="./<?= basename($_SERVER['PHP_SELF']) ?>">
        <button type="button">No</button>
    </a>
<?php } ?>