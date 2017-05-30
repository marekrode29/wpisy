<?php

include_once __DIR__ . '/../../vendor/autoload.php';

$slug = new \App\Zephir\Slug();
print $slug->run();