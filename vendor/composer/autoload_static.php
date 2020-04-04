<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2bb3e0c5819d126736f65318d6fedcb6
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'server\\' => 7,
        ),
        'm' => 
        array (
            'model\\' => 6,
        ),
        'c' => 
        array (
            'controller\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'server\\' => 
        array (
            0 => __DIR__ . '/../..' . '/server',
        ),
        'model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Model',
        ),
        'controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2bb3e0c5819d126736f65318d6fedcb6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2bb3e0c5819d126736f65318d6fedcb6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
