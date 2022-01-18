<?php
require_once("includes/config.php");
// if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
//     // not logged in send to login page
//     redirect("index.php");
// }

// set page title
$title = "Dashboard";

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
<title>Add Products</title>

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
                                <h4 class="fw-bold text-white">Add Products</h4>
                                <br>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php"><i class="feather icon-home"></i></a></li>

                                <li class="breadcrumb-item"><a href="#">Add Products</a></li>
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
                        <h5>Add Products</h5>
                    </div>
                    <div class="card-body">
                        <?php

                        error_reporting(~E_NOTICE); // avoid notice



                        if (isset($_POST['sbtnsave'])) {

                         

                        

                            $size=$_POST['prop_size'];
                            $price=$_POST['price'];
                            $location=$_POST['location'];
                            $desc=$_POST['desc'];
                            $imgfile = basename($_FILES["imgfile"]["name"]);
                            $tmp_dir = $_FILES['imgfile']['tmp_name'];


                            $imgSize = $_FILES['imgfile']['size'];
                            $sizeKb = $imgSize / 1024;
                            $sizeMb = floor($sizeKb / 1024) . ' ' . 'Mb';





                            //for getting package id

                            if (empty($size)) {
                                $errMSG = "Please Enter Home size";
                            } else if (empty($price)) {
                                $errMSG = "Please Enter  Price.";
                            } else if (empty($location)) {
                                $errMSG = "Please Enter Location";
                            } else if (empty($imgfile)) {
                                $errMSG = "Please Select IMAGE.";
                            } else if (empty($desc)) {
                                $errMSG = "Please Enter description.";
                            } else {
                                $upload_dir = 'prod_img'; // upload directory

                                $imgExt = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION)); // get image extension

                                // valid image extensions
                                $valid_extensions = array('jpg', 'jpeg', 'png', 'GIF'); // valid extensions

                                // rename uploading image
                            
                              
                                
                                if (in_array($imgExt, $valid_extensions)) {
                                    // Check file size '9MB'
                                    if ($imgSize < 9000000) {
                                        move_uploaded_file($tmp_dir, "$upload_dir/$imgfile");
                                    } else {
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                } else {
                                    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                }
                            }
                           

                            // if no error occured, continue ....
                            if (!isset($errMSG)) {
                                $insert = "insert into prp_products set
                                prop_size=:size,
                                prop_img=:img,
                                prop_location=:location,
                                prop_price=:price,
                                prop_desc=:desc";
                                $stmt = $DB->prepare($insert);
                                $stmt->bindParam(':size', $size);
                                $stmt->bindParam(':img', $imgfile);
                                $stmt->bindParam(':location', $location);
                                $stmt->bindParam(':price', $price);
                                $stmt->bindParam(':desc', $desc);
                                $stmt->execute();
                            }
                        }
                        ?>

                        <!-- <h4>Add product Page</h4>-->
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
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data">
                                    <br>
                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="prop_size" placeholder="Home Size">
                                    </div>

                                    <br>

                                    <div class="input-group cust-file-button mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn  btn-primary" type="button"><i class="fas fa-images"></i></button>
                                        </div>
                                        <div class="custom-file">

                                            <input type="file" class="form-control" id="imgfile" name="imgfile" placeholder="Image File">
                                            <label class="custom-file-label" for="imgfile">Choose Product Image</label>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fas fa-location-arrow"></i></span>
                                        <input type="text" class="form-control" name="location" placeholder="Home Location">
                                    </div>
                                    <!--<br>
			 
              <div class="input-group col-xs-6"> <span class="input-group-addon"><i class="fa fa-image"></i></span>
                <input type="file" class="form-control" name="ptitle" placeholder="product Image">
              </div>-->
                                    <br>

                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fas fa-dollar-sign"></i></span>
                                        <input type="text" class="form-control" name="price" placeholder="Home Price">
                                    </div>
                                    <br>

                                    <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fas fa-text-height"></i></span>
                                        <input type="text" class="form-control" name="desc" placeholder="Product Description">
                                    </div>
                                    <br>
                                    <div class="input-group text-center">
                                        <button type="submit" name="sbtnsave" class="btn btn-primary" placeholder="Email">Submit</button>
                                         
                                        <a href="javascript:self.history.back();" class="btn btn-danger">Back</a>
                                    </div>

                                </form>
                            </div>

                        </div>


                    </div>
                </div>






                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
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