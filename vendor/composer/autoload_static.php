<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd6d6b0a911340491f93abf84b8dd6f78
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd6d6b0a911340491f93abf84b8dd6f78::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd6d6b0a911340491f93abf84b8dd6f78::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
