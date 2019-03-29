<?php 

// $url = preg_match('/www/', $_SERVER['HTTP_HOST']) ? 'https://www.moraesvelleda.com.br' : 'https://moraesvelleda.com.br';

return [
	'app' => [
		'name' => 'Framework MV',
		'url'  => 'localhost',
		'basePath' => '/framework-mv',
		'timezone' => 'America/Sao_Paulo',
		'locale' => 'pt-BR.utf8',
		'pageNotFound' => 'errors.404',
		'pageForbidden' => 'errors.403',
		'debug' => true
	],
	'view' => [
		'folder' => 'resources/views',
	],
	'controller' => [
		'folder' => 'App\Http\Controllers\\'
	]
];
