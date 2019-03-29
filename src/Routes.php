<?php

namespace Src;

use Routes\Web;

class Routes extends Controller
{
	public static function loadWeb()
	{
		$retorno = new Web;
		$retorno->routes[] = $retorno->get('notfound', 'Auth@notFound', 'page_notfound', 0);
		$retorno->routes[] = $retorno->get('forbidden', 'Auth@forbidden', 'page_forbidden', 0);
		return $retorno;
	}

	public function get($page, $controller, $name, $can='')
	{
		$controller = explode('@', $controller);
		$get = array('GET', '/'.$page, array('controller'=>$controller[0], 'method'=>$controller[1]), $name, $can);
		return $get;
	}

	public function post($page, $controller, $name, $can='')
	{
		$controller = explode('@', $controller);
		$post = array('POST', '/'.$page, array('controller'=>$controller[0], 'method'=>$controller[1]), $name, $can);
		return $post;
	}
}
