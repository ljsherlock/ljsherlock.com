<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit905c5404079bc6a73aab8815efa914e5
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Utils\\' => 6,
        ),
        'T' => 
        array (
            'Twig\\' => 5,
            'Timber\\' => 7,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Solution10\\Calendar\\Tests\\' => 26,
            'Solution10\\Calendar\\' => 20,
        ),
        'M' => 
        array (
            'MVC\\' => 4,
        ),
        'I' => 
        array (
            'Includes\\' => 9,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'Abraham\\TwitterOAuth\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Utils\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Utils',
        ),
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Timber\\' => 
        array (
            0 => __DIR__ . '/..' . '/timber/timber/lib',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Solution10\\Calendar\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/solution10/calendar/tests',
        ),
        'Solution10\\Calendar\\' => 
        array (
            0 => __DIR__ . '/..' . '/solution10/calendar/src',
        ),
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/MVC',
        ),
        'Includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Includes',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'Abraham\\TwitterOAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/abraham/twitteroauth/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/asm89/twig-cache-extension/lib',
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'R' => 
        array (
            'Routes' => 
            array (
                0 => __DIR__ . '/..' . '/upstatement/routes',
            ),
        ),
        'D' => 
        array (
            'Detection' => 
            array (
                0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/namespaced',
            ),
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Mobile_Detect' => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/Mobile_Detect.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit905c5404079bc6a73aab8815efa914e5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit905c5404079bc6a73aab8815efa914e5::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit905c5404079bc6a73aab8815efa914e5::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit905c5404079bc6a73aab8815efa914e5::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit905c5404079bc6a73aab8815efa914e5::$classMap;

        }, null, ClassLoader::class);
    }
}
