<?php
date_default_timezone_set("Asia/Dhaka");
echo date("d/m/y h:i:s a (D)") . "<br>";
echo date("d/F(M)/Y H:i:s A (l)") . "<br>";

// mktime(hour, minute, second, month, day, year)
$myBirthday = mktime(0, 0, 0, 9, 10, 2024);
echo date("d/F/Y (l)", $myBirthday) . "<br>";

// strtotime()
$time1 = strtotime("yesterday");
echo date("d/m/Y (l)", $time1) . "<br>";

$time2 = strtotime("tomorrow");
echo date("d/m/Y (l)", $time2) . "<br>";

$time3 = strtotime("next friday");
echo date("d/m/Y (l)", $time3) . "<br>";

$time4 = strtotime("last sunday");
echo date("d/m/Y (l)", $time4) . "<br>";

$time5 = strtotime("+3 week");
echo date("d/m/Y (l)", $time5) . "<br>";

$time6 = strtotime("+6 month");
echo date("d/m/Y (l)", $time6) . "<br>";

$time7 = strtotime("+2 years +3 months +2 weeks +3 days");
echo date("d/m/Y (l)", $time7) . "<br>";

// next 7 friday
$startDate = strtotime("next friday");
$endDate = strtotime("+6 week", $startDate);
while ($startDate <= $endDate) {
    echo date("d/F/Y (l)", $startDate) . "<br>";
    $startDate = strtotime("+1 week", $startDate);
}

// find the gap of two dates by using DateTime class
$date1 = new DateTime("1987-09-10");
$date2 = new DateTime("2024-7-30");

$interval = $date1->diff($date2);

echo "Difference is: " . $interval->y . " years, " . $interval->m . " months, " . $interval->d . " days";


if (isset($_POST['uploadBtn'])) {
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $applicableExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // validation
    if (empty($fileName)) {
        $errMsg = "Please select an image";
    } elseif (!in_array($fileExtension, $applicableExtensions)) {
        $errMsg = "Please select an image";
    } else {
        $imageSize = getimagesize($fileTmpName);
        if ($imageSize[0] < 400 || $imageSize[1] < 400) {
            $errMsg = "Minimum 400x400 pixels required";
        } elseif ($fileSize > 5000000) {
            $errMsg = "Maximum 5MB allowed";
        } else {
            $alphabets = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $randomAlpha = substr(str_shuffle($alphabets), 0, 6);
            $newFileName = $randomAlpha . uniqid() . "." . $fileExtension;
            if (!is_dir("uploads")) {
                mkdir("uploads");
            }
            $destination = "uploads/" . $newFileName;
            $move = move_uploaded_file($fileTmpName, $destination);
            if (!$move) {
                $errMsg = "Failed to upload";
            } else {
                $successMsg = "Image uploaded successfully";
            }
        }
    }
}
?>
<hr>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="img">
    <button type="submit" name="uploadBtn">Upload</button>
    <div style="color: <?= isset($errMsg) ? "red" : (isset($successMsg) ? "green" : null) ?>">
        <?= $errMsg ?? $successMsg ?? null ?>
    </div>
</form>