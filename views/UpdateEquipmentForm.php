<!-- Check Authent -->
<?php include "../Helper/Authentication.php" ?>

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

        #btn_Submit,#btn_Cancel{
            width: 10rem;
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
        }
    ?>

    <!-- Header -->
    <?php include "layouts/Header.php" ?>

    <!-- Modal -->
    <?php include "layouts/ConfirmModal.php" ?>

    <div class="container mt-4">
        <h3 class="text-center">Update Equipment</h3>
        <form id="formData" action="../php/New_Update_Equipment.php" method="POST" class="mb-5" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="btn_UpdateEquipment">
                <input type="hidden" id="equiqment_id" name="equiqment_id" value="<?php echo $equipment_data["ID"]; ?>">
            </div>
            <div class="form-group">
                <label for="equipment_code">Equipment Code</label>
                <input type="text" class="form-control" id="equipment_code" placeholder="Enter code" 
                    name="equipment_code" value="<?php echo $equipment_data["code"]; ?>" required>
                    <div class="alert alert-danger mt-2 d-none" role="alert">
                        This is a danger alert—check it out!
                    </div>
            </div>
            <div class="form-group">
                <label for="device_name">Equipment Name</label>
                <input type="text" class="form-control" id="device_name" placeholder="Enter equipment name" 
                    name="device_name" value="<?php echo $equipment_data["device_name"]; ?>" required>
                <div class="alert alert-danger mt-2 d-none" role="alert">
                    This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group">
                <label for="device_type">Device Type</label>
                <select class="custom-select" id="device_type" name="device_type" required>
                    <option value="">Select</option>
                    <?php
                        if(mysqli_num_rows($result_device_type) > 0){
                            while($row = mysqli_fetch_assoc($result_device_type)){
                                if($equipment_data["device_type"] == $row["device_type"]){
                                    echo '<option selected value="'. $row["device_type"] .'">'. $row["device_type"] .'</option>';
                                }else{
                                    echo '<option value="'. $row["device_type"] .'">'. $row["device_type"] .'</option>';
                                }
                                
                            }
                        }
                    ?>
                </select>
                <div class="alert alert-danger mt-2 d-none" role="alert">
                    This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="brand" placeholder="Enter brand" name="brand">
                    <div class="input-group-append">
                        <select class="custom-select" id="brand_select" name="brand_select" required>
                            <option value="">Select</option>
                            <?php
                                if(mysqli_num_rows($result_device_brand) > 0){
                                    while($row = mysqli_fetch_assoc($result_device_brand)){
                                        echo $row["brand"] == $equipment_data["brand"] ? 
                                        '<option selected value="'. $row["brand"] .'">'. $row["brand"] .'</option>' :
                                        '<option value="'. $row["brand"] .'">'. $row["brand"] .'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="alert alert-danger mt-2 d-none" role="alert">
                    This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="uname">Quantity:</label>
                    <input type="number" class="form-control"  
                        min="0" id="quantity" placeholder="Enter quantity"
                        name="quantity" value="<?php echo $equipment_data["quantity"]; ?>" required>
                </div>
                <div class="col">
                    <label for="purchase_date">Purchase Date</label>
                    <input type="datetime-local" class="form-control" id="purchase_date" name="purchase_date" 
                        value="<?php echo $equipment_data["purchase_date"]; ?>" >
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
                <a name="btn_Cancel" href="/views/EquipmentList.php" id="btn_Cancel" class="btn btn-danger">Cancel</a>
                <button type="submit" name="btn_UpdateEquipment" id="btn_Submit" class="btn btn-primary">Submit</button>
            </div>            
        </form>
    </div>
    <script>
        // Handle show img has choose
        $("#device_image").change(function(event){
            let selectedFile = event.target.files[0];
            let reader = new FileReader();
            console.log(selectedFile);
            reader.onload = function(e){
                $("#device_picture").attr("src",e.target.result);
            }
            reader.readAsDataURL(selectedFile);
        })
    </script>
    <script>
         // Init Info for Confirm Modal
         $(document).ready(function(){
            $("#modalTitle").text("Update Equiqment");
            $("#modalContent").html("Are you sure wanna <strong class='text-danger'>update</strong> this item ?");
            $("#btn_modal_confirm").text("Update");
            $("#btn_modal_confirm").click(handleEventUpdateData)
         })

         function handleEventUpdateData(event){
            event.preventDefault();
            let equiqmentInfo = {};
            const formData = $("#formData").serializeArray();
            for(let data of formData){
                equiqmentInfo[data["name"]] = data["value"];
            }

            $.ajax({
                type : "POST",
                url  : "../Helper/ValidateData.php",
                data : equiqmentInfo,
                success: function(res){  
                    let data = $.parseJSON(res);
                    if (data.status == 200) {
                        $("#formData").submit();
                       
                        console.log("Click");
                    }else{
                        let el = data.code == "brand" ? $(`#${data.code}`).parent().parent().find("div.alert") : $(`#${data.code}`).parent().find("div.alert");
                        el.removeClass("d-none").text(data.message);
                    }
                }
            });
         }

    </script>
    <script>
        function clearErrorAlert(){
            $("div.alert.alert-danger").removeClass("d-none");
            $("div.alert.alert-danger").addClass("d-none");
        }
    </script>
    <script>
        // Handle validate data
        $("#btn_Submit").click(function(event){
            
            event.preventDefault();

            // Clear clearErrorAlert
            clearErrorAlert();

            $('#confirm_modal').modal('show');

        })
    </script>
    <script>
        // Init Info for Confirm Modal Update
        $("#modalTitle").text("Warning!");
        $("#modalContent").text("Are you sure wanna delete this item ?");
        $("#btn_modal_confirm").text("Delete");
    </script>
</body>
</html>