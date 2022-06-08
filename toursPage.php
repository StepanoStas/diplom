<?php
session_start();
$tours_id = $_GET['id'];
$_SESSION['tours_id'] = $tours_id;
require "vendor/connectDB.php";
$toursquery = mysqli_query($link, "SELECT * FROM `tours` WHERE `id` = '$tours_id'");
$tours = mysqli_fetch_assoc($toursquery);
$tours_country_query = mysqli_query($link, "SELECT `tours`.*, `country`.`name` AS `Country`, `country`.`img` AS `Image`, `hotels`.`name` AS `Hotel`, `hotels`.`description` AS `Desc`, `hotels`.`stars` AS `Stars`, `hotels`.`services` AS `Serv`
FROM `tours` 
	LEFT JOIN `country` ON `tours`.`id_country` = `country`.`id` 
	LEFT JOIN `hotels` ON `hotels`.`id_country` = `country`.`id`
    WHERE `tours`.`id` = '$tours_id';");
$tours_country = mysqli_fetch_assoc($tours_country_query);
$tours_galleryquery = mysqli_query($link, "SELECT * FROM `tours_gallery` WHERE `id_tours` = '$tours_id'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/js/slick/slick.css">
    <link rel="stylesheet" href="assets/js/slick/slick-theme.css">
    <link href="assets/css/gallery/lightgallery.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/require.css">
    <link rel="stylesheet" href="assets/css/gallery/style.css" />
    <title><? echo $tours['name']?></title>
</head>
<body>
<div class="full">

    <?php require_once 'components/menu.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ ИЗ ПАПКИ CSS ?>

    <div class="tours-page-container">
        <div class="tours-page-header">
            <div class="country-elements">
                <img src="assets/img/flags/<?php echo $tours_country['Image']?>" alt="">
                <p><?php echo $tours_country['Country']?></p>
            </div>
            <div class="like">
                <p>Добавить в избранное</p>
                <button class="btn-like" id="btn-like">+</button>
            </div>
        </div>
        <div class="tours-page-content">
            <div class="tours-page-name">
                <h3><?php echo $tours['name']?></p>
            </div>
            <div class="container" id="lightgallery">
                <?php while($tours_gallery = mysqli_fetch_assoc($tours_galleryquery)){ ?>
                    <a href="assets/img/tours/<?php echo $tours_gallery['img']?>">
                        <img src="assets/img/tours/<?php echo $tours_gallery['img']?>" alt="">
                    </a>
                <?php }?>
            </div>
        </div>
        <div class="tours-page-nav">
            <div class="nav-elem">
                <a href="#text1">Описание тура</a>
            </div>
            <div class="nav-elem">
                <a href="#text2">Об отеле</a>
            </div>
            <div class="nav-elem">
                <a href="#text3">Контакты</a>
            </div>
            <div class="nav-elem">
                <a href="">Остались вопросы?</a>
            </div>
        </div>
        <div class="tours-page-desc">
            <p><?php echo $tours['description']?></p>
        </div>
        <div class="tours-page-hotels">
            <div class="tours-page-hotels-header">
                <h2>Об отеле: <?php echo $tours_country['Hotel']?></h2>
                <span>количество звезд <?php echo $tours_country['Stars']?></span>
            </div>
            <div class="tours-page-hotels-desc">
                <p><?php echo $tours_country['Desc']?></p>
                <p><?php echo $tours_country['Serv']?></p>
            </div>
        </div>
    </div>

    <?php require_once 'components/footer.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ ИЗ ПАПКИ CSS?>

</div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/lightgallery/lightgallery.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
      var imagPop = document.getElementById("lightgallery");
      lightGallery(imagPop);
    </script>
</body>
</html>