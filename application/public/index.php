<?php

include_once __DIR__ . '/../../vendor/autoload.php';

$file = new \App\File\Exists();
print $file->run();