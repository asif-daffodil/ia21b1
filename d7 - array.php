<?php  
    // indexed array
    // $studenList = array("Mahfuzur Rahman", "Hero Alom", "Shakib Khan", "Jayed Khan", "Anata Jalil");
    $studentList = ["Mahfuzur Rahman", "Hero Alom", "Shakib Khan", "Jayed Khan", "Anata Jalil"];

    echo $studentList[0]."<br>";
    echo "<pre>";
    print_r($studentList);
    echo "</pre>";

    for ($i = 0; $i < count($studentList); $i++){
        echo $studentList[$i]."<br>";
    }

    foreach ($studentList as $student) {
        echo $student."<br>";
    }

    // associative array
    $student = [
        "name" => "Mahfuzur Rahman",
        "age" => 25,
        "location" => "Dhaka",
        "isStudent" => true
    ];
    echo $student["location"];
    echo "<pre>";
    print_r($student);
    echo "</pre>";
    
    foreach ($student as $k => $std){
        echo $k.": ".$std."<br>";
    }

    // multi-dimensional array
    $students = [
        ["Name" => "Abul Miia", "City" => "Cumilla", "Age" => 22], 
        ["Name" => "Aslam mia", "City" => "Dhaka", "Age" => 45], 
        ["Name" => "Kuddus Boyati", "City" => "Bhammonbaria", "Age" => 20],
        ["Name" => "Rohim Uddin", "City" => "Kuakata", "Age" => 52]
    ];
    echo $students[0]["City"];
    echo "<pre>";
    print_r($students);
    echo "</pre>";

    foreach ($students as $student) {
        foreach($student as $key => $std){
            $x = null;
            if($key == "Age"){
                $x = ".";
            }else{
                $x = ", ";
            }
            echo $key.": ".$std.$x;
        }
        echo "<br>";
    }

    // array_push
    $areaArr = ["Dhaka", "Khulna", "Rongpur", "Barishal"];
    array_push($areaArr, "Rajshahi", "Kustia");
    array_unshift($areaArr, "Bogura", "Joypurhat");
    array_pop($areaArr);
    array_shift($areaArr);
    $areaArr[2] = "Cox Bazar";
    array_splice($areaArr, 3, 0, "Borguna");
    echo "<pre>";
    print_r($areaArr);
    echo "</pre>";
    var_dump(in_array("Joypurhat", $areaArr));

    // array sorting
    $numArr = [100, 20, 50, 40, 30, 70, 60, 80, 90, 10];
    sort($numArr);
    echo "<pre>";
    print_r($numArr);
    echo "</pre>";
    rsort($numArr);
    echo "<pre>";
    print_r($numArr);
    echo "</pre>";

?>