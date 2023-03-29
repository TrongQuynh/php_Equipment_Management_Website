$("#device_image").change(function(event){
    let selectedFile = event.target.files[0];
    let reader = new FileReader();
    console.log(selectedFile);
    reader.onload = function(e){
        console.log("1",e);
        $("#device_picture").attr("src",e.target.result);
    }
    reader.readAsDataURL(selectedFile);
    $("#device_picture").parent().removeClass("hiden");
})