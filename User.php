<?php
    class User {
        private $Login;
        private $Email;
        private $Password;
        private $RoleId;

        function __construct($Login, $Email, $Password, $RoleId=1) {
            $this->Login = $Login;
            $this->Email = $Email;
            $this->Password = $Password;
            $this->RoleId = $RoleId;
        }

        function getLogin() {
            return $this->Login;
        }
        function getEmail() {
            return $this->Email;
        }
        function getPassword() {
            return $this->Password;
        }
        function getRoleId() {
            return $this->RoleId;
        }
    }
?>