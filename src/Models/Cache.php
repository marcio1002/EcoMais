<?php
namespace Ecomais\Models;

class Cache {

  protected static  string $time = "500";

  protected static string $folder = __DIR__ . "/src/cache";

  protected static Implementation $implements;

  public function __construct($folder)
  {
    if(is_dir($folder)) static::$folder = $folder;
    static::$implements = new Implementation;
  }


  protected static function generateFileLocation($key): string
  {
    return static::$folder . hash("sha256",$key) . ".txt";
  }

  protected  function createCache(string $key, $content): bool
  {
    $fileLocation = $this->generateFileLocation($key);

    return file_put_contents($fileLocation, $content) ? true : false;
  }

  public function save(string $key, string $content, $time = null): bool
  {
    $contents = array(
      $time => !is_null($time) ? $time : static::$time,
      $content => $content
    );


    return $this->createCache($key, $contents);
  }

  public function read(string $key)
  {
    $fileLocation = $this->generateFileLocation($key);
    
    $file = fopen($fileLocation,"r");

    while(!feof($content = fgets($file))) $contents = $content;

    fclose($file);
    return $contents ?? null;
  }

}