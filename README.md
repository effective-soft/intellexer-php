Intellexer PHP SDK
=======

Provides easy-to-use wrappers for main Intellexer API semantics products.

Installing via composer:

```
composer require effective-soft/intellexer-php
```

Example usage:

```php
<?php
require_once 'vendor/autoload.php';

$intellexerClient = new \EffectiveSoft\Intellexer\IntellexerClient('YOUR_API_KEY');

$linguisticProcessor = new \EffectiveSoft\Intellexer\LinguisticProcessor($intellexerClient);
$url = 'https://www.intellexer.com/';
var_dump($linguisticProcessor->analyzeText(file_get_contents($url)));
```

Example usage with logger:

```php
<?php
require_once 'vendor/autoload.php';

$logFile = sprintf('%s/%s.log', sys_get_temp_dir() . DIRECTORY_SEPARATOR, 'intellexer_api');
$logger = new \Monolog\Logger('intellexerApi');
$logger->pushHandler(
    new \Monolog\Handler\StreamHandler(
        $logFile,
        \Monolog\Logger::DEBUG,
        null,
        0777
    )
);
$intellexerClient = new \EffectiveSoft\Intellexer\IntellexerClient('YOUR_API_KEY');
$intellexerClient->setLogger($logger);
$linguisticProcessor = new \EffectiveSoft\Intellexer\LinguisticProcessor($intellexerClient);
$url = 'https://www.intellexer.com/';
var_dump($linguisticProcessor->analyzeText(file_get_contents($url)));
var_dump(file_get_contents($logFile));
```
