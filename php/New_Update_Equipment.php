<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Require
    require_once "../connectDB.php"; // Connect DB

    // Receive Data From Form $_POST["brand_select"]
    $equipment_code = isset($_POST["equipment_code"]) ? $_POST["equipment_code"] : "";
    $device_name = isset($_POST["device_name"]) ? $_POST["device_name"] : "";
    $device_type = isset($_POST["device_type"]) ? $_POST["device_type"] : "";
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 0;
    $brand = isset($_POST["brand_select"]) ? $_POST["brand_select"] : "";
    $device_image = $_FILES["device_image"]["name"];
    $purchase_date = $_POST["purchase_date"];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $createdAt = date('Y-m-d H:i:s');
    $updatedAt = date('Y-m-d H:i:s');

    $target_dir = "../uploads/imgs/";
    $target_file = $target_dir . basename($device_image);

    // Test
    echo "test";
    echo "<br> target_file: " . $target_file;
    echo "<br> src_File: " . $_FILES["device_image"]["tmp_name"];
    echo  "<br>" . $_SERVER['HTTP_REFERER'];

    if((isset($_POST["btn_NewEquipment"]))){
        // Query Statement
        $query_insert = "INSERT INTO equipment (code ,device_name ,device_type,quantity,brand,purchase_date) VALUES ('$equipment_code','$device_name','$device_type','$quantity','$brand','$purchase_date')";

        if (move_uploaded_file($_FILES["device_image"]["tmp_name"], $target_file)) {
            $query_insert = "INSERT INTO equipment (code ,device_name ,device_type,quantity,brand,purchase_date,device_image) VALUES ('$equipment_code','$device_name','$device_type','$quantity','$brand','$purchase_date','$target_file')";
        } 
        // Excute Query
        mysqli_query($connectDB, $query_insert);
    }elseif(isset($_POST["btn_UpdateEquipment"])){

        // Parse the URL to get ID of the query string
        $url = $_SERVER['HTTP_REFERER'];
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $queryParameters);
        $id = $queryParameters['id'];

        $device_image = $device_image ?  ",device_image = '$target_file'" : "";
        $query_update = " 
            UPDATE equipment 
            SET 
                code = '$equipment_code', 
                device_name = '$device_name', 
                device_type = '$device_type', 
                quantity = '$quantity',
                brand = '$brand',
                purchase_date = '$purchase_date'
                ". $device_image .",
                updatedAt = '$updatedAt'
            WHERE 
                ID = $id
        ";
        
        // Excute Query
        mysqli_query($connectDB, $query_update);
    }
    
    // Alert insert success 
    echo "Insert data success";

    header('Location:/views/EquipmentList.php');
}else{
    echo "Error New_Update_Equipment.php";
}

?>