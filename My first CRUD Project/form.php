<?php
include("connection.php");
?>



<?php
$valid_blood_groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
$divisions = ['Dhaka', 'Chattogram', 'Khulna', 'Rajshahi', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh'];

$namevalid = "/^[A-Za-z. ]*$/";
$emailvalidation = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$addressvalidation = "/^[a-zA-Z0-9\s,.#-]+$/";
$numbervalidation = "/^(\+?8801|01)[3-9]\d{8}$/";

if (isset($_POST['reg1'])) {
    $username = $_POST['username'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $email = $_POST['email'];
    $presenAddress = $_POST['presenAddress'];
    $permanentAddress = $_POST['permanentAddress'];
    $phonenumber = $_POST['phonenumber'];
    $department = $_POST['department'] ?? null;
    $hobbies = $_POST['hobbies'] ?? [];
    $gender = $_POST['gender'] ?? null;
    $bloodgroup = $_POST['bloodgroup'];
    $city = $_POST['city'];

    $hobbies_str = implode(',', $hobbies);





    if (empty($username)) {
        $errUname = "Name is required";
    } elseif (!preg_match($namevalid, $username)) {
        $errUname = "Invalid Name";
    } else {
        $crrUname = $username;
    }
    if (empty($fathername)) {
        $errFname = "*Name is required";
    } elseif (!preg_match($namevalid, $fathername)) {
        $errFname = "*Invalid Name";
    } else {
        $crrFname = $fathername;
    }
    if (empty($mothername)) {
        $errMname = "*Name is required";
    } elseif (!preg_match($namevalid, $mothername)) {
        $errMname = "*Invalid Name";
    } else {
        $crrMname = $mothername;
    }
    if (empty($email)) {
        $errEmail = "*Email is required";
    } elseif (!preg_match($emailvalidation, $email)) {
        $errEmail = "*Invalid Email";
    } else {
        $crrEmail = $email;
    }
    if (empty($presenAddress)) {
        $errPresentaddress = "*Address is require";
    } elseif (!preg_match($addressvalidation, $presenAddress)) {
        $errPresentaddress = "*Invalid Present Address";
    } else {
        $crrPresentaddress = $presenAddress;
    }
    if (empty($permanentAddress)) {
        $errPermanentAddress = "*Address is require";
    } elseif (!preg_match($addressvalidation, $permanentAddress)) {
        $errPermanentAddress = "*Invalid Present Address";
    } else {
        $crrPermanentAddress = $permanentAddress;
    }
    if (empty($phonenumber)) {
        $errPhonenumber = "*Number is require";
    } elseif (!preg_match($numbervalidation, $phonenumber)) {
        $errPhonenumber = "*Invalid number";
    } else {
        $crrPhonenumber = $phonenumber;
    }
    if (empty($department)) {
        $errDepartment = "*Please select your department";
    } else {
        $crrDepartment = $department;
    }
    if (empty($hobbies)) {
        $errHobbies = "*Please select your hobbies";
    } else {
        $crrHobbies = $hobbies;
    }
    if (empty($gender)) {
        $errGender = "*Please select your gender";
    } else {
        $crrGender = $gender;
    }
    if (empty($bloodgroup)) {
        $errBloodgroup = "*Please select your Blood Group";
    } else {
        $crrBloodgroup = $bloodgroup;
    }
    if (empty($city)) {
        $errCity = "*Please select your City";
    } else {
        $crrCity = $city;
    }
    if (
        isset($crrUname, $crrFname, $crrMname) && isset($crrEmail) && isset($crrPresentaddress, $crrPermanentAddress) && isset($crrPhonenumber)
        && isset($crrDepartment, $crrGender) && isset($crrHobbies) && isset($crrBloodgroup, $crrCity)
    ) {
        $query = "INSERT INTO student_info (`username`, `fathername`, `mothername`, `email`, `presenAddress`, `permanentAddress`, `phonenumber`, `department`, `hobbies`, `gender`, `bloodgroup`, `city`) VALUES ('$username', ' $fathername', '$mothername', '$email', ' $presenAddress',
    '$permanentAddress',' $phonenumber','$department',' $hobbies_str','$gender',' $bloodgroup','$city')";
        $data = mysqli_query($conn, $query);
        $username = $fathername = $mothername = $email = $presenAddress = $permanentAddress = $phonenumber = $department = $gender = $hobbies = $bloodgroup = $city = null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD Project</title>
</head>

<body>
    <form action="" method="post" class="container">
        <div>
            <div class="title">
                <h2>Registration Form</h2>
            </div>
            <div class="form">
                <div class="input_field">
                    <label for="">Your Name:</label>
                    <input type="text" class="input" placeholder="Enter your full name" name="username" value="<?= $username ?? null ?>">
                </div>
                <div class="error">
                    <?= $errUname ?? null ?>
                </div>

                <div class="input_field">
                    <label for="">Father's Name: </label>
                    <input type="text" class="input" placeholder="Enter your father's Name" name="fathername" value="<?= $fathername ?? null ?>">
                </div>
                <div class="error">
                    <?= $errFname ?? null ?>
                </div>
                <div class="input_field">
                    <label for="">Mother's Name: </label>
                    <input type="text" class="input" placeholder="Enter your mother's Name" name="mothername" value="<?= $mothername ?? null ?>">
                </div>
                <div class="error">
                    <?= $errMname ?? null ?>
                </div>
                <div class="input_field">
                    <label for=""> Email:</label>
                    <input type="text" class="input" placeholder="example123@gmail.com" name="email" value="<?= $email ?? null ?>">
                </div>
                <div class="error">
                    <?= $errEmail ?? null ?>
                </div>
                <div class="input_field">
                    <label for="">Present Address:</label>
                    <input type="text" class="input" placeholder="" name="presenAddress" value="<?= $presenAddress ?? null ?>">
                </div>
                <div class="error">
                    <?= $errPresentaddress  ?? null ?>
                </div>
                <div class="input_field">
                    <label for="">Permanent Address:</label>
                    <input type="text" class="input" placeholder="" name="permanentAddress" value="<?= $permanentAddress ?? null ?>">
                </div>
                <div class="error">
                    <?= $errPermanentAddress ?? null ?>
                </div>
                <div class="input_field">
                    <label for="">Phone Number:</label>
                    <input type="text" class="input" placeholder="017xxxxxxxx" name="phonenumber" value="<?= $phonenumber ?? null ?>">
                </div>
                <div class="error">
                    <?= $errPhonenumber ?? null ?>
                </div>
                <div class="radio_group">
                    <label class="department">Department:</label>

                    <input type="radio" name="department" id="CSE" value="CSE" <?= isset($department) && $department == "CSE" ? "checked" : null ?>>
                    <label for="CSE" class="custom-radio">CSE</label>

                    <input type="radio" name="department" id="EEE" value="EEE" <?= isset($department) && $department == "EEE" ? "checked" : null ?>>
                    <label for="EEE" class="custom-radio">EEE</label>

                    <input type="radio" name="department" id="ARCH" value="ARCH" <?= isset($department) && $department == "ARCH" ? "checked" : null ?>>
                    <label for="ARCH" class="custom-radio">ARCH</label>

                    <input type="radio" name="department" id="AE" value="AE" <?= isset($department) && $department == "AE" ? "checked" : null ?>>
                    <label for="AE" class="custom-radio">AE</label>

                    <input type="radio" name="department" id="CE" value="CE" <?= isset($department) && $department == "CE" ? "checked" : null ?>>
                    <label for="CE" class="custom-radio">CE</label>
                </div>
                <div class="error">
                    <?= $errDepartment ?? null ?>
                </div>

                <div class="wrap">
                    <label class="hobbie">Hobbies:</label>

                    <input type="checkbox" name="hobbies[]" id="reading" value="Reading" <?= isset($hobbies) && in_array("Reading", $hobbies) ? "checked" : null ?>>
                    <label for="reading" class="custom-checkbox">Reading</label>

                    <input type="checkbox" name="hobbies[]" id="writing" value="Writing" <?= isset($hobbies) && in_array("Writing", $hobbies) ? "checked" : null ?>>
                    <label for="writing" class="custom-checkbox">Writing</label>

                    <input type="checkbox" name="hobbies[]" id="playing" value="Playing" <?= isset($hobbies) && in_array("Playing", $hobbies) ? "checked" : null ?>>
                    <label for="playing" class="custom-checkbox">Playing</label>

                    <input type="checkbox" name="hobbies[]" id="coding" value="Coding" <?= isset($hobbies) && in_array("Coding", $hobbies) ? "checked" : null ?>>
                    <label for="coding" class="custom-checkbox">Coding</label>
                </div>
                <div class="error">
                    <?= $errHobbies ?? null ?>
                </div>

                <div class="radio_group">
                    <label class="gender">Gender:</label>
                    <input type="radio" name="gender" id="Male" value="Male" <?= isset($gender) &&  $gender == "Male" ? "checked" : null ?>>
                    <label for="Male" class="custom-radio">Male</label>
                    <input type="radio" name="gender" id="Female" value="Female" <?= isset($gender) &&  $gender == "Female" ? "checked" : null ?>>
                    <label for="Female" class="custom-radio">Female</label>
                    <input type="radio" name="gender" id="Others" value="Others" <?= isset($gender) &&  $gender == "Others" ? "checked" : null ?>>
                    <label for="Others" class="custom-radio">Others</label>
                </div>
                <div class="error">
                    <?= $errGender ?? null ?>
                </div>
                <div class="input_field">
                    <label for=""> Blood Group:</label>
                    <select name="bloodgroup" id="">
                        <option value="" class="input">--Select--</option>
                        <?php foreach ($valid_blood_groups as $blood) { ?>
                            <option value="<?= $blood ?>" <?= isset($bloodgroup) && $bloodgroup == $blood ? "selected" : null ?>>
                                <?= $blood ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="error">
                    <?= $errBloodgroup ?? null ?>
                </div>

                <div class="input_field">
                    <label for=""> City:</label>
                    <select name="city" id="">
                        <option value="" class="input">--Select City--</option>
                        <?php foreach ($divisions as $div) { ?>
                            <option value="<?= $div ?>" <?= isset($city) && $city == $div ? "selected" : null ?>><?= $div ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="error">
                    <?= $errCity ?? null ?>
                </div>
                <div class="button">
                    <input type="submit" value="REGISTER" name="reg1" class="btn">
                </div>

            </div>
        </div>
    </form>
</body>

</html>

<?php
/* if(isset($crrUname,$crrFname,$crrMname)&&isset($crrEmail)&& isset($crrPresentaddress,$crrPermanentAddress)&& isset($crrPhonenumber)
&&isset( $crrDepartment,$crrGender)&&isset($crrHobbies)&& isset( $crrBloodgroup, $crrCity)){

    $query = "INSERT INTO student_info VALUES ('','$username', ' $fathername', '$mothername', '$email', ' $presenAddress',
    '$permanentAddress',' $phonenumber','$department',' $hobbies_str','$gender',' $bloodgroup','$city')";
     $data = mysqli_query($conn, $query);
} */
?>