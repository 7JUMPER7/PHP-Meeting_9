<?php
    include_once('./apiFunctions.php');
    if(isset($_POST['table']) && isset($_POST['ids'])) {
        echo json_encode(delete($_POST['table'], $_POST['ids']));
    }
?>