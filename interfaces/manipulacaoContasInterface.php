<?php
    interface AccountHandlingInterface {
        public function createAccount(PersonPhysical $person);
        public function deleteAccount(PersonPhysical $person);
        public function updateAccount(PersonPhysical  $person);
        public function login(PersonPhysical $person,string $pwd);
        public function isLogged();
    }
?>