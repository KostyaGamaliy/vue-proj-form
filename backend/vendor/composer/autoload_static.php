<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit51aa9f56a3f4dffdb194fa570bfbe6e4
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
        '0a081997434fd9337920700905639534' => __DIR__ . '/..' . '/wanfeiyy/dd/src/Dd/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Validations\\' => 12,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'D' => 
        array (
            'Dd\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Validations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Validations',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'Dd\\' => 
        array (
            0 => __DIR__ . '/..' . '/wanfeiyy/dd/src/Dd',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit51aa9f56a3f4dffdb194fa570bfbe6e4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit51aa9f56a3f4dffdb194fa570bfbe6e4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit51aa9f56a3f4dffdb194fa570bfbe6e4::$classMap;

        }, null, ClassLoader::class);
    }
}
