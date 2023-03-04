<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Header -->
    <?php include "layouts/Head.php" ?>
    <title>Update Equipment</title>
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

        #device_picture{
            max-width: 80%;
        }

    </style>
</head>
<body>
    <?php require_once "../connectDB.php"; ?>
    <?php 
       
        if(isset($_GET["id"])){
            $equipment_id = $_GET["id"];
            // Query Update
            $query_update = "SELECT * FROM equipment WHERE ID = " . $equipment_id;

            // Excute Query
            $result = mysqli_query($connectDB, $query_update);

            $equipment_data = null;
            if(mysqli_num_rows($result) > 0){
                $equipment_data = mysqli_fetch_assoc($result);
            }

            // echo $equipment_data["purchase_date"];

            // echo "<br>";

            // echo $query_update;
            // exit();
        }
    ?>

    <!-- Header -->
    <?php include "layouts/Header.php" ?>

    <div class="container mt-4">
        <h3 class="text-center">Update Equipment</h3>
        <form action="../php/UpdateEquipment.php" method="POST" class="was-validated mb-5" enctype="multipart/form-data">
            <div class="form-group">
                <label for="equipment_code">Equipment Code</label>
                <input type="text" class="form-control" id="equipment_code" placeholder="Enter code" 
                    name="equipment_code" value="<?php echo $equipment_data["code"]; ?>" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="device_name">Equipment Name</label>
                <input type="text" class="form-control" id="device_name" placeholder="Enter equipment name" 
                    name="device_name" value="<?php echo $equipment_data["device_name"]; ?>" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="device_type">Device Type</label>
                <select class="custom-select" id="device_type" name="device_type" required>
                    <option value="" selected>Select</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
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
                        name="quantity" value="<?php echo $equipment_data["quantity"]; ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col">
                    <label for="purchase_date">Purchase Date</label>
                    <input type="datetime-local" class="form-control" id="purchase_date" name="purchase_date" 
                        value="<?php echo $equipment_data["purchase_date"]; ?>" >
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="device_image" name="device_image">
                <label class="custom-file-label" for="device_image">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>   
            <div class="form-group text-center mt-3">
                <h6 class="text-left">Device Picture</h6>
                <img src="<?php echo $equipment_data["device_image"]; ?>" alt="Device Name" id="device_picture" srcset="">
            </div>
            <div class="button-group text-center mt-3">
                <button type="submit" id="btn_Submit" class="btn btn-primary">Submit</button>
            </div>            
        </form>
    </div>
    <script>
        $("#device_image").change(function(event){
            let selectedFile = event.target.files[0];
            let reader = new FileReader();
            console.log(selectedFile);
            reader.onload = function(e){
                console.log("1",e);
                $("#device_picture").attr("src",e.target.result);
            }
            reader.readAsDataURL(selectedFile);
        })
    </script>
</body>
</html>