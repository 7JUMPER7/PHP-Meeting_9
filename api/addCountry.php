<?php
    include_once('./apiFunctions.php');
    if(isset($_POST['country'])) {
        echo json_encode(addCountry($_POST['country']));
    }
?>