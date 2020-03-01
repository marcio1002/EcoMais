<?php 

    function read_code($ean) {
        try{
            if((!preg_match("/^[0-9]{13}$/",$ean)) ||(strlen($ean) < 13) ) throw new Exception("O código EAN13 não possui esse tipo de formato");
            $digits = str_split($ean);
            $sum = 0;
            foreach($digits as $k => $digit) {
                $sum += ($k === 0) ? $digit * 1 : $digit *2;
            }

            $res = floor($sum / 10);
            $res *= 10;
            $res -= $sum;

            $ean = (($res % 10) === 0 ) ? $ean = $ean.'0' :  $ean = $ean.$res;

            return $ean;
        }catch(Exception $erro) {
            
            die($erro->getMessage());
        }
    }

    echo read_code('789100031550');
    
?>