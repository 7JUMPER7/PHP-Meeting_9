<?php
    include_once('./apiFunctions.php');
    include_once('../models/Country.php');
    $countries = getCountries();
    echo json_encode($countries);
?>