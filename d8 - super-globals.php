<?php  
    $batchName = "PHP Batch 1";
    $organization = "DIPTI";

    function myFunc () {
        $GLOBALS['studentAmount'] = 18;
        global $batchName, $organization;
        echo "Batch Name : ".$batchName." Organization : ".$organization."<br>";
    }

    myFunc();
    echo $studentAmount;

    // $_SERVER

    /* echo "<pre>";
    print_r($_SERVER);
    echo "</pre>"; */

    echo $_SERVER['PHP_SELF']."<br>";
    echo $_SERVER['SERVER_NAME']."<br>";
    echo $_SERVER['REQUEST_METHOD']."<br>";


?>

<form action="" method="post">
    <input type="text" name="uname" placeholder="Enter your name">
    <button type="submit">Submit</button>
</form>

<?php  
    echo $_REQUEST['uname'] ?? null;
    echo "<br>";
    echo $_POST['uname'] ?? null;
    echo "<br>";
    echo $_GET['uname'] ?? null;
?>

<?php 
// $_ENV

$_ENV['DB_HOST'] = "localhost";
$_ENV['DB_USER'] = "root";
$_ENV['DB_PASS'] = "";
$_ENV['DB_NAME'] = "test";

echo "<pre>";
print_r($_ENV);
echo "</pre>";

?>
