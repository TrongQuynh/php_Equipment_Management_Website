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
    </style>
</head>

<body>
    <?php require_once "../connectDB.php"; ?>
    <?php 
        $query = "SELECT COUNT(*) FROM equipment"; 
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

        <div class="text-right mb-3">
            <a href="/views/NewEquipmentForm.php" class="badge badge-primary"><h6>New Equipment</h6></a>
            <a href="#" class="badge badge-secondary"><h6>Print</h6></a>
        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Code</th>
                    <th>Device Name</th>
                    <th>Device Type</th>
                    <th>Quantiity</th>
                    <th>Brand</th>
                    <th>Purchase Date</th>
                    <th>Device Image</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Query Statement
                    $query_select = "SELECT * FROM equipment LIMIT " . $itemPerPage . " OFFSET " . $skip;
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
                    }
                    /*'../php/DeleteEquipment.php?id=<?php echo $row["ID"]; ?>'*/
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
        // $("modal_delete")
        $(".btn_delete").each(function(index,item){
            $(this).click(function(e){
                let id = $(this).attr("id");
                $("#modal_delete").attr("action",`../php/DeleteEquipment.php?id=${id}`);
            })
            
        })
    </script>
</body>

</html>