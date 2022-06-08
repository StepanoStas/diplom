<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/forms.css">
    <title>Регистрация</title>
</head>
<body>

        <div class="reg-form">
            <h2>Форма регистрации</h2>
            <form class="reg" action="vendor/loginAction.php" method="POST">
            <div class="container">
                <label><b>Введите имя</b></label>
                <input type="text" name="name" required placeholder="Имя">

                <label><b>Введите фамилию</b></label>
                <input type="text" name="surname" required placeholder="Фамилия">

                <label><b>Введите отчество</b></label>
                <input type="text" name="patronymic" required placeholder="Отчество">

                <label><b>Введите email</b></label>
                <input type="email" name="email" required placeholder="Почта">

                <label><b>Введите номер телефона</b></label>
                <input type="text" class="phone" id="phone" name="mobile" placeholder="+7(000)000-00-00" pattern="^\7\d{3}\d{7}$" value="7" maxlength="11">
            
                <label><b>Придумайте пароль</b></label>
                <input type="password" name ="password" required placeholder="Пароль">

                <label><b>Введите пароль ещё раз</b></label>
                <input type="password" name="confirm_password" required placeholder="Подтвердите пароль">
                <button class="submit-log-reg" type="submit" name="reg">Зарегестрироваться</button>

                <span class="psw">
                    <a href="index.php">Вернуться на главную</a>
                </span>
            </div>
        </form>
        <span class="error">
            <?php echo $_SESSION['error'];
            unset ($_SESSION['error']);?>
        </span>
        <span class="error-email">
            <?php echo $_SESSION['error_email'];
            unset ($_SESSION['error_email']);?>
        </span>
        </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>