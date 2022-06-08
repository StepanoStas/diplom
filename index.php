<?php
session_start();
require_once "vendor/connectDB.php";
$citiesquery = mysqli_query($link, "SELECT * FROM `cities`");
$countryquery = mysqli_query($link, "SELECT * FROM `country`");
$hotelsquery = mysqli_query($link, "SELECT * FROM `hotels`");
$toursquery = mysqli_query($link, "SELECT `tours`.*, `country`.`name` AS `Country`
FROM `tours` 
	LEFT JOIN `country` ON `tours`.`id_country` = `country`.`id`;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/require.css">
    <title>Главная</title>
</head>
<body>
                
<div class="full">
    <?php
        require_once 'components/menu.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ
    ?>

    <!-- Блок поиска тура -->
    <div class="tours-header">
        <div class="tours-search">
            <div class="title">
                <h2>Вас приветствует турагентство Магнолия, у нас огромный выбор туров по разным странам из разных городов России!</h2>
                <p>Ещё не выбрали место для отдыха? Это не проблема! Нужно лишь указать основные параметры поиска и Мы поможем Вам подобрать тур! </p>
            </div>

            <div class="tours-search-inner">
                <div class="select-container"> 
                    <div class="select-title">
                        <p>Город вылета</p>
                    </div>
                    <div class="select">
                        <select id="city_name" name="select">
                        <?php while($cities = mysqli_fetch_assoc($citiesquery)){ ?>
                            <option value="<?php echo $cities['id']?>"><?php echo $cities['name']?></option>
                        <?php }?>
                        </select>
                    </div> 
                </div>
                <div class="select-container"> 
                    <div class="select-title">
                        <p>Страна</p>
                    </div>
                    <div class="select">
                        <select id="country_name" name="select">
                        <?php while($country = mysqli_fetch_assoc($countryquery)){ ?>
                            <option value="<?php echo $country['id']?>"><?php echo $country['name']?></option>
                            <?php }?>
                        </select>
                    </div> 
                </div>
                <div class="select-container"> 
                    <div class="select-title">
                        <p>Дата вылета</p>
                    </div>
                    <div class="select">
                        <input id="departure_date" type="date">
                    </div> 
                </div>
                <div class="select-container"> 
                    <div class="select-title">
                        <p>Количество ночей</p>
                    </div>
                    <div class="select">
                        <select id="nights" name="select">
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7 и более</option>
                        </select>
                    </div> 
                </div>
                <div class="search-button">
                    <div></div>
                    <button id="tour_search" class="tour-search">Поиск</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Список туров -->
    <div class="tours-container"></div>

    <div class="top-tours-container">
        <div class="top-tours-container-title">
            <h1>Горящие туры</h1>
        </div>
        <div class="top-tours-block">
            <?php while($tours = mysqli_fetch_assoc($toursquery)){ ?>
                <div class="top-tours-block-inner">
                    <div class="top-tours-img">
                        <img src="assets/img/tours/<?php echo $tours['img']?>" alt="">
                    </div>
                    <div class="top-tours-short-desc">
                            <p>ОТ <?php echo $tours['price']?>  ₽</p>
                    </div>
                    <div class="top-tours-title">
                        <h3><?php echo $tours['name']?></h3>
                        <div class="top-tours-flex">
                            <div class="top-tours-title-flex">
                                <img src="assets/img/icons/country.png" alt="">
                                <p><?php echo $tours['Country']?></p>
                            </div>
                            <div class="top-tours-title-flex">
                                <p class="center"><?php echo $tours['nights']?></p>
                                <img class="calendar" src="assets/img/icons/moon.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="/toursPage.php?id=<?php echo $tours['id']?>">Подробнее</a>
                    </div>
                </div>  
            <?php }?>                 
        </div>
    </div>

    <div class="feedback">
        <div class="feedback-inner">
            <div class="feedback-header">
                <h2>Заполните форму и наш специалист свяжется с вами, чтобы записать вас на консультацию в любой из наших офисов!</h2>
            </div>
            <div class="feedback-form">
                <form class="f-form" action="">
                    <div class="feedback-form-container">
                        <input placeholder="Ваше имя" type="text">
                    </div>
                    <div class="feedback-form-container">
                        <input placeholder="Номер телефона" type="text">
                    </div>
                    <div class="feedback-form-container">
                        <input placeholder="Ваш e-mail адрес" type="text">
                    </div>
                    <div class="feedback-form-container">
                        <select placeholder="Ваш e-mail адрес" name="" id="">
                            <option value="Красный путь">Красный путь</option>
                            <option value="Проспект Мира">Проспект Мира</option>
                        </select>
                    </div>
                    <div class="feedback-form-container">
                        <button id="send_message">Отправить заявку</button>
                    </div>
                </form>
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