<?php 
use Src\Config;
use Src\Routes;
use Src\AltoRouterTrsoares;

// ARQUIVOS DE CONFIG DO APP
$config = Config::load('config/app.php');
define("APP_NAME", $config->app->name);
define("ROOT", __DIR__ ."");
define("HTTP", ($_SERVER["SERVER_NAME"] == "localhost") ? "http://localhost".$config->app->basePath : $config->app->url.$config->app->basePath
);
setlocale(LC_ALL, $config->app->locale);
date_default_timezone_set($config->app->timezone);
ini_set('display_errors', $config->app->debug);

// CLASSE DE ROTEAMENTO 
$router = new AltoRouterTrsoares();
$router->setBasePath($config->app->basePath);

// MAPEAMENTO DAS ROTAS
$map = Routes::loadWeb();
$router->addRoutes($map->routes);

// PROCURA ROTA VALIDA
$match = $router->match();

if($match) {
	if($match['target']['controller'] <> 'Auth') {
		$controller = $config->controller->folder . $match['target']['controller'];
	} else {
		$controller = 'Src\\'.$match['target']['controller'];
	}
	$action = $match['target']['method'];
	$params = $match['params'];

	if(!empty($match['can'])) {
		$ids = array_map(function($v) {
			return $v->id;
		}, $_SESSION['auth']->values->acl);
		if(in_array($match['can'], $ids)) {
			$object = new $controller();
			$object->{$action}($params);
		} else {
			if($config->app->pageForbidden <> '') {
				header('Location: '.HTTP.'/forbidden');
			} else {
				header("HTTP/1.0 403 Forbidden");
			}
		}
	} else {
		$object = new $controller();
		$object->{$action}($params);
	}
	
} else {
	if($config->app->pageNotFound <> '') {
		header('Location: '.HTTP.'/notfound');
	} else {
		header("HTTP/1.0 404 Not Found");
	}
}

