<?php
session_start();
if($_SESSION['users']){
    unset($_SESSION['users']);
    header('Location: ../index.php');
}
?>