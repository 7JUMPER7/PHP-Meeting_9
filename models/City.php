<?php
    class City {
        public $Id;
        public $City;
        public $CountryId;

        function __construct($Id, $City, $CountryId) {
            $this->Id = $Id;
            $this->City = $City;
            $this->CountryId = $CountryId;
        }
    }
?>