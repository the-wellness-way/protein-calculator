<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit813f17beaab10bb6097e2de376ba7e3f
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

        spl_autoload_register(array('ComposerAutoloaderInit813f17beaab10bb6097e2de376ba7e3f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit813f17beaab10bb6097e2de376ba7e3f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit813f17beaab10bb6097e2de376ba7e3f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
