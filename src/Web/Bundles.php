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

            if (empty(static::$import[$url])) continue;

            if (is_array(static::$import[$url])) {

                foreach (static::$import[$url] as $r) static::$renderFile .= $r . PHP_EOL;
            } else {
                static::$renderFile .= static::$import[$url] . PHP_EOL;
            }

        }
        return static::$renderFile;
    }

    public static  function  renderJs(array $urlName): string
    {
        static::$renderFile = "";
        foreach ($urlName as $url) {

            if (empty(static::$import[$url])) continue;

            if (is_array(static::$import[$url])) {

                foreach (static::$import[$url] as $r) static::$renderFile .= $r . PHP_EOL;
            } else {
                static::$renderFile .= static::$import[$url] . PHP_EOL;
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

                foreach (static::$import[$url] as $r) static::$renderFile .= $r . PHP_EOL;
            } else {
                self::$renderFile .= self::$import[$url] . PHP_EOL;
            }
        }
        return self::$renderFile;
    }
}
