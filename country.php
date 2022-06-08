<?php
session_start();
require_once "vendor/connectDB.php";
$countryquery = mysqli_query($link, "SELECT * FROM `country`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/require.css">
    <title>Страны</title>
</head>
<body>
    
<div class="full">
    <?php
            require_once 'components/menu.php';  // ПОДКЛЮЧЕНИЕ ОСНОВНОГО МЕНЮ ИЗ ПАПКИ CSS
    ?>

        <!-- СПИСОК СТРАН -->

    <div class="country">
        <div class="title-page">
            <h1>Страны</h1>
        </div>
                    <!-- Вывод стран из бд на страницу -->
        <?php
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }

        $size_page = 4;
        $offset = ($pageno-1) * $size_page;

        $pages_sql = "SELECT COUNT(*) FROM `country`";
        $result = mysqli_query($link, $pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $size_page);

        $sql = "SELECT * FROM `country` LIMIT $offset, $size_page";

        $countryquery = mysqli_query($link, $sql);
        ?>
        <?php while($country = mysqli_fetch_assoc($countryquery)){ ?>
            <div class="country-container">
                <div class="country-container-name">
                    <a href="/countryPage.php?id=<?php echo $country['id']?>"><?php echo $country['name']?></a>
                </div>
                <div class="country-info">
                    <div class="country-flag">
                        <img src="assets/img/flags/<?php echo $country['img']?>" alt="">
                    </div>
                    <div class="country-description">
                        <p><?php echo $country['description']?></p>
                    </div>
                    <div class="country-cost">
                        <p>От <?php echo $country['cost']?> ₽ / чел.</p>
                    </div>
                </div>
            </div>
            <?php }?>
            <?php
                mysqli_close($link);
            ?>
        <div class="pagination-block">
            <ul class="pagination">
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Предыдущая страница</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Следующая страница</a>
                </li>
            </ul>
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