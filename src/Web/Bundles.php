<?php
namespace Ecomais\Web;

class Bundles
{
    const LB = "<br/>";

    private static $import = BUNDLES_URL;
    private static  string $renderFile = "";

    /**
     * @param array  $urlName
     * @return string
     */
    public static  function  renderCss(array $urlName): void
    {
        foreach ($urlName as $url) {

            if (empty(self::$import[$url])) continue;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    self::$renderFile .= $r . PHP_EOL;
                }
            } else {
                $r = self::$import[$url];
                self::$renderFile .= $r . PHP_EOL;
            }

        }
        echo self::$renderFile;
    }

    public static  function  renderJs(array $urlName): void
    {
        foreach ($urlName as $url) {

            if (empty(self::$import[$url])) continue;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    self::$renderFile .= $r . PHP_EOL;
                }
            } else {
                $r = self::$import[$url];
                self::$renderFile .= $r . PHP_EOL;
            }

        }
        echo self::$renderFile;
    }
    
    public static  function  renderBundle(array $urlName): void
    {
        foreach ($urlName as $url) {

            if (empty(self::$import[$url])) continue;

            if (is_array(self::$import[$url])) {

                foreach (self::$import[$url] as $r) {

                    self::$renderFile .= $r . PHP_EOL;
                }
            } else {
                $r = self::$import[$url];
                self::$renderFile .= $r . PHP_EOL;
            }
        }
        echo self::$renderFile;
    }
}
