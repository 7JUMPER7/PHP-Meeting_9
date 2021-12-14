<?php
    class City {
        public $Id;
        public $City;
        public $Country;

        function __construct($Id, $City, $Country) {
            $this->Id = $Id;
            $this->City = $City;
            $this->Country = $Country;
        }
    }
?>