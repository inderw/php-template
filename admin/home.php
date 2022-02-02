<?php require("includes/assets.php"); ?>
    <title>Dashboard</title>


</head>

<body>
   
    <!-- [ navigation menu ] start -->
    <?php include("includes/navbar.php"); ?>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
     <?php include("includes/header.php");?>
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
                                <h5 class="m-b-10">Dashboard Analytics</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <!-- <div class="row">
                <div class="col-lg-7 col-md-12">
                    support-section start -->
                    <div class="row">
                      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                          <h3 class="text-center mb-3 text-light">Welcomw To Admin Pannel</h3>
                      </div>
                    </div>
                    <!-- support-section end -->
                </div>
               
               
                <!-- Latest Customers end -->
            <!-- </div> -->
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