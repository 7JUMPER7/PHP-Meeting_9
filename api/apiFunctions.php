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

    function getCities() {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "SELECT Cities.Id, Cities.City, Countries.Country FROM Cities JOIN Countries ON Countries.Id = Cities.CountryId";
            $res = mysqli_query($db, $query);
            $cities = array();
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $city = new City($row['Id'], $row['City'], $row['Country']);
                $cities[] = $city;
            }
            mysqli_close($db);
            return $cities;
        }
        return null;
    }

    function addCountry($country) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "INSERT INTO Countries (Country) VALUES ('$country');";
            $res = mysqli_query($db, $query);
            mysqli_close($db);
            return $res;
        }
        return null;
    }

    function addCity($city, $countryId) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "INSERT INTO Cities (City, CountryId) VALUES ('$city', $countryId);";
            $res = mysqli_query($db, $query);
            mysqli_close($db);
            return $res;
        }
        return null;
    }

    function delete($table, $ids) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "DELETE FROM $table WHERE";
            $size = count($ids);
            for($i = 0; $i < $size; $i++) {
                if($i < $size - 1) {
                    $query .= " Id = ".$ids[$i]." OR";
                } else {
                    $query .= " Id = ".$ids[$i].";";
                }
            }
            $res = mysqli_query($db, $query);
            mysqli_close($db);
            return $res;
        }
        return null;
    }
?>