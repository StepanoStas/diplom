<?php
session_start();
require_once "vendor/connectDB.php";
$id = $_SESSION['users']['id'];
$tours_id = $_SESSION['tours_id'];
$userquery = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$id'");
$user = mysqli_fetch_assoc($userquery);
$tours_orderquery = mysqli_query($link, "SELECT `tours_order`.*, `tours`.`name` AS `Order`, `tours`.`img`, `tours`.`id_cities`, `tours`.`id_country`, `cities`.`name`, `country`.`name`, `tours`.`description`, `tours`.`departure_date`, `tours`.`nights`, `tours`.`price`
FROM `tours_order` 
	LEFT JOIN `tours` ON `tours_order`.`id_tours` = `tours`.`id` 
	LEFT JOIN `cities` ON `tours`.`id_cities` = `cities`.`id` 
	LEFT JOIN `country` ON `tours`.`id_country` = `country`.`id`;
    ;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/require.css">
    <title>Личный кабинет</title>
</head>
<body>
    <div class="full">
        <?php
            require_once 'components/menu.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ ИЗ ПАПКИ CSS
        ?>

        <div class="cabinet">
            <div class="cabinet-title">
                <h2>Добро пожаловать, <?php echo $user['name']?> <?php echo $user['patronymic']?> !</h2>
            </div>
            <div class="cabinet-tours-contaier">
                <div class="favourite-tours">                
                    <?php while($tours_order = mysqli_fetch_assoc($tours_orderquery)){ ?>
                        <div class="favourite-tours-block-inner">
                            <div class="tours-img">
                                <img src="assets/img/hotels/<?php echo $tours_order['img']?>" alt="">
                            </div>
                            <div class="favourite-tours-title">
                                <h3><?php echo $tours_order['Order']?></h3>
                                <p><?php echo $tours_order['Country']?></p>
                            </div>
                            <div class="favourite-tours-short-desc">
                                <p>Ночей: <?php echo $tours_order['nights']?></p>
                                <p>Стоимость: <?php echo $tours_order['price']?></p>
                            </div>
                            <div class="favourite-tours-desc">
                                <p><?php echo $tours_order['description']?></p>
                            </div>
                            <div>
                                <a href="/toursPage.php?id=<?php echo $tours_order['id_tours']?>">Подробнее</a>
                            </div>
                            <button id="btn-dislike">-</button>
                        </div>  
                    <?php }?>                         
                </div>
            </div>
        </div>

        <?php
            require_once 'components/footer.php';  // ПОДКЛЮЧЕНИЕ ФУТЕРА
        ?>
        
    </div>       
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>