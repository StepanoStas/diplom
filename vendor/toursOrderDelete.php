<?
require_once "connectDB.php";
session_start();
$tours_id = $_SESSION['tours_id'];
$user_id = $_SESSION['users']['id'];
$deleteorder = mysqli_query($link, "DELETE FROM `tours_order` WHERE `id_users`='$user_id' AND `id_tours` = '$tours_id'");
