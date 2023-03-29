<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<table border="1px">
<?php 
    $n = 8;
    for($row=1;$row<=8;$row++){
        echo "<tr>";
        for($col=1;$col<=8;$col++){
            echo $row % 2 != 0 ? "<td style='background:black'></td>" : "<td></td>";
        }
        echo "</tr>";
    }
?>

</table>

<?php
    $n = 7;
    function Add_1($n){
        $sum = 0;
        for($i=3;$i <= $n;$i+=2){
            if($i % 2 != 0){
                $sum += (1/$i);
            }
        }
        return $sum;
    }
    echo "<br>";
    echo "Add_1() = " . Add_1($n);
?>

<?php
    $n = 7;
    function Add_2($n){
        $sum = 0;
        for($i=1;$i <= $n;$i++){
            $sum += ($i * ($i + 1) /  ($i + 1) * ($i + 2));
        }
        return $sum;
    }
    echo "<br>";
    echo "Add_2() = " . Add_2($n);
?>

<?php
    $n = 7;
    function Add_3($n){
        $sum_1 = 0;
        $sum_2 = 1;
        for($i=1;$i <= $n;$i++){
            $sum_1 += $i;
            $sum_2 *= $i;
        }
        return $sum_1 / $sum_2;
    }
    echo "<br>";
    echo "Add_2() = " . Add_3($n);
?>

<?php 
    $myA = array("Nam"=>"21","Binh"=>"20","Tung"=>"19","Toan"=>"22", "Quynh"=>23);
    asort($myA);
    echo "<br>" . "<ul>";
    foreach($myA as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";
?>

<?php 
    $myA = array("Nam"=>"21","Binh"=>"20","Tung"=>"19","Toan"=>"22", "Quynh"=>23);
    ksort($myA);
    echo "<br>" . "<ul>";
    foreach($myA as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";
?>

<?php 
    $myA = array("Nam"=>"21","Binh"=>"20","Tung"=>"19","Toan"=>"22", "Quynh"=>23);
    arsort($myA);
    echo "<br>" . "<ul>";
    foreach($myA as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";
?>

<?php 
    $myA = array("Nam"=>"21","Binh"=>"20","Tung"=>"19","Toan"=>"22", "Quynh"=>23);
    krsort($myA);
    echo "<br>" . "<ul>";
    foreach($myA as $k => $v){
        echo "<li>" . $k . " - " . $v . "</li>";
    }
    echo "</ul>" . "<br>";
?>

<?php
    echo "date('Y-m-d H:i:s') - 1: ";
    echo date('Y-m-d H:i:s');
    echo "<br>";

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $now = new DateTime();
    echo "date('Y-m-d H:i:s') - 2: ";
    echo date('Y-m-d H:i:s');
?>
</body>
</html>