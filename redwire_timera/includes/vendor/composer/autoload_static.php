<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit047b9536273ba7a50543a353219b9f65
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Timber\\' => 7,
        ),
        'S' => 
        array (
            'Solution10\\Calendar\\Tests\\' => 26,
            'Solution10\\Calendar\\' => 20,
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
        'Timber\\' => 
        array (
            0 => __DIR__ . '/..' . '/timber/timber/lib',
        ),
        'Solution10\\Calendar\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/solution10/calendar/tests',
        ),
        'Solution10\\Calendar\\' => 
        array (
            0 => __DIR__ . '/..' . '/solution10/calendar/src',
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit047b9536273ba7a50543a353219b9f65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit047b9536273ba7a50543a353219b9f65::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit047b9536273ba7a50543a353219b9f65::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit047b9536273ba7a50543a353219b9f65::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit047b9536273ba7a50543a353219b9f65::$classMap;

        }, null, ClassLoader::class);
    }
}
