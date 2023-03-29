<?php 
    if(isset($_GET["id"])){
        $equipment_id = $_GET["id"];

        // Connect DB
        require_once "../connectDB.php";
        
        $query_delete = "DELETE FROM equipment WHERE ID = " . $equipment_id;
        // Excute Query
        mysqli_query($connectDB, $query_delete);
    }
    header('Location:/views/EquipmentList.php');
?>