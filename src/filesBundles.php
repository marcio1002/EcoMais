<?php
require_once __DIR__ . "/config.php";

define(
    "BUNDLES_URL",
    [
        /*-- css --*/
        "css/rsenha" => "<link rel='stylesheet' type='text/css' href='" . renderUrl('/src/assets/css/rsenha.css') . "'>",
        "css/card" => " <link rel='stylesheet' type='text/css' href='" . renderUrl('/src/assets/css/cad.css') . "'>",
        "css/manipulation" => "<link rel='stylesheet' type='text/css' href='" . renderUrl('/src/assets/css/manipulation.css') . "'>",
        "css/eco/style" => "<link rel='stylesheet' type='text/css' href='" . renderUrl('/src/assets/css/eco.style.css') . "'>",
        "css/dataTable" => "<link rel='stylesheet' type='text/css' href='" . renderUrl("/src/assets/css/dataTable/themes/dataTables.bootstrap4.min.css") . "'>",
        "css/alertify" =>
        [
            "<link rel='stylesheet' type='text/css' href= '" . renderUrl('/src/assets/css/themes/default.min.css') ."'/>",
            "<link rel='stylesheet' type='text/css' href='" . renderUrl('/src/assets/css/themes/alertify.min.css') . "' />",
        ],
        "css/bootstrap" => 
        [
            "<link rel='stylesheet' href= '" . renderUrl('/src/assets/css/bootstrap/bootstrap.min.css') . "' >",
            "<link rel='stylesheet' href= '" . renderUrl('/src/assets/css/bootstrap/bootstrap.min.css.map') . "' >",
            "<link rel='stylesheet' href= '" . renderUrl('/src/assets/css/bootstrap/bootstrap-reboot.min.css') . "' >",
            "<link rel='stylesheet' href= '" . renderUrl('/src/assets/css/bootstrap/bootstrap-reboot.min.css.map') . "' >",
            "<link rel='stylesheet' href= '" .renderUrl('/src/assets/css/bootstrap/bootstrap-grid.min.css') . "' >",
            "<link rel='stylesheet' href= '" .renderUrl('/src/assets/css/bootstrap/bootstrap-grid.min.css.map') . "' >",
        ],

        /*-- js --*/
        "js/bootstrap" => 
        [
            "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>",
            "<script src= '" . renderUrl('/src/assets/js/bootstrap/bootstrap.min.js') . "'></script>",
            "<script src= '" . renderUrl('/src/assets/js/bootstrap/bootstrap.min.js.map') . "'></script>",
            "<script src= '" . renderUrl('/src/assets/js/bootstrap/bootstrap.bundle.min.js') . "'></script>",
            "<script src= '" . renderUrl('/src/assets/js/bootstrap/bootstrap.bundle.min.js.map') . "'></script>",
        ],
        "js/dataTable" => 
        [
            "<script src='" . renderUrl('/src/assets/js/dataTable/datatables.min.js') . "'></script>",
            "<script src='" . renderUrl('/src/assets/js/dataTable/themes/dataTables.bootstrap4.min.js') . "'></script>",
        ],
        "fontawesome" => "<script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>",
        "js/jquery" => "<script src='" . renderUrl('/src/assets/js/jquery/jquery-3.5.1.min.js') . "' ></script>",
        "js/jqueryMask" => "<script src= '" . renderUrl('/src/assets/js/jquery/jquery.mask.js') . "' ></script>",
        "js/alertify" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/alertify.min.js') . "'></script>",
        "js/manipulation" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/manipulation.js') . "'></script>",
        "js/apis" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/apis.js') . "'></script>",
        "js/mainMethods" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/mainMethods.js') . "'></script>",
        "js/recoverPasswd" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/recoverpasswd.js') . "'></script>",
        "js/register" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/register.js') . "'></script>",
        "js/registerCompany" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/company/registerCompany.js') . "'></script>",
        "js/home" => "<script type='text/javascript' src='" . renderUrl('/src/assets/js/home.js') . "'></script>",
        "js/login" => "<script src= " . renderUrl("/src/assets/js/login.js") . " ></script>",
        "facebookButton" => "<script async defer crossorigin='anonymous' src='https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=250815926067653&autoLogAppEvents=1'></script>"
    ]
);
