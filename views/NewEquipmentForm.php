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

        #device_picture{
            max-width: 80%;
        }

        .hiden{
            opacity: 0;
            visibility: hidden;
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
        <form id="formData" action="../php/New_Update_Equipment.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="btn_NewEquipment">
            </div>
            <div class="form-group">
                <label for="equipment_code">Equipment Code</label>
                <input type="text" class="form-control" id="equipment_code" placeholder="Enter code" name="equipment_code">
                <div class="alert alert-danger d-none mt-2" role="alert">
                        This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group">
                <label for="device_name">Equipment Name</label>
                <input type="text" class="form-control" id="device_name" placeholder="Enter equipment name" name="device_name">
                <div class="alert alert-danger d-none mt-2" role="alert">
                        This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group">
                <label for="device_type">Device Type</label>
                <select class="custom-select" id="device_type" name="device_type">
                    <option value="">Select</option>
                    <?php
                        if(mysqli_num_rows($result_device_type) > 0){
                            while($row = mysqli_fetch_assoc($result_device_type)){
                                echo '<option value="'. $row["device_type"] .'">'. $row["device_type"] .'</option>';
                            }
                        }
                    ?>
                </select>
                <div class="alert alert-danger d-none mt-2" role="alert">
                        This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="brand" placeholder="Enter brand" name="brand">
                    <div class="input-group-append">
                        <select class="custom-select" id="brand_select" name="brand_select">
                            <option value="">Select</option>
                            <?php
                                if(mysqli_num_rows($result_device_brand) > 0){
                                    while($row = mysqli_fetch_assoc($result_device_brand)){
                                        echo '<option value="'. $row["brand"] .'">'. $row["brand"] .'</option>';
                                    }
                                }
                            ?>
                        </select>
                        
                    </div>
                </div>
                <div class="alert alert-danger d-none mt-2" role="alert">
                    This is a danger alert—check it out!
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="uname">Quantity:</label>
                    <input type="number" class="form-control"  
                    value="0" min="0" id="quantity" placeholder="Enter quantity"
                    name="quantity" required>
                </div>
                <div class="col">
                    <label for="purchase_date">Purchase Date</label>
                    <input type="datetime-local" class="form-control" id="purchase_date" name="purchase_date">
                </div>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="device_image" name="device_image">
                <label class="custom-file-label" for="device_image">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <div class="form-group text-center mt-3 hiden">
                <h6 class="text-left">Device Picture</h6>
                <img src="" alt="Device Name" id="device_picture" srcset="" >
            </div>     
            <div class="button-group text-center mt-3">
                <button type="submit" name="btn_NewEquipment" id="btn_Submit" class="btn btn-primary">Submit</button>
            </div>            
        </form>
    </div>

    <script>
        // Init Time for input(datetime-local)
        const vstOffset = 7 * 60; // Vietnam is UTC+07:00
        const vstTime = new Date((new Date()).getTime() + vstOffset * 60 * 1000);
        document.querySelector('#purchase_date').value = vstTime.toISOString().slice(0, 16);
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

    <!-- Handle show picture choosen -->
    <script src="../public/js/displayImgChoosen.js"></script>

    <script>
        function clearErrorAlert(){
            $("div.alert.alert-danger").removeClass("d-none");
            $("div.alert.alert-danger").addClass("d-none");
        }
    </script>

    <script>
        $("#btn_Submit").click(function(event){
            event.preventDefault();

            // Clear Error
            
            clearErrorAlert();

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
                    }else{
                        let el = data.code == "brand" ? $(`#${data.code}`).parent().parent().find("div.alert") : $(`#${data.code}`).parent().find("div.alert");
                        el.removeClass("d-none").text(data.message);
                    }
                }
            });
          
        })
        
    
    </script>
</body>
</html>