<!-- Check Authent -->
<?php include "../Helper/Authentication.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "layouts/Head.php" ?>
    <title>Equipment List</title>
    <style>
        .container{
            margin-top: 3rem;
            max-width: 80rem;
        }
        .device-img{
            width: 150px;
        }
        #tbl_header > th{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require_once "../connectDB.php"; ?>
    <?php
        // Get ?search=_
        $searchStr = isset($_GET["search"]) ? $_GET["search"] : "" ;
        $query_search = " WHERE device_name LIKE '%" . $searchStr . "%' OR code LIKE '%" . $searchStr . "%'";
    ?>
    <?php 
        $query = "SELECT COUNT(*) FROM equipment" . $query_search; 
        $result_total_page = mysqli_query($connectDB, $query); 
        $totalItem = mysqli_fetch_row($result_total_page)[0]; 
    ?>
    <?php 
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1 ;
        $itemPerPage = 5;
        $skip = ($currentPage * $itemPerPage) - $itemPerPage;
        $totalPage = ceil($totalItem / $itemPerPage);
        // echo "Total Page: " . $totalItem . "/". $itemPerPage ."<br>";
        // echo "Total Page: " . $totalPage;
    ?>
    
    <!-- Header -->
    <?php include "layouts/Header.php" ?>

    <!-- Modal -->
    <?php include "layouts/ConfirmModal.php" ?>

    <div class="container">
        <h3>Equipment List</h3>
        
        <div class="mb-3 mt-4">
            <div class="d-inline-block">
                <a href="/views/NewEquipmentForm.php" class="btn btn-outline-primary"><h6>New Equipment</h6></a>
            </div>
            <div class="d-inline-block w-50">
                <form method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search here" name="search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr id="tbl_header">
                    <th id="ID">STT</th>
                    <th id="code">Code</th>
                    <th id="device_name">Device Name</th>
                    <th id="device_type">Device Type</th>
                    <th id="quantity">Quantiity</th>
                    <th id="brand">Brand</th>
                    <th id="purchase_date">Purchase Date</th>
                    <th>Device Image</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $column = isset($_GET["col"]) ? $_GET["col"] : "ID" ;
                    $sortType = isset($_GET["sort"]) ? $_GET["sort"] : "desc" ;
                    $query_sort = $column . " " . $sortType;
                ?>
                <?php 
                    // Query Statement
                    $query_select = "SELECT * FROM equipment " . $query_search . " ORDER BY " . $query_sort . " LIMIT " . $itemPerPage . " OFFSET " . $skip;
                    $result = mysqli_query($connectDB, $query_select);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                            <tr>
                                <td class="align-middle"><?php echo $row["ID"]; ?></td>
                                <td class="align-middle"><?php echo $row["code"]; ?></td>
                                <td class="align-middle"><?php echo $row["device_name"]; ?></td>
                                <td class="align-middle"><?php echo $row["device_type"]; ?></td>
                                <td class="align-middle"><?php echo $row["quantity"]; ?></td>
                                <td class="align-middle"><?php echo $row["brand"]; ?></td>
                                <td class="align-middle"><?php echo $row["purchase_date"]; ?></td>
                                <td>
                                    <img class="device-img" src="<?php echo $row["device_image"]?>" alt="" srcset="">
                                </td>
                                <td class="align-middle">
                                    <a href="UpdateEquipmentForm.php?id=<?php echo $row["ID"]; ?>" class="btn btn-primary" role="button">Edit</a>
                                    <a href="#" data-toggle="modal" data-target="#delete_modal" id="<?php echo $row["ID"]; ?>" class="btn btn-danger btn_delete" role="button">Delete</a>
                                </td>
                            </tr>
                <?php 
                        }
                    }else{
                        echo "<tr><td colspan='9' class='text-center font-italic' ><h3>Not found</h3></td></tr>";
                    }
                ?>
                
            </tbody>
        </table>
        
        <div>
            <h5 class="text-center mb-3">Page <?php echo $currentPage?> / <?php echo $totalPage ?> Pages</h5>
        </div>

        <nav aria-label="Pagingnation">
            <ul class="pagination justify-content-center">
                
                <li class="page-item <?php echo $currentPage == 1 ? "disabled" :"" ?>">
                    <a class="page-link" href="/views/EquipmentList.php">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item <?php echo $currentPage == 1 ? "disabled" :"" ?>">
                    <a class="page-link" href="/views/EquipmentList.php?page=<?php echo $currentPage - 1 ?>" tabindex="-1">Previous</a>
                </li>

                <?php 
                    $end = $currentPage > 3 ? $currentPage + 2 : $totalPage;
                    for($page = $currentPage > 3 ? $currentPage - 2 : 1; $page <= $end && $page <= $totalPage; $page++){
                ?>
                        <li class="page-item <?php echo $page == $currentPage ? 'active' : '' ?> "><a class='page-link' href="/views/EquipmentList.php?page=<?php echo $page?>"><?php echo $page?></a></li>
                <?php 
                    }
                ?>

                <li class="page-item <?php echo $totalPage == $currentPage ? "disabled" : "" ?>">
                    <a class="page-link" href="/views/EquipmentList.php?page=<?php echo $currentPage + 1 ?>">Next</a>
                </li>
                <li class="page-item <?php echo $totalPage == $currentPage ? "disabled" : "" ?>">
                    <a class="page-link" href="/views/EquipmentList.php?page=<?php echo $totalPage?>">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <script>
        $(document).ready(function(){
            // $("modal_delete")
            $(".btn_delete").each(function(index,item){
                $(this).click(function(e){
                    // Init Info for Confirm Modal
                    $("#modalTitle").text("Warning!");
                    $("#modalContent").text("Are you sure wanna delete this item ?");
                    $("#btn_modal_confirm").text("Delete");
                    

                    let id = $(this).attr("id");
                    $("#confirm_modal").modal('show');
                    $("#modal_form").attr("method","GET");
                    
                    $("#btn_modal_confirm").click(async function(){
                        // $("#modal_form").attr("action",`../php/DeleteEquipment.php?id=${id}`);
                        // $("#modal_form").submit();
                        await fetch(`../php/DeleteEquipment.php?id=${id}`);
                        window.location.reload();
                    })
                    
                })
                
            })
        })
    </script>
    <script>
        $(document).ready(function(){
            
            $("#tbl_header th").each(function(index, el){
                $(this).click(function(){
                    let field = $(this).attr("id");
                    if(!field) return;
                    const urlParam = new URLSearchParams(window.location.search);
                    let sortType = !urlParam.get("sort") ? "asc" : urlParam.get("sort") == "asc" ? "desc" : "asc";

                    urlParam.set("col",field);
                    urlParam.set("sort",sortType);
                    
                    window.location.href = `${window.location.origin + window.location.pathname}?${urlParam.toString()}`;
                })
            })
            

        })
    </script>
</body>

</html>