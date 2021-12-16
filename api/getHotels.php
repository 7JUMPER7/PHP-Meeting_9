<?php
    include_once('./apiFunctions.php');
    include_once('../models/Hotel.php');
    $countryId = -1;
    $cityId = -1;
    if(isset($_GET['countryId'])) {
        $countryId = $_GET['countryId'];
    }
    if(isset($_GET['cityId'])) {
        $cityId = $_GET['cityId'];
    }
    $hotels = getHotels($countryId, $cityId);
    echo json_encode($hotels);
?>