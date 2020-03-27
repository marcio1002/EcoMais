<?php
    require_once "../model/personPhysicalModel.class.php";
    interface AccountHandlingInterface {
        public function createAccount(PersonPhysical $person);
        public function deleteAccount(PersonPhysical $person);
        public function updateAccount(PersonPhysical  $person);
        public function login();
        public function isAdmin();
    }
?>