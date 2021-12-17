<?php 
    class Hotel {
        public $Id;
        public $Hotel;
        public $City;
        public $Country;
        public $Stars;
        public $Price;
        public $ImagePath;

        function __construct($Id, $Hotel, $City, $Country, $Stars, $Price, $ImagePath) {
            $this->Id = $Id;
            $this->Hotel = $Hotel;
            $this->City = $City;
            $this->Country = $Country;
            $this->Stars = $Stars;
            $this->Price = $Price;
            $this->ImagePath = $ImagePath;
        }
    }
?>