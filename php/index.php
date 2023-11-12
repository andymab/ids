<?php

if (!filter_input(INPUT_POST, 'photo')) {
	 	require "../dist/index.html";
	} else {
	spl_autoload_register(function ($name) {
		$name = ltrim($name, "\\");
		$name = str_replace("\\", "/", $name);
		$filepath = $name . '.php';
		if (file_exists(__DIR__ . '/' . $filepath)) {
			require_once __DIR__ . '/' . $filepath;
		} else {
			"Контроллер " . __DIR__ . '/' . $filepath . " не найден";
		}
	});

	$app = new \Controllers\Routs;
	$app->rout();
}
