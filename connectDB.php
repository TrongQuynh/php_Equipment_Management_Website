<?php
$connectDB = new mysqli("localhost", "root", "van phong54664", "equipment_management_db");

// Check connection
if ($connectDB->connect_errno) {
    echo "Failed to connect to MySQL: " . $connectDB->connect_error;
    exit();
}
// echo "Connect DB success";
