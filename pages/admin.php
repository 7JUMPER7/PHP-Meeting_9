<?php
    if(isset($_SESSION['user'])) {
        var_dump($_SESSION['user']);
        if($_SESSION['user']->getRoleId() == 2) {
            echo '<div>Admin panel</div>';
        } else {
            echo "<div class='alertMessage'>You are not allowed</div>";
        }
    } else {
        echo "<div class='alertMessage'>Log in first</div>";
    }
?>