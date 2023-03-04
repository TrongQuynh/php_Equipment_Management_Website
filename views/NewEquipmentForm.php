<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/Head.php" ?>
    <title>New Equipment</title>
    <style>
        .container{
            max-width: 35rem;
        }
    </style>
    <style>
        #brand_select{
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

    </style>
</head>
<body>

    <?php require_once "../connectDB.php"; ?>
    <?php 
        $query_select_device_type = "SELECT device_type FROM equipment GROUP BY device_type";
        $query_select_device_brand = "SELECT brand FROM equipment GROUP BY brand";
        // Excute Query
        $result_device_type = mysqli_query($connectDB, $query_select_device_type);
        $result_device_brand = mysqli_query($connectDB, $query_select_device_brand);

    ?>

    <!-- Header -->
    <?php include "layouts/Header.php" ?>

    <div class="container mt-4">
        <h3 class="text-center">New Equipment</h3>
        <form action="../php/New_Update_Equipment.php" method="POST" class="was-validated" enctype="multipart/form-data">
            <div class="form-group">
                <label for="equipment_code">Equipment Code</label>
                <input type="text" class="form-control" id="equipment_code" placeholder="Enter code" name="equipment_code"
                    required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="device_name">Equipment Name</label>
                <input type="text" class="form-control" id="device_name" placeholder="Enter equipment name" name="device_name"
                    required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="device_type">Device Type</label>
                <select class="custom-select" id="device_type" name="device_type" required>
                    <option value="">Select</option>
                    <?php
                        if(mysqli_num_rows($result_device_type) > 0){
                            while($row = mysqli_fetch_assoc($result_device_type)){
                                echo '<option value="'. $row["device_type"] .'">'. $row["device_type"] .'</option>';
                            }
                        }
                    ?>
                </select>
                <div class="invalid-feedback">Example invalid custom select feedback</div>
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="brand" placeholder="Enter brand" name="brand">
                    <div class="input-group-append">
                        <select class="custom-select" id="brand_select" name="brand_select" required>
                            <option value="">Select</option>
                            <option value="1">Sony</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="invalid-feedback">Example invalid custom select feedback</div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="uname">Quantity:</label>
                    <input type="number" class="form-control"  
                    value="0" min="0" id="quantity" placeholder="Enter quantity"
                    name="quantity" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col">
                    <label for="purchase_date">Purchase Date</label>
                    <input type="datetime-local" class="form-control" id="purchase_date" name="purchase_date">
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="device_image" name="device_image">
                <label class="custom-file-label" for="device_image">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>     
            <div class="button-group text-center mt-3">
                <button type="submit" name="btn_NewEquipment" id="btn_Submit" class="btn btn-primary">Submit</button>
            </div>            
        </form>
    </div>

    <script>
        // Init default datetime 
        let now = new Date().toISOString().slice(0, 16);
        document.querySelector('#purchase_date').value = now;
    </script>
    <script>
        // Handle select brand
        $("#brand").keyup(function(e){
            let brand_name = $("#brand").val();
            if(brand_name.length === 0){
                $("#brand_select .tmp").remove();
                $("#brand_select").val("");
            }else{
                if($("#brand_select").find(".tmp").length === 0){
                    $("#brand_select").append(`<option class="tmp" value="${brand_name}">${brand_name}</option>`)
                    
                }else{
                    $("#brand_select .tmp").text(brand_name);
                    $("#brand_select .tmp").val(brand_name);
                }
                $("#brand_select").val(brand_name); 
            }
        })
    </script>
</body>
</html>