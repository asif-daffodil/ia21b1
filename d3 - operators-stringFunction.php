<?php  
    // Arithmetic Operators
    /**
     * + Addition
     * - Subtraction
     * * Multiplication
     * / Division
     * % Modulus
     * ** Exponentiation
     */

    // Assignment Operators
    /**
     * = 
     * +=
     * -=
     * *=
     * /=
     * %=
     * **=
     */

    $x = 10;
    $x += 3; // $x = $x + 3;
    $x -= 2; // $x = $x - 2;
    $x *= 2; // $x = $x * 2;
    $x /= 2; // $x = $x / 2;
    $x %= 2; // $x = $x % 2;

    // Comparison Operators
    /**
     * == Equal
     * === Identical
     * != Not equal
     * !== Not identical
     * > Greater than
     * < Less than
     * >= Greater than or equal to
     * <= Less than or equal to
     */

     $a = 6;
     $b = "6";

    var_dump($a == $b); // true
    var_dump($a === $b); // true
    var_dump($a != $b); // true
    var_dump($a !== $b); // true

    // Logical Operators
    /**
     * and
     * or
     * xor
     * &&
     * ||
     * !
     */

    var_dump($a == $b && $a === $b); // false
    var_dump($a == $b || $a !== $b); // true
    var_dump($a == $b xor $a !== $b); // false

    // Increment/Decrement Operators
    /**
     * ++$x
     * $x++
     * --$x
     * $x--
     */

    $x = 10;
    echo ++$x."<br>"; // 11
    echo $x++."<br>"; // 11
    echo $x."<br>"; // 12
    echo --$x."<br>"; // 11
    echo $x--."<br>"; // 11
    echo $x."<br>"; // 10

    // String Operators
    /**
     * .
     * .=
     */


     echo $x." ".$a."<br>";

     $m = "Ami";
     $n = "vaat";
     $q = "khai";

     echo $m." ".$n." ".$q."<br>";

    //  string function
    /**
     * strlen()
     * str_word_count()
     * strrev()
     * strpos()
     * str_replace()
     * strtolower()
     * strtoupper()
     * ucfirst()
     * ucwords()
     * trim()
     * substr()
     * str_shuffle()
    */

    $str = "Hello world!";
    echo strlen($str)."<br>"; // 12
    echo str_word_count($str)."<br>"; // 2
    echo strrev($str)."<br>"; // !dlroW olleH
    echo strpos($str, "World")."<br>"; // 6
    echo str_replace("World", "Dolly", $str)."<br>"; // Hello Dolly!
    echo strtolower($str)."<br>"; // hello world!
    echo strtoupper($str)."<br>"; // HELLO WORLD!
    echo ucfirst($str)."<br>"; // Hello World!
    echo ucwords($str)."<br>"; // Hello World!
    echo trim(" Hello world! ")."<br>"; // Hello world!
    echo substr($str, 0, 5)."<br>"; // world!
    echo str_shuffle($str)."<br>"; // !oHllo dlreow

    $smallCharacters = "abcdefghijklmnopqrstuvwxyz";
    $bigCharacters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numbers = "0123456789";
    $specialCharacters = "!@#$%^&*()";