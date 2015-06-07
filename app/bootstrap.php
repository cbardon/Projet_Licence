<?
require_once __DIR__.'/../vendor/silex.phar';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->registerNamespace('Acme', __DIR__.'/../src');

$loader->register();

return $loader;