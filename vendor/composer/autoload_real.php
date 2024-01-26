<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbb7e1957bf374afafec63fa76d2c63eb
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitbb7e1957bf374afafec63fa76d2c63eb', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbb7e1957bf374afafec63fa76d2c63eb', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbb7e1957bf374afafec63fa76d2c63eb::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
