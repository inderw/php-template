
<?php include 'includes/assets.php'; ?>
<title>Manage Song</title>

</head>

<body>

    <!-- [ navigation menu ] start -->
    <?php include("includes/navbar.php"); ?>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <?php include("includes/header.php"); ?>
    <!-- [ Header ] end -->

    <?php



    if (isset($_GET['sdelid'])) {
        // select image from db to delete
        $stmt_select = $DB->prepare('SELECT song_file FROM mng_song WHERE song_id =:uid');
        $stmt_select->execute(array(':uid' => $_GET['sdelid']));
        $imgRow = $stmt_select->fetch(PDO::FETCH_ASSOC);
        unlink("../media/" . $imgRow['song_file']);

        // it will delete an actual record from db
        $stmt_delete = $DB->prepare('DELETE FROM mng_song WHERE song_id =:uid');
        $stmt_delete->bindParam(':uid', $_GET['sdelid']);
        $stmt_delete->execute();

        header("Location: mng_song.php");
    }

    ?>

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Manage Song </h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="mng_song.php">Manage Songs</a></li>
                                <li class="breadcrumb-item"><a href="#">List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Default Styling table start -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header">
                            
                            <div class="d-flex justify-content-between">
                            <h3>Manage Songs</h3>
                         
                            <a href="add_song.php" class="btn btn-danger">Add Song <i class="feather icon-plus"></i></a>
                        </div>
                        </div>
                       
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Title</th>
                                            <th>Artist</th>
                                            <th>Album</th>
                                            <th>File</th>
                                            <th>Size</th>
                                            <th>Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $DB->prepare("SELECT * FROM mng_song");
                                        $dir_song = "../media/";
                                        $stmt->setFetchMode(PDO::FETCH_OBJ);
                                        $stmt->execute();
                                        $s = 1;
                                        while ($row = $stmt->fetch()) {


                                        ?>
                                            <tr>
                                                <td><?php echo $s; ?></td>
                                                <td><?php echo $row->song_title; ?></td>
                                                <td><?php echo $row->song_artist; ?></td>
                                                <td><?php echo $row->album_title; ?></td>
                                                <!--<a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-th"></i><span>Apps</span></a>-->
                                                <td><a href="#" data-toggle="modal" data-target="#myModal1"><?php echo $row->song_file; ?></a></td>
                                                <td><?php echo $row->song_size; ?></td>
                                                <td> <?php echo $row->song_details; ?></td>
                                                <td>

                                                    <a href="edit_song.php?sgid=<?php echo $row->song_id; ?>" title="Click For Edit" onClick="return confirm('Sure to Edit ?')" class="btn btn-primary btn-sm" data-toggle="tooltip"><i class="feather icon-edit-2 fa-2x"></i></a>
                                                    &nbsp;

                                                    <a href="?sdelid=<?php echo $row->song_id; ?>" title="Click For Delete" onClick="return confirm('Sure to Delete ?')" class="btn btn-danger btn-sm" data-toggle="tooltip" ><i class="feather icon-trash fa-2x"></i></a>
                                                </td>
                                            </tr>
                                        <?php $s++;
                                        } ?>
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Default Styling table start -->
                <!-- [ Footer-Styling ] start -->


                <!-- Custom Table color with hover and stripped table end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
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
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.table').DataTable();
} );
</script>

</body>

</html>