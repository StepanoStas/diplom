<?
require_once "connectDB.php";
session_start();
$tours_id = $_SESSION['tours_id'];
$user_id = $_SESSION['users']['id'];
$checkorder = mysqli_query($link, "SELECT * FROM `tours_order` WHERE `id_users`= '$user_id' AND `id_tours`= '$tours_id'");
if(mysqli_num_rows($checkorder)<1) {
    $order_tours = mysqli_query($link, "INSERT INTO `tours_order`(`id`, `id_users`, `id_tours`) VALUES (NULL ,'$user_id','$tours_id')");
}
echo json_encode($order_tours);