<?php
    class Country {
        public $Id;
        public $Country;

        function __construct($Id, $Country) {
            $this->Id = $Id;
            $this->Country = $Country;
        }
    }
?>