<?php require "common/config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/all.css">
    <title>Find A Home</title>

<body>
    <?php include "common/navbar.php" ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 m-0 p-0 border">

              
                        <div class="row px-2 py-2 bg-light m-0 p-0">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">

                                <form action="#" method="post">
                                    <div class="wrap">
                                        <div class="search">
                                            <input type="text" class="search-term form-control" placeholder="What are you looking for?">
                                            <button type="submit" class="searchButton">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="row stuck py-4 px-4 m-0 p-0">
                            <?php
                            $sn = 1;
                            $prd_fetch =  "select * from prp_products";
                            $stmt   = $DB->prepare($prd_fetch);
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            if (!empty($result)) {
                                foreach ($result as $row) {
                            ?>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 py-2">
                                        <div class="card carfa_card" onclick="window.location.href='prp_details.php?id=<?php echo $row['prop_id'];?>'">
                                            <img class="card-img-top w-100" src="admin/prod_img/<?php echo $row['prop_id'];?>/<?php echo $row['prop_img']; ?>" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title fa_title"><?php echo $row['prop_size']; ?><a href="#">Contact Agent</a></h5>
                                                <p class="card-text fa_text"><?php echo $row['prop_location']; ?></p>
                                            </div>
                                            <span class="fa_text">Active <img src="https://templates.c21canada.moxiworks.net/files/2021/01/C21_Seal_RelentlessGold_4C-235x300.png"></img></span>
                                            <span class="fa_divide">&nbsp;</span>
                                        </div>
                                    </div>
                            <?php $sn++;
                                }
                            } ?>
                        </div>
            </div>
         

          
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 map-img m-0 p-0 sticky-right">
                <img src="images/map.png"  alt="map">
            </div>
        </div>
    </div>


    <?php include "common/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/script.js"></script>
</body>

</html>