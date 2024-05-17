<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit17eccde803085ea2278571bdf633970c
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReallySimpleJWT\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReallySimpleJWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/reallysimplejwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit17eccde803085ea2278571bdf633970c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit17eccde803085ea2278571bdf633970c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit17eccde803085ea2278571bdf633970c::$classMap;

        }, null, ClassLoader::class);
    }
}
