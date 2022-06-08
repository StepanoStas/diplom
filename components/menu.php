<div class="menu">
    <ul class="navbar">
        <li>
            <div class="logo">
                <a href="index.php">
                    <img src="assets/img/logo.png" alt="">
                </a>
            </div>
        </li>
        <li>
            <a href="country.php">Страны</a>
        </li>
        <li>
            <a href="help.php">Помощь</a>
        </li>
        <li>
            <a href="company.php">О компании</a>
        </li>
        <?php if($_SESSION['users']){?>
        <li>
            <a href="cabinet.php">Личный кабинет</a>
        </li>
        <li>
            <a href=" ../vendor/exit.php">Выйти</a>
        </li>
        <?php } else {?>
        <li>
            <a href="login.php">Войти в личный кабинет</a>
        </li>
        <?php }?>
        <li class="burg">
            <a href="#" id="menu_burger" class="icon">&#9776;</a>
        </li>
    </ul>
</div>