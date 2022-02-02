<?php
require_once("includes/config.php");
if (!isset($_SESSION['userSession'])) {
    header("Location:index.php");
}
$pid=$_GET['pid'];

// set page title
$title = "Edit Products";

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    <title>EDIT Products</title>

</head>

<body>

    <!-- [ navigation menu ] start -->
    <?php include("includes/navbar.php"); ?>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <?php include("includes/header.php"); ?>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="fw-bold text-white">EDIT Products</h4>
                                <br>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php"><i class="feather icon-home"></i></a></li>

                                <li class="breadcrumb-item"><a href="#">EDIT Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>EDIT Products</h5>
                    </div>
                    <div class="card-body">
                        <?php

                        error_reporting(~E_NOTICE); // avoid notice



                        if (isset($_POST['sbtnsave'])) {

                            $size = $_POST['prop_size'];
                            $price = $_POST['price'];
                            $location = $_POST['location'];
                            $desc = $_POST['desc'];

                            $imgfile =    $_FILES["imgfile"]["name"];
                            $tmp_dir = $_FILES['imgfile']['tmp_name'];

                            $imgfile2 = basename($_FILES["imgfile2"]["name"]);
                            $tmp_dir2 = $_FILES['imgfile2']['tmp_name'];

                            $imgfile3 = basename($_FILES["imgfile3"]["name"]);
                            $tmp_dir3 = $_FILES['imgfile3']['tmp_name'];

                            $imgfile4 = basename($_FILES["imgfile4"]["name"]);
                            $tmp_dir4 = $_FILES['imgfile4']['tmp_name'];

                            $imgfile5 = basename($_FILES["imgfile5"]["name"]);
                            $tmp_dir5 = $_FILES['imgfile']['tmp_name'];

                            $imgSize = $_FILES['imgfile']['size'];

                            $imgSize2 = $_FILES['imgfile2']['size'];

                            $imgSize3 = $_FILES['imgfile3']['size'];

                            $imgSize4 = $_FILES['imgfile4']['size'];

                            $imgSize5 = $_FILES['imgfile5']['size'];

                            $sizeKb =  $imgSize / 1024;
                            $sizeKb2 = $imgSize2 / 1024;
                            $sizeKb3 = $imgSize3 / 1024;
                            $sizeKb4 = $imgSize4 / 1024;
                            $sizeKb5 = $imgSize5 / 1024;

                            $sizeMb = floor($sizeKb / 1024) . ' ' . 'Mb';
                            $sizeMb2 = floor($sizeKb / 1024) . ' ' . 'Mb';
                            $sizeMb3 = floor($sizeKb / 1024) . ' ' . 'Mb';
                            $sizeMb4 = floor($sizeKb / 1024) . ' ' . 'Mb';
                            $sizeMb5 = floor($sizeKb / 1024) . ' ' . 'Mb';


                            //for getting package id


                            if (empty($size)) {
                                $errMSG = "Please Enter Home size";
                            } else if (empty($price)) {
                                $errMSG = "Please Enter  Price.";
                            } else if (empty($location)) {
                                $errMSG = "Please Enter Location";
                            } else if (empty($imgfile)) {
                                $errMSG = "Please Select IMAGE.";
                            } 
                            else if (empty($desc)) {
                                $errMSG = "Please Enter description.";
                            } else {
                                $q = "select * from prp_products";
                                $stmt = $DB->prepare($q);
                                $stmt->execute();
                                $result = $stmt->fetch();
                                $productid = $result['pid'] ;
                                $upload_dir = "prod_img/$productid";
                              
                                // upload directory
                                  
                                  
                               
                                $imgExt = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION)); // get image extension

                               


      
                                    if ($imgSize < 1000000) {
                                        move_uploaded_file($tmp_dir, "$upload_dir/$imgfile");
                                    }  else{
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                    if ($imgSize2 < 1000000) {
                                        move_uploaded_file($tmp_dir2, "$upload_dir/$imgfile2");
                                    }  else{
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                    if ($imgSize3 < 1000000) {
                                        move_uploaded_file($tmp_dir3, "$upload_dir/$imgfile3");
                                    }  else{
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                    if ($imgSize4 < 1000000) {
                                        move_uploaded_file($tmp_dir4, "$upload_dir/$imgfile4");
                                    }  else{
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                    if ($imgSize5 < 1000000) {
                                        move_uploaded_file($tmp_dir5, "$upload_dir/$imgfile5");
                                    }  else{
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                
                               
                            }
                           

                            // if no error occured, continue ....
                            if (!isset($errMSG)) {
                                $update = "update prp_products set
                                prop_size=:size,
                                prop_img=:img,
                                prop_img2=:img2,
                                prop_img3=:img3,
                                prop_img4=:img4,
                                prop_img5=:img5,
                                prop_location=:location,
                                prop_price=:price,
                                prop_desc=:desc";
                                $stmt = $DB->prepare($update);
                                $stmt->bindParam(':size', $size);
                                $stmt->bindParam(':img', $imgfile);
                                $stmt->bindParam(':img2', $imgfile2);
                                $stmt->bindParam(':img3', $imgfile3);
                                $stmt->bindParam(':img4', $imgfile4);
                                $stmt->bindParam(':img5', $imgfile5);
                                $stmt->bindParam(':location', $location);
                                $stmt->bindParam(':price', $price);
                                $stmt->bindParam(':desc', $desc);
                                $stmt->execute();
                            }
                        }
                        ?>

                        <!-- <h4>EDIT product Page</h4>-->
                        <?php
                        if (isset($errMSG)) {

                        ?>
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                            </div>
                        <?php
                        } else if (isset($successMSG)) {
                        ?>
                            <div class="alert alert-success">
                                <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
                            </div>
                        <?php
                        }

                        $rec_list="select * from prp_products where prop_id=:id";
                        $stmt=$DB->prepare($rec_list);
                        $stmt->bindValue(':id',$pid);
                        $stmt->execute();
                        $result=$stmt->fetchAll();
                        foreach($result as $rec){
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data">
                                    <br>
                                    <div class="input-group col-xs-6"> <span class="input-group-EDITon btn btn-primary"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="prop_size" value="<?php echo $rec['prop_size'] ?>"  placeholder="Home Size">
                                    </div>

                                    <br>
                                    <div class="input-group cust-file-button mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn  btn-primary" type="button"><i class="fas fa-images"></i></button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" value="<?php echo $rec['prop_img'] ?>" id="imgfile" name="imgfile" placeholder="Image File">
                                            <label class="custom-file-label" for="imgfile"><?php echo $rec['prop_img'] ?></label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="input-group cust-file-button mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn  btn-primary" type="button"><i class="fas fa-images"></i></button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" value="<?php echo $rec['prop_img2'] ?>" id="imgfile2" name="imgfile2" placeholder="Image File2">
                                            <label class="custom-file-label" for="imgfile2"><?php echo $rec['prop_img2'] ?></label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="input-group cust-file-button mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn  btn-primary" type="button"><i class="fas fa-images"></i></button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" value="<?php echo $rec['prop_img3'] ?>" id="imgfile3" name="imgfile3" placeholder="Image File3">
                                            <label class="custom-file-label" for="imgfile3"><?php echo $rec['prop_img4'] ?></label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="input-group cust-file-button mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn  btn-primary" type="button"><i class="fas fa-images"></i></button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" value="<?php echo $rec['prop_img4'] ?>" id="imgfile4" name="imgfile4" placeholder="Image File4">
                                            <label class="custom-file-label" for="imgfile4"><?php echo $rec['prop_img4'] ?></label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="input-group cust-file-button mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn  btn-primary" type="button"><i class="fas fa-images"></i></button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" value="<?php echo $rec['prop_img5'] ?>" id="imgfile5" name="imgfile5" placeholder="Image File5">
                                            <label class="custom-file-label" for="imgfile5"><?php echo $rec['prop_img5'] ?></label>
                                        </div>
                                    </div>
                                    
                                    <br>

                                    <div class="input-group col-xs-6"> <span class="input-group-EDITon btn btn-primary"><i class="fas fa-location-arrow"></i></span>
                                        <input type="text" class="form-control"value="<?php echo $rec['prop_location'] ?>" name="location" placeholder="Home Location">
                                    </div>
                                    <!--<br>
			 
              <div class="input-group col-xs-6"> <span class="input-group-EDITon"><i class="fa fa-image"></i></span>
                <input type="file" class="form-control" name="ptitle" placeholder="product Image">
              </div>-->
                                    <br>

                                    <div class="input-group col-xs-6"> <span class="input-group-EDITon btn btn-primary"><i class="fas fa-dollar-sign"></i></span>
                                        <input type="text" class="form-control" value="<?php echo $rec['prop_price'] ?>" name="price" placeholder="Home Price">
                                    </div>
                                    <br>

                                    <div class="input-group col-xs-6"> <span class="input-group-EDITon btn btn-primary"><i class="fas fa-text-height"></i></span>
                                        <input type="text" class="form-control" value="<?php echo $rec['prop_desc'] ?>" name="desc" placeholder="Product Description">
                                    </div>
                                    <br>
                                    <div class="input-group text-center">
                                        <button type="submit" name="sbtnsave" class="btn btn-primary" placeholder="Email">Submit</button>
                                         
                                        <a href="javascript:self.history.back();" class="btn btn-danger">Back</a>
                                    </div>
                                
                                </form>
                             <?php } ?>
                            </div>

                        </div>


                    </div>
                </div>






                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';
                        window.EDITEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.EDITEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.EDIT('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                </script>






                <!-- Input group -->

            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/menu-setting.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>
    <!-- custom-chart js -->
    <script src="assets/js/pages/dashboard-main.js"></script>
    <script>
        $(document).ready(function() {
            checkCookie();
        });

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            var ticks = getCookie("modelopen");
            if (ticks != "") {
                ticks++;
                setCookie("modelopen", ticks, 1);
                if (ticks == "2" || ticks == "1" || ticks == "0") {
                    $('#exampleModalCenter').modal();
                }
            } else {
                // user = prompt("Please enter your name:", "");
                $('#exampleModalCenter').modal();
                ticks = 1;
                setCookie("modelopen", ticks, 1);
            }
        }
    </script>


</body>

</html>