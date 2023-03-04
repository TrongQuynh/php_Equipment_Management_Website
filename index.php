<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $a = 0;
        $b = 10;
        $n = 10;
        function Add($n){
            $sum = 0;
            for($i=1;$i < $n;$i++){
                $sum += ($i ** 2);
            }
            return $sum;
        }

        function Add2($n){
            $sum = 0;
            for($i=1;$i < $n;$i++){
                $sum += (1/$i);
            }
            return $sum;
        }

        function Add4($n){
            $sum = 0;
            for($i=1;$i < $n;$i++){
                $sum += (1/2*$i);
            }
            return $sum;
        }

        function Add5($n){
            $sum = 0;
            for($i=1;$i < $n;$i++){
                $sum += (1/(2*$i) + 1);
            }
            return $sum;
        }

        function Add6($n){
            $sum = 0;
            for($i=1;$i < $n;$i++){
                $sum += ($i/$i * ($i + 1));
            }
            return $sum;
        }

        function Add7($n){
            $sum = 0;
            for($i=1;$i < $n;$i++){
                $sum += ($i/($i) + 1);
            }
            return $sum;
        }

        echo "Result Add 1: " .Add($n);
        echo "<br>"; 
        echo "Result Add 4: " .Add4($n);
        echo "<br>";
        echo "Result Add 5: " .Add5($n);
        echo "<br>";
        echo "Result Add 7: " .Add7($n);
        echo "<br>";
        echo $n;
    ?>
</body>
</html>