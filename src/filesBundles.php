<?php
require_once __DIR__ . "/config.php";

define(
    "BUNDLES_URL",
    [
        "dataTable" => 
        [
            "<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css'/>",
            "<script type='text/javascript' src='https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js'></script>",
        ],
        "alertify" =>
        [
            "<link rel='stylesheet' type='text/css' href= '" . renderUrl('src/assets/css/themes/default.min.css') ."'/>",
            "<link rel='stylesheet' type='text/css' href='" . renderUrl('src/assets/css/alertify.min.css') . "' />",
            "<script type='text/javascript' src='" . renderUrl('src/assets/js/alertify.min.js') . "'/></script>"
        ],
        "js/jquery" => "<script src='https://code.jquery.com/jquery-3.4.1.min.js' integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'></script>",
        "css/rsenha" => "<link rel='stylesheet' type='text/css' href='" . renderUrl('src/assets/css/rsenha.css') . "'/>",
        "css/card" => " <link rel='stylesheet' type='text/css' href='" . renderUrl('src/assets/css/cad.css') . "'/>",
        "css/manipulation" => "<link rel='stylesheet' type='text/css' href='" . renderUrl('src/assets/css/manipulation.css') . "'/>",
        "js/manipulation" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/manipulation.js') . "'></script>",
        "js/apis" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/apis.js') . "'></script>",
        "js/regAjax" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/reqAjax.js') . "'></script>",
        "js/mainMethods" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/mainMethods.js') . "'></script>",
        "js/recoverPasswd" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/recoverpasswd.js') . "'></script>",
        "js/register" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/register.js') . "'></script>",
        "js/home" => "<script type='text/javascript' src='" . renderUrl('src/assets/js/home.js') . "'></script>",
        "facebookButton" => "<script async defer crossorigin='anonymous' src='https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=250815926067653&autoLogAppEvents=1'></script>"
    ]
);
