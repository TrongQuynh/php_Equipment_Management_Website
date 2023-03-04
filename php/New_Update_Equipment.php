<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["btn_NewEquipment"]))) {
    // Receive Data From Form
    $equipment_code = $_POST["equipment_code"];
    $device_name = $_POST["device_name"];
    $device_type = $_POST["device_type"];
    $quantity = $_POST["quantity"];
    $brand = $_POST["brand"];
    $device_image = $_FILES["device_image"]["name"];
    $purchase_date = $_POST["purchase_date"];
    $createdAt = date('Y-m-d H:i:s');

    $target_dir = "../uploads/imgs/";
    $target_file = $target_dir . basename($device_image);

    // Connect DB
    require_once "../connectDB.php";

    // Query Statement
    $query_insert = "INSERT INTO equipment (code ,device_name ,device_type,quantity,brand,purchase_date) VALUES ('$equipment_code','$device_name','$device_type','$quantity','$brand','$purchase_date')";
    echo "<br> target_file: " . $target_file;
    echo "<br> src_File: " . $_FILES["device_image"]["tmp_name"];
    if (move_uploaded_file($_FILES["device_image"]["tmp_name"], $target_file)) {
        echo "Upload success";
        $query_insert = "INSERT INTO equipment (code ,device_name ,device_type,quantity,brand,purchase_date,device_image) VALUES ('$equipment_code','$device_name','$device_type','$quantity','$brand','$purchase_date','$target_file')";
    } else {
    }
    echo "<br>";
    // Test Query
    // echo $query_insert;
    // exit();

    // Excute Query
    mysqli_query($connectDB, $query_insert);

    // Alert insert success 
    echo "Insert data success";

    header('Location:/views/EquipmentList.php');
}
