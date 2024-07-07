<?php  
    // numbers functions
    /**
     * abs() - returns the absolute value of a number
     * ceil() - returns the value of a number rounded up to the nearest integer
     * floor() - returns the value of a number rounded down to the nearest integer
     * round() - returns the value of a number rounded to the nearest integer
     * rand() - generates a random number
     * max() - returns the highest value in an array
     * min() - returns the lowest value in an array
     * sqrt() - returns the square root of a number
     * pow() - returns the value of a number raised to the power of another number
     */

    echo abs(-6.7)."<br>"; // 6.7
    echo ceil(4.2)."<br>"; // 5
    echo floor(4.6)."<br>"; // 4
    echo round(4.5)."<br>"; // 5
    echo rand(100000, 999999)."<br>"; // random number
    echo max(0, 150, 30, 20, -8, -200)."<br>"; // 150
    echo min(0, 150, 30, 20, -8, -200)."<br>"; // -200
    echo sqrt(64)."<br>"; // 8
    echo pow(2, 3)."<br>"; // 8

    // constants
    define("studentName", "Rahim");
    echo studentName."<br>";

    // conditions
    /**
     * if
     * else
     * elseif
     * switch
     */

    $age = 350;

    if($age <= 12 && $age > 0) {
        echo "You are a child<br>";
    } elseif($age > 12 && $age <= 19) {
        echo "You are a teenager<br>";
    } elseif($age > 19 && $age <= 30) {
        echo "You are an young person<br>";
    } elseif($age > 30 && $age <= 50) {
        echo "You are a middle aged person<br>";
    } elseif($age > 50 && $age <= 150) {
        echo "You are an old person<br>";
    } else {
        echo "Invalid age<br>";
    }

?>