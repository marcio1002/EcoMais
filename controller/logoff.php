<?php
    require_once __DIR__ . "/../vendor/autoload.php";

    $manager  = new Controller\AccountManager();

    $manager->logoff();