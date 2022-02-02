<?php require_once "common/config.php";
$pid=$_GET['id'];

?>

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
    <title>Property Details</title>

<body>
    <?php include "common/navbar.php" ?>
    <div class="container-fluid pt-5 prop-details">
        <?php 
        $pe="select * from prp_products where prop_id=:id";
        $query=$DB->prepare($pe);
        $query->bindValue(':id',$pid);
        $query->execute();
        $result=$query->fetchAll();
         foreach($result as $row){
        ?>
        <div class="my_gallery ">
            <div class="item px-2">
                <div class="card gl_card">
                    <img class="card-img-top" src="admin/prod_img/<?php echo $row['prop_id'];?>/<?php echo $row['prop_img']; ?>" alt="Card image cap">
                </div>
            </div>
            <div class="item px-2">
                <div class="card gl_card">
                    <img class="card-img-top" src="admin/prod_img/<?php echo $row['prop_id'];?>/<?php echo $row['prop_img2']; ?>" alt="Card image cap">
                </div>
            </div>
            <div class="item px-2">
                <div class="card gl_card">
                    <img class="card-img-top" src="admin/prod_img/<?php echo $row['prop_id'];?>/<?php echo $row['prop_img3']; ?>" alt="Card image cap">
                </div>
            </div>
            <div class="item px-2">
                <div class="card gl_card">
                    <img class="card-img-top" src="admin/prod_img/<?php echo $row['prop_id'];?>/<?php echo $row['prop_img4']; ?>" alt="Card image cap">
                </div>
            </div>
            <div class="item px-2">
                <div class="card gl_card">
                    <img class="card-img-top" src="admin/prod_img/<?php echo $row['prop_id'];?>/<?php echo $row['prop_img5']; ?>" alt="Card image cap">
                </div>
            </div>
        </div>
        <p><span><?php echo $row['prop_size']; ?></span> <span>$<?php echo $row['prop_price']; ?></span></p>
        <br>
        <span class="prp_location"><?php echo $row['prop_location']; ?></span>
        <span class="desc-heading">Description</span>
        <br>
        <span class="desc-text"><?php echo $row['prop_desc']; ?></span>
    </div>
<?php }?>
    <br>
    <?php include "common/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/script.js"></script>

  
</body>

</html>