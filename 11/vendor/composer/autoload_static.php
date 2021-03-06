<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5e683f0d53a5826b5395dad44d087a7e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5e683f0d53a5826b5395dad44d087a7e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5e683f0d53a5826b5395dad44d087a7e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
