<?php
session_start();
require_once "connectDB.php";
$city_id = $_POST['city_id'];
$country_id = $_POST['country_id'];
$departure_date = $_POST['departure_date'];
$nights = $_POST['nights'];
$result_tour = mysqli_query($link, "SELECT `tours`.*, `cities`.`name` AS `Cities`, `country`.`name` AS `Country`
FROM `tours` 
	LEFT JOIN `cities` ON `tours`.`id_cities` = `cities`.`id` 
	LEFT JOIN `country` ON `tours`.`id_country` = `country`.`id`
    WHERE `tours`.`id_cities` = '$city_id' AND `tours`.`id_country` = '$country_id' AND `departure_date` = '$departure_date'
     AND `nights` = '$nights'");

if(mysqli_num_rows($result_tour)) {
    for($i = 0; $i < mysqli_num_rows($result_tour); $i++) {
        $tour = mysqli_fetch_assoc($result_tour);
        $tour_objects[] = $tour;
    }
}
echo json_encode($tour_objects);
