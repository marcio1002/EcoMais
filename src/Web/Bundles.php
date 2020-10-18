<?php

namespace Ecomais\Web;

use Exception;

use function PHPUnit\Framework\callback;

class Bundles
{
    private static string $separator;
    private static string $path_absolute;

    /**
     * Busca o arquivo e passa para o callback. 
     * @param array $fileNames
     * Nomes do arquivo em um array
     * @param callable $callback
     * O função
     * @param string $dir
     * Diretório ou o caminho relativo
     * @return void
     */
    public static function render(array $fileNames, callable $callback, string $dir = ""): void
    {
        static::$separator = DIRECTORY_SEPARATOR;
        $dir = (substr($dir, 0, 1) === static::$separator) ? $dir :  static::$separator . $dir;
        static::$path_absolute = dirname(__DIR__, 1) . $dir;

        if (!file_exists(static::$path_absolute)) throw new Exception("Directory not found");


        if ((static::$path_absolute[strlen(static::$path_absolute) - 1] <=> static::$separator) != 0)
            static::$path_absolute .= static::$separator;

        foreach ($fileNames as $fileName) :
            $pathInfo = pathinfo($fileName);
            static::foreachPath($dir, $pathInfo, $callback);
        endforeach;
    }

    private static function foreachPath(string $dir, array $fileName, callable $callback)
    {
        static::setUpdatePath($dir);

        foreach (scandir(static::$path_absolute, 1) as $item) :
            if ($item === "." || $item === "..") continue;
            static::setUpdatePath($dir . static::$separator . $item);
            if (is_dir(static::$path_absolute)) {
                static::foreachPath($dir . static::$separator . $item, $fileName, $callback);
            }

            $pathInfo = pathinfo(static::$path_absolute);
            if (
                file_exists(static::$path_absolute) && is_file(static::$path_absolute) &&
                ($pathInfo["filename"] <=> $fileName["filename"]) == 0 &&
                ($pathInfo["extension"] <=> $fileName["extension"]) == 0
            ) {
                $callback(BASE_URL . static::$separator . "src$dir" . static::$separator . "$item");
            };

        endforeach;
    }


    private static function setUpdatePath(string $path): void
    {
        static::$path_absolute = (substr($path, 0, 1) === static::$separator) ? dirname(__DIR__, 1) . $path : dirname(__DIR__, 1) . static::$separator . $path;
    }
}
