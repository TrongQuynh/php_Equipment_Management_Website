<?php
    
    function isHaveData($equipment_code,$device_name,$device_type,$brand){
        if(empty($equipment_code)){
            return array("message" => "Please Enter Equipment Code", "code" => "equipment_code");
        }
        if(empty($device_name)){
            return array("message" => "Please Enter Equipment Name", "code" => "device_name");
        }
        if(empty($device_type)){
            return array("message" => "Please Choose Equipment Type", "code" => "device_type");
        }
        if(empty($brand)){
            return array("message" => "Please Choose Brand", "code" => "brand");
        }
        return false;
    }

    
    require_once "../connectDB.php";
    function isEquiqmentCodeExsit($code,$connectDB){
        
        $query_select = "SELECT * FROM equipment WHERE code = " . "'" . $code ."'";
        // echo $query_select;
        $result = mysqli_query($connectDB, $query_select);
        return $result;
    };

    function isCanUpdateItem($code,$id,$connectDB){
        $result = isEquiqmentCodeExsit($code,$connectDB);
        
        if(mysqli_num_rows($result) == 0 || $id === mysqli_fetch_assoc($result)["ID"]){
            return true;
        }else{
            /**
             * $id !== mysqli_fetch_assoc($result)["ID"]
             */
            return false;
        }
    }

    $equiqment_id = isset($_POST["equiqment_id"]) ? $_POST["equiqment_id"] : "";
    $equipment_code = isset($_POST["equipment_code"]) ? $_POST["equipment_code"] : "";
    $device_name = isset($_POST["device_name"]) ? $_POST["device_name"] : "";
    $device_type = isset($_POST["device_type"]) ? $_POST["device_type"] : "";
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 0;
    $brand = isset($_POST["brand_select"]) ? $_POST["brand_select"] : "";

    if($err_msg = isHaveData($equipment_code,$device_name,$device_type,$brand)){
        $response = array(
            'status' => 404,
            'message' => $err_msg["message"],
            'code' => $err_msg["code"]
        );
        http_response_code(200);
        echo json_encode($response);
        exit();
    }
    
    $status = "";
    $message = "";
    
    // Request validate update
    if(!empty($_POST["equiqment_id"])){
        $id = $_POST["equiqment_id"];
        $status = isCanUpdateItem($equipment_code,$id,$connectDB) == true ? 200 : 404;
        $message = isCanUpdateItem($equipment_code,$id,$connectDB) ? "Code not exsit" : "Code already exsit";
    }else{
        // Request validate New
        $isExsitCode = mysqli_num_rows(isEquiqmentCodeExsit($equipment_code,$connectDB)) > 0 ? true : false;

        $status = $isExsitCode ? 404 : 200;
        $message = $isExsitCode ? "Code already exsit" : "Code not exsit";
    } 
    $response = array(
        'status' => $status,
        'message' => $message,
        'code' => "equipment_code"
    );
    // header('Content-type: application/json');
    http_response_code(200);
    echo json_encode($response);
    exit();



?> 
