<?php
    include_once('./apiFunctions.php');
    if(isset($_POST['hotel']) && isset($_POST['cityId']) && isset($_POST['price']) && isset($_POST['description'])) {
        echo json_encode(addHotel($_POST['hotel'], $_POST['cityId'], $_POST['price'], $_POST['description']));
    }
?>