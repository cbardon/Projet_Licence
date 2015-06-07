// in /tests/bootstrap.php
<?

//require_once __DIR__ . '/../vendor/Silex/silex.phar';
$loader = require_once __DIR__.'/../app/bootstrap.php';

$loader->registerNamespace('Acme\\Tests', __DIR__);