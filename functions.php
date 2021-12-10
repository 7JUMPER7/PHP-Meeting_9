<?php
    function connect($host, $user, $password, $dbname) {
        $res = mysqli_connect($host, $user, $password);
        if($res) {
            if(mysqli_select_db($res, $dbname)) {
                return $res;
            } else {
                $err = mysqli_errno($res);
                if($err == 1049) {
                    echo "<div>База данных не существует</div>";
                }
                echo "<div>$err</div>";
                return null;
            }
        }
    }

    function createDb($db, ...$queries) {
        $errors = false;
        foreach($queries as $k => $v) {
            mysqli_query($db, $v);
            $err = mysqli_errno($db);
            if($err) {
                echo "<div>$k. $err</div>";
                $errors = true;
            }
        }
        return $errors;
    }
?>