<?php
echo 1111;
exit;
spl_autoload_register(function ($name) {
	$name = ltrim($name, "\\");
	$name = str_replace("\\", "/", $name);
	$filepath = $name . '.php';
	if (file_exists(__DIR__ . '/' . $filepath))  require_once __DIR__ . '/' . $filepath;
});

$app = new \Controllers\Routs;
$app->rout();