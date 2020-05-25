<?php

define("BASE_URL", "http://www.localhost:26011/www/EcoMais");
echo "
<script type='text/javascript'>
    const BASE_URL = '". BASE_URL ."';
</script>";


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-PINGARUNER');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Content-type: text/html');
