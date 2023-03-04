<?php
    $row = 12;
    echo "12" + "12" . "<br>";
    $color = array("white", "green","blue");
    foreach($color as $c){
        echo $c . "<br>";
    }
    echo "SORT" . "<br>";
    sort($color);
    echo "<br> <ul>";
    foreach($color as $c){
        echo "<li>" . $c . "</li>";
    }
    echo "</ul>" . "<br>";
    $color = array("hello"=>"white", 10=>"green",15=>"blue");
    echo $color["hello"];

    $numbers = array(1,2,3,4,5);
    array_splice($numbers, 1, 0);
    echo "<br> <ul>";
    foreach($numbers as $c){
        echo "<li>" . $c . "</li>";
    }
    echo "</ul>" . "<br>";
    echo "Count " . count($numbers);

    $arrayItems = array("Sophia" => "31","Jacob" => "41","William" => "39", "Ramesh" => "40");
    echo "<br> ASC by Value - asort()";
    asort($arrayItems);
    echo "<br>" . "<ul>";
    foreach($arrayItems as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";

    echo "<br> ASC by Key - ksort()";
    ksort($arrayItems);
    echo "<br>" . "<ul>";
    foreach($arrayItems as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";

    echo "<br> DESC by Value: arsort()";
    arsort($arrayItems);
    echo "<br>" . "<ul>";
    foreach($arrayItems as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";

    echo "<br> DESC by Key - krsort()";
    krsort($arrayItems);
    echo "<br>" . "<ul>";
    foreach($arrayItems as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";

    echo "Ex 5";

    $arrayNumbers = "18,20,22,18,21,25,23,24,27,21,18,19,27,26,23";
    $arrNewArray = explode(",",$arrayNumbers);
    echo "<br> <ul>";
    foreach($arrNewArray as $c){
        echo "<li>" . $c . "</li>";
    }
    echo "</ul>" . "<br>";

    echo "A. Calculate and Display Average Value" . "<br>";
    echo array_sum($arrNewArray) / count($arrNewArray) . "<br>";

    echo "B. Two lowest Value" . "<br>";
    $arrNewArray = arsort($arrNewArray);
    echo $arrNewArray[0] . " - " . $arrNewArray[1];

    echo "<br/>";
    $arrStr = array("abc","Hello", "1232556");
    
    echo "<br>" ;
    echo date('Y-m-d H:i:s');
?>
