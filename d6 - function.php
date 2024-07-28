<?php 
    function singer ($sname = "Anata Jalil", $pow = "dangerous") {
        return "$sname is a $pow singer!<br>";
    }

    echo singer("Mahfuzur Rahman", "great");
    echo singer("Hero Alom", "awesome");
    echo singer();
    echo singer("Shakib Khan");
    echo singer(pow:"nice", sname:"Jayed Khan");


    function sum($a, $b) : int {
        return $a + $b;
    }

    echo sum(10, 20);

    function sum2() : string {
        return "Hello World";
    }

    function joyBangla () : void {
        echo "Joy Bangla<br>";
        echo "Joy Bongo Bondhu<br>";
    }

    // 400 - leap year
    // 100 - leap year naa
    // 4 - leap year
    // leap year na


    function checkLeapYear ($year) {
        if(!is_int($year)){
            return "Please provide a valid year<br>";
        } else {
            if($year % 400 == 0 || ($year % 4 == 0 && $year % 100 != 0)){
                return "$year is a leap year<br>";
            } else {
                return "$year is not a leap year<br>";
            }
        }
    }

    echo checkLeapYear (2000);
    echo checkLeapYear (1900);
    echo checkLeapYear (1904);
    echo checkLeapYear (2003);
    echo checkLeapYear ("ha ha ha");

    // recursive function
    function myFunc ($n) {
        if($n == 0){
            return;
        }
        echo $n."<br>";
        myFunc($n - 1);
    }

    myFunc(10);

    $num = 10;
    function myFunc2 (&$value): void {
        $value += 10;
    }
    myFunc2($num);
    echo $num."<br>";

    function myFunc3 ($firstNum, $secondNum, ...$nums) {
        echo "<pre>";
        print_r($nums);
        echo "</pre>";
    }

    myFunc3(10, 20, 30, 40, 50);
?>