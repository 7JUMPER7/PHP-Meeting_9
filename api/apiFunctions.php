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
    
    function getCities($countryId = -1) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "";
            if($countryId == -1) {
                $query = "SELECT Cities.Id, Cities.City, Countries.Country FROM Cities JOIN Countries ON Countries.Id = Cities.CountryId";
            } else {
                $query = "SELECT Cities.Id, Cities.City, Countries.Country FROM Cities JOIN Countries ON Countries.Id = Cities.CountryId WHERE CountryId = $countryId";
            }
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

    function getHotels($countryId = -1, $cityId = -1) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "SELECT h.Id, h.Hotel, cit.City, coun.Country, h.Stars, h.Price FROM Hotels AS h
            JOIN Cities AS cit ON cit.Id = h.CityId
            JOIN Countries AS coun ON coun.Id = cit.CountryId";

            if($cityId != -1) {
                $query .= " WHERE cit.Id = $cityId";
            } else {
                if($countryId != -1) {
                    $query .= " WHERE coun.Id = $countryId";
                }
            }
            

            $res = mysqli_query($db, $query);
            $hotels = [];
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $hotel = new Hotel($row['Id'], $row['Hotel'], $row['City'], $row['Country'], $row['Stars'], $row['Price']);
                $hotels[] = $hotel;
            }
            mysqli_close($db);
            return $hotels;
        }
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

    function addHotel($hotel, $cityId, $price, $description) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $query = "INSERT INTO Hotels (`Hotel`, `CityId`, `Price`, `Description`) VALUES ('$hotel',$cityId,$price,'$description')";
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