<?php

namespace Ecomais\Web;

use Exception;

use function PHPUnit\Framework\callback;

class Bundles
{
    private static function typePath(): string
    {
        $typePath = array(
            "windows" => "\\",
            "linux" => "/",
            "macintosh" => "/"
        );
        preg_match("/(windows|linux|macintosh)/", strtolower($_SERVER["HTTP_USER_AGENT"]), $res);
        return $typePath[$res[1]] ?? "";
    }

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
    public static function render(array $fileNames,callable $callback, string $dir = ""): void
    {
        $path_absolute = dirname(__DIR__,1) . "/$dir";
        $typePath = static::typePath();

        if (!file_exists($path_absolute)) throw new Exception("Directory not found");
        

        if (!empty($typePath) && strcmp($path_absolute[strlen($path_absolute) - 1], $typePath) != 0) 
            $path_absolute =  "$path_absolute$typePath";

        foreach ($fileNames as $fileName) :
            $pathInfo = pathinfo($fileName);
            static::foreachPath("/$dir",$pathInfo,$callback);
        endforeach;
    }

    private static function foreachPath(string $dir,array $fileName, callable $callback)
    {
        $path_absolute = dirname(__DIR__,1) . $dir;
        $typePath = static::typePath();

        if (!empty($typePath) && strcmp($path_absolute[strlen($path_absolute) - 1], $typePath) != 0) 
            $path_absolute =  "$path_absolute$typePath";

        foreach (scandir($path_absolute, 1) as $item) :
            if (strcasecmp($item, ".") == 0 || strcasecmp($item, "..") == 0) continue;

            if (is_dir("$path_absolute$item")) static::foreachPath("$dir$item/", $fileName, $callback);
    
            $pathInfo = pathinfo("$path_absolute$item");
            if ( file_exists("$path_absolute$item") && is_file("$path_absolute$item")
                && strcasecmp($pathInfo["filename"], $fileName["filename"]) == 0 && strcasecmp($pathInfo["extension"], $fileName["extension"]) == 0) {
                $callback(BASE_URL . "/src$dir$item");
            };

        endforeach;
    }
}
