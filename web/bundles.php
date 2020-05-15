<?php

namespace  Web;

class Bundles
{

    private static $import = BUNDLES_URL;

    /**
     * @param array  $urlName
     * @return void
     */
    public static  function  renderCss(array $urlName): void
    {
        if(empty($urlName) ) return;

        foreach ($urlName as $url) {

            if( empty( self::$import[$url] ) ) return;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    echo "$r\n";
                }
            } else {
                $r = self::$import[$url];
                echo "$r\n";
            }
        }
    }

    public static  function  renderJs(array $urlName): void
    {
        if(empty($urlName)) return;

        foreach ($urlName as $url) {

            if( empty( self::$import[$url] ) ) return;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    echo "$r\n";
                }
            } else {
                $r = self::$import[$url];
                echo "$r\n";
            }
        }
    }
}
