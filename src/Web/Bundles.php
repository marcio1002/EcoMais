<?php
namespace Ecomais\Web;

class Bundles
{
    private static array $import = BUNDLES_URL;
    private static  string $renderFile;


    /**
     * @param array  $urlName
     * @return string
     */
    public static  function  renderCss(array $urlName): string
    {
        self::$renderFile = "";
        
        foreach ($urlName as $url) {

            if (empty(self::$import[$url])) continue;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    self::$renderFile .= $r . PHP_EOL;
                }
            } else {
                self::$renderFile .= self::$import[$url] . PHP_EOL;
            }

        }
        return self::$renderFile;
    }

    public static  function  renderJs(array $urlName): string
    {
        self::$renderFile = "";
        foreach ($urlName as $url) {

            if (empty(self::$import[$url])) continue;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    self::$renderFile .= $r . PHP_EOL;
                }
            } else {
                self::$renderFile .= self::$import[$url] . PHP_EOL;
            }

        }
        return self::$renderFile;
    }
    
    public static  function  renderBundle(array $urlName): string
    {
        self::$renderFile = "";
        foreach ($urlName as $url) {

            if (empty(self::$import[$url])) continue;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    self::$renderFile .= $r . PHP_EOL;
                }
            } else {
                self::$renderFile .= self::$import[$url] . PHP_EOL;
            }
        }
        return self::$renderFile;
    }
}
