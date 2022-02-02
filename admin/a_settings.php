<?php 
include 'includes/assets.php'; 


?>

<title>Change Password</title>
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
                               
                                <h5 class="m-b-10">Change Password</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php"><i class="feather icon-home"></i></a></li>

                                <li class="breadcrumb-item"><a href="a_settings.php">Admin Settings</a></li>
                                <li class="breadcrumb-item"><a href="#">Change Password</a></li>
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
                    <?php
                                if (isset($_POST['uUpdate'])) {
                                  
                                    $upassw = $_POST['upassw'];


                                    // checking empty fields
                                    if (empty($upassw)) {

                                        if (empty($upassw)) {
                                            echo "<font color='red'>Password field is empty.</font><br/>";
                                        }

                                        //link to the previous page
                                        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
                                    } else {
                                        // if all the fields are filled (not empty) 

                                        //insert data to database		
                                        $update = "update user_details set
                                        usr_pass=:pass where usr_id=:id";
                                        $stmt = $DB->prepare($update);
                                        
                                        $stmt->bindParam(':pass', password_hash($upassw,PASSWORD_BCRYPT));
                                        $stmt->bindParam(':id', $_SESSION['userSession']);
                                        $stmt->execute();

                                        // Alternative to above bindparam and execute
                                        // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));

                                        //display success message
                                        echo "<h4 class='text-success text-center' ><i class='fa fa-spin fa-spinner'></i>  Password Changed</h4>";

                                        header("refresh:3;home.php");
                                    }
                                }



                                ?>
                                <?php
                                //getting id from url
                                $uid = $_SESSION['userSession'];

                                //selecting data associated with this particular id
                                $sql = "SELECT * FROM user_details WHERE usr_id=:id";
                                $query = $DB->prepare($sql);
                                $query->execute(array(':id' => $uid));

                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    $uname = $row['usr_name'];
                                 
                                }
                                ?>
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                            <form method="post">
              <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg " value="<?php echo $uname;?>" name="pename" disabled>
              </div>
              
              <br>
              <div class="input-group col-xs-6"> <span class="input-group-addon btn btn-primary"><i class="fa fa-key"></i></span>
                <input type="password" id="password" class="form-control password input-lg" value="<?php echo $upass;?>" name="upassw" >
                <br>
                <div class="col-md-12">
                               
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" placeholder="Enter Password to Change" id="customswitch1">
                                    <label class="custom-control-label" onclick="passShow();" for="customswitch1">Show Password</label>
                                </div>
                           
              </div>
              <br>
              <br>
              <div class="input-group text-center">
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                <input type="submit" name="uUpdate" value="Update" class="btn btn-primary" >
                &nbsp; &nbsp;<a href="javascript:self.history.back();" class="btn btn-danger" >Cancel</a> </div>
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
function passShow() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
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