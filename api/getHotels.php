<?php
    include_once('./apiFunctions.php');
    include_once('../models/Hotel.php');
    $hotels = getHotels();
    echo json_encode($hotels);
?>