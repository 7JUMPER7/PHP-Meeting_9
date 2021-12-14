<?php
    include_once('./apiFunctions.php');
    if(isset($_POST['city']) && isset($_POST['countryId'])) {
        echo json_encode(addCity($_POST['city'], $_POST['countryId']));
    }
?>