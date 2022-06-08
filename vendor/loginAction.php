<?php
session_start();
require_once "connectDB.php";
$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);


            // РЕГИСТРАЦИЯ

if(isset($_POST['reg'])) {
    $checkemail = mysqli_query($link, "SELECT * FROM `users` WHERE `email`= '$email'") ;
    if(($password === $confirm_password) && (mysqli_num_rows($checkemail)<1)) {
        mysqli_query($link, "INSERT INTO `users`(`id`, `name`, `surname`, `patronymic`, `mobile`, `email`, `password`) VALUES (NULL,'$name', '$surname', '$patronymic', '$mobile', '$email', '$password')");
        $_SESSION['complete_reg'] = 'Регистрация прошла успешно!';
        header('Location: ../login.php');
    } else if(mysqli_num_rows($checkemail)>0) {
        $_SESSION['error_email']= " Пользователь с email: ".$email." уже существует";
        header("Location:".$_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION ['error']= "Пароли не совпадают ";
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
}


            // АВТОРИЗАЦИЯ

if(isset($_POST['submit_login'])) {
    $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE  `email` = '$email' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['users'] = [
            "id" => $user['id'],
            "email" => $user['email'],
            "password" => $user['password'],
        ];
        header('Location: ../cabinet.php');
    } else {
        $_SESSION['error_login'] = 'Неверный email или пароль';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
            