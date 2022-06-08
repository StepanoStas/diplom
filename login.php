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
    <title>Вход в личный кабинет</title>
</head>
<body>
    <div class="login-form">
        <h2>Вход в личный кабинет</h2>
        <form class="login" action="vendor/loginAction.php" method="POST">
            <div class="container">
                <input type="text" name="email" required placeholder="Введите email">
                <input type="password" name = "password" required placeholder="Введите пароль">
                <button class="submit-log-reg" type="submit" name="submit_login" >Войти</button>
                <span class="psw">Ещё не зарегистрировались?
                    <a href="registration.php">Кликните здесь</a>
                </span>
                <div>
                    <a href="index.php">Вернуться на главную</a>
                </div>
            </div>
        </form>
        <span class="complete-reg">
            <?php echo $_SESSION['complete_reg'];
            unset ($_SESSION['complete_reg']);?>
        </span>
        <span class="error-login">
            <?php echo $_SESSION['error_login'];
            unset ($_SESSION['error_login']);?>
        </span>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>