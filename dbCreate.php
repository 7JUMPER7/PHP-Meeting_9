<?php
    include_once('functions.php');
    
    $query1 = "CREATE TABLE Countries(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Country VARCHAR(40) NOT NULL
    );";
    $query2 = "CREATE TABLE Cities(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        City VARCHAR(30) NOT NULL,
        CountryId INT,
        FOREIGN KEY (CountryId) REFERENCES Countries(Id) ON DELETE SET NULL
    );";
    $query3 = "CREATE TABLE Hotels(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Hotel VARCHAR(40) NOT NULL,
        CityId INT,
        Stars INT,
        Price DOUBLE,
        Description TEXT,
        FOREIGN KEY (CityId) REFERENCES Cities(Id) ON DELETE SET NULL
    );";
    $query4 = "CREATE TABLE Images(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        HotelId INT,
        Path VARCHAR(300),
        FOREIGN KEY (HotelId) REFERENCES Hotels(Id) ON DELETE SET NULL
    );";
    $query5 = "CREATE TABLE Roles(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Role VARCHAR(20) NOT NULL UNIQUE
    );";
    $query6 = "CREATE TABLE Users(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Login VARCHAR(30) NOT NULL UNIQUE,
        Password VARCHAR(20) NOT NULL,
        Email VARCHAR(60) NOT NULL,
        Discount DOUBLE DEFAULT 0,
        Avatar MEDIUMBLOB,
        RoleId INT NOT NULL,
        FOREIGN KEY (RoleId) REFERENCES Roles(Id) ON DELETE CASCADE
    );";

    $res = connect('localhost', 'root', '', 'agencydb');
    if($res) {
        createDb($res, $query1, $query2, $query3, $query4, $query5, $query6);
        mysqli_close($res);
    }
?>