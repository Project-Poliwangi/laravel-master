<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit32c92ff767602ad33e2aed5ed6968541
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Pengadaan\\' => 18,
            'Modules\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Pengadaan\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Modules/Pengadaan',
        ),
        'Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Modules',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit32c92ff767602ad33e2aed5ed6968541::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit32c92ff767602ad33e2aed5ed6968541::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit32c92ff767602ad33e2aed5ed6968541::$classMap;

        }, null, ClassLoader::class);
    }
}
