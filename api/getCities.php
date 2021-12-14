<?php
    include_once('./apiFunctions.php');
    include_once('../models/City.php');
    $cities = getCities();
    echo json_encode($cities);
?>