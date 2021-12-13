<?php
    include_once('../models/Country.php');
    include_once('../models/City.php');

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

    function getCountries() {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "SELECT * FROM Countries";
            $res = mysqli_query($db, $query);
            $countries = array();
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $country = new Country($row['Id'], $row['Country']);
                $countries[] = $country;
            }
            mysqli_close($db);
            return $countries;
        }
        return null;
    }
?>