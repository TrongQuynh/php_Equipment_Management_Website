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
    function Average($myArr){
        $sum = 0;
        for($i=0;$i<count($myArr);$i++){
            $sum += $myArr[$i];
        }
        return array_sum($myArr) / count($myArr);
    }
    $myStr = "78,60,62,68,71,68,73,85,66,64,76,63,75,76,73,68,62,73,72,65,74,62,62,65,64,68,73,75,79,73";
    $myArr = explode(", ",$myStr);
    foreach($myArr as $a){
        echo $a;
        echo "<br>";
    }
    
    echo "<br> Average Temperature is: " . Average($myArr);
?>
<?php
$month_temp = "78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 81, 76, 73,
68, 72, 73, 75, 65, 74, 63, 67, 65, 64, 68, 73, 75, 79, 73";
$temp_array = explode(',', $month_temp);
$tot_temp = 0;
$temp_array_length = count($temp_array);
foreach($temp_array as $temp)
{
 $tot_temp += $temp;
}
 $avg_high_temp = $tot_temp/$temp_array_length;
 echo "Average Temperature is : ".$avg_high_temp."
"; 
sort($temp_array);
echo " List of five lowest temperatures :";
for ($i=0; $i< 7; $i++)
{ 
echo $temp_array[$i].", ";
}
echo "List of five highest temperatures :";
for ($i=($temp_array_length-7); $i< ($temp_array_length); $i++)
{
echo $temp_array[$i].", ";
}
?>

</body>
</html>