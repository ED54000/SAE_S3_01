<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb7e1957bf374afafec63fa76d2c63eb
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'iutnc\\touiter\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'iutnc\\touiter\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/pages/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbb7e1957bf374afafec63fa76d2c63eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbb7e1957bf374afafec63fa76d2c63eb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbb7e1957bf374afafec63fa76d2c63eb::$classMap;

        }, null, ClassLoader::class);
    }
}