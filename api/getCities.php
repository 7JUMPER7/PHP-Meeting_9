<?php
    include_once('./apiFunctions.php');
    include_once('../models/City.php');
    $countryId = -1;
    if(isset($_GET['countryId'])) {
        $countryId = $_GET['countryId'];
    }
    $cities = getCities($countryId);
    echo json_encode($cities);
?>