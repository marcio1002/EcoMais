<?php

namespace Bundles;

class Bundles
{

    private   $import = BUNDLES_URL;

    /**
     * @param array  $urlName
     * @return void
     */
    public  function  loadCss(array $urlName): void
    {
        if(empty($urlName) ) return;

        foreach ($urlName as $url) {

            if( empty( $this->import[$url] ) ) return;

            if (is_array($this->import[$url])) {

                foreach ($this->import[$url] as $r) {

                    echo "<link rel='stylesheet' href='$r'/>";
                }
            } else {
                $r = $this->import[$url];
                echo "<link rel='stylesheet' href='$r'/>";
            }
        }
    }

    public  function  loadJs(array $urlName): void
    {
        if(empty($urlName)) return;

        foreach ($urlName as $url) {

            if( empty( $this->import[$url] ) ) return;

            if (is_array($this->import[$url])) {

                foreach ($this->import[$url] as $r) {

                    echo " <script src='$r'></script>";
                }
            } else {
                $r = $this->import[$url];
                echo " <script src='$r'></script>";
            }
        }
    }
}
