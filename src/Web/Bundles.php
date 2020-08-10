<?php
namespace Ecomais\Web;

use Exception;

class Bundles
{
    private static  string $renderFile;

    /**
     * Renderiza um arquivo. 
     * Também busca o nível abaixo do que foi especificado com $pathLevels 
     * Não busca a mais que um nível abaixo. 
     * Se quer a mais que um nível abaixo especifique no $pathLevels sempre que possível
     * @param string $fileName
     * Nome do arquivo
     * @param string $ext
     * A extensão do arquivo
     * @param string $pathLevels
     * O nível do arquivo
     * @return string
     */
    public static function renderFile(string $fileName,string $ext = "php",string $pathLevels = "/assets"): string
    {
        if(!is_dir(dirname(__DIR__, 1) . "$pathLevels")) throw new Exception("It is not recognized as a directory");

        static::$renderFile = "";
        $pathDefault = dirname(__DIR__,1) . "$pathLevels";

        foreach(scandir($pathDefault) as $file) {
            if($file == "." || $file == "..") continue;

            $search = "$pathDefault/$file";

            if(is_dir($search)) {
                foreach(scandir($search) as $f) {
                    if($f == "." || $f == "..") continue;

                    $searchFile = "$search/$f";

                    $ext = !empty($ext) ? $ext : pathinfo($searchFile)["extension"];

                    if(is_file($searchFile) && pathinfo($searchFile)["extension"] == $ext) {
                        if(pathinfo($searchFile)["filename"] != $fileName) continue;
                        static::$renderFile = BASE_URL . "/src$pathLevels/$file/$f";
                        break;
                    }
                }
            }

            $ext = !empty($ext) ? $ext : pathinfo($search)["extension"];

            if(is_file($search) && pathinfo($search)["extension"] == $ext) {
                if(pathinfo($search)["filename"] != $fileName) continue;
                static::$renderFile = BASE_URL . "/src$pathLevels/$file";
                break;
            }
        }
        return static::$renderFile; 
    }

    /**
     * Renderiza um arquivo. 
     * Também busca o nível abaixo do que foi especificado com $pathLevels 
     * Não busca a mais que um nível abaixo. 
     * Se quer a mais que um nível abaixo especifique no $pathLevels sempre que possível
     * @param array $fileNames
     * Nomes dos arquivos
     * @param string $pathLevels
     * O nível do arquivo
     * @return string
     */
    public static function renderFileCss(array $fileNames,string $pathLevels = "/assets/css"): string
    {
        if(!is_dir(dirname(__DIR__, 1) . "$pathLevels")) throw new Exception("It is not recognized as a directory");

        static::$renderFile = "";
        $pathDefault = dirname(__DIR__,1) . "$pathLevels";
        
        foreach($fileNames as $name) {
            
            foreach(scandir($pathDefault) as $file) {
                if($file == "." || $file == "..") continue;
    
                $search = "$pathDefault/$file";
    
                if(is_dir($search)) {
                    foreach(scandir($search) as $f) {
                        if($f == "." || $f == "..") continue;
    
                        $searchFile = "$search/$f";
    
                        if(is_file($searchFile) && pathinfo($searchFile)["extension"] == "css") {
                            if(pathinfo($searchFile)["filename"] != $name) continue;
                            static::$renderFile .= "<link rel=\"stylesheet\" href=\"" . BASE_URL . "/src$pathLevels/$file/$f\" >". PHP_EOL;
                        }
                    }
                }
    
                if(is_file($search) && pathinfo($search)["extension"] == "css") {
                    if(pathinfo($search)["filename"] != $name) continue;
                    static::$renderFile .= "<link rel=\"stylesheet\" href=\"" . BASE_URL . "/src$pathLevels/$file\" >". PHP_EOL;
                }
            }
        }
        
        return static::$renderFile; 
    }

     /**
     * Renderiza um arquivo. 
     * Também busca o nível abaixo do que foi especificado com $pathLevels 
     * Não busca a mais que um nível abaixo. 
     * Se quer a mais que um nível abaixo especifique no $pathLevels sempre que possível
     * @param array $fileNames
     * Nomes dos arquivos
     * @param string $pathLevels
     * O nível do arquivo
     * @return string
     */
    public static function renderFileJs(array $fileNames,string $pathLevels = "/assets/js"): string
    {
        if(!is_dir(dirname(__DIR__, 1) . "$pathLevels")) throw new Exception("It is not recognized as a directory");

        static::$renderFile = "";
        $pathDefault = dirname(__DIR__,1) . "$pathLevels";
        
        foreach($fileNames as $name) {
            
            foreach(scandir($pathDefault) as $file) {
                if($file == "." || $file == "..") continue;
    
                $search = "$pathDefault/$file";
    
                if(is_dir($search)) {
                    foreach(scandir($search) as $f) {
                        if($f == "." || $f == "..") continue;
    
                        $searchFile = "$search/$f";
    
                        if(is_file($searchFile) && pathinfo($searchFile)["extension"] == "js") {
                            if(pathinfo($searchFile)["filename"] != $name) continue;
                            static::$renderFile .= " <script src=\"" . BASE_URL . "/src$pathLevels/$file/$f\" ></script>". PHP_EOL;
                        }
                    }
                }
    
                if(is_file($search) && pathinfo($search)["extension"] == "js") {
                    if(pathinfo($search)["filename"]!= $name) continue;
                    static::$renderFile .= " <script src=\"" . BASE_URL . "/src$pathLevels/$file\" ></script>". PHP_EOL;
                }
            }
        }
        
        return static::$renderFile; 
    }
}
