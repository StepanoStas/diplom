<?php
session_start();
$country_id = $_GET['id'];
require "vendor/connectDB.php";
$countrquery = mysqli_query($link, "SELECT * FROM `country` WHERE `id` = '$country_id'");
$country = mysqli_fetch_assoc($countrquery);
$resortquery = mysqli_query($link, "SELECT * FROM `resort` WHERE `id_country` = '$country_id'");
$country_galleryquery = mysqli_query($link, "SELECT * FROM `country_gallery` WHERE `id_country` = '$country_id'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/require.css">
    <link rel="stylesheet" href="assets/js/slick/slick.css">
    <link rel="stylesheet" href="assets/js/slick/slick-theme.css">
    <title><?php echo $country['name']?></title>
</head>
<body>
<div class="full">
    <?php
            require_once 'components/menu.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ ИЗ ПАПКИ CSS
    ?>

    <div class="country-page">
        <div class="country-page-title">
            <div class="text-cost">
                <div class="text-img">
                    <img src="assets/img/flags/<?php echo $country['img']?>" alt="">
                    <p><? echo $country['name']?></p>
                </div>
                <div class="cost">
                    <p>От <? echo $country['cost']?>₽ / чел.</p>
                </div>
            </div>
        </div>

        <div class="country-page-slider">
            <?php while($country_gallery = mysqli_fetch_assoc($country_galleryquery)){ ?>
                <img src="assets/img/country/<?php echo $country_gallery['img']?>" alt="">
            <?php }?>
        </div>

        <div class="country-page-desc">
            <p><? echo $country['description']?></p>
        </div>

        <div class="resort">
            <div class="resort-header">
                <h2>Курорты</h2>
            </div>
            <?php while($resort = mysqli_fetch_assoc($resortquery)){ ?>
            <div class="resort-block">
                <div class="resort-name">
                    <h3><? echo $resort['name']?></h3>
                </div>
                <div class="resort-desc">
                    <p><? echo $resort['description']?></p>
                </div>
            </div>
            <?php }?>
        </div>
    </div>

    <?php
        require_once 'components/footer.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ ИЗ ПАПКИ CSS
    ?>
</div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>