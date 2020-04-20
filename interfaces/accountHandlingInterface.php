<?php
namespace Interfaces;
        
    use Model;

    interface AccountHandlingInterface {
        public function createAccount(Model\PersonPhysical $person);
        public function deleteAccount(Model\PersonPhysical $person);
        public function updateAccount(Model\PersonPhysical  $person);
        public function setLogin(Model\PersonPhysical $person);
        public function isLogged();
    }
?>