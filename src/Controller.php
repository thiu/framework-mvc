<?php 

namespace Src;

use Src\Config;

class Controller extends Config
{
	public function __construct() {
        $config = Config::load('config/app.php');
		$this->folder = $config->view->folder;
    }
    
	public function view($path, $variables='')
	{
		$url = '';
		if(!empty($variables)) {
			foreach($variables as $key => $values) {
				$$key = $values;
			}
		}
		$path = explode('.', $path);
		foreach($path as $conc) {
			$url .= '/'.$conc;
		}
		require($this->folder.$url.'.php');
	}

	public function obView($path, $variables='')
	{
		ob_start();
		$this->view($path, $variables);
		$contents = ob_get_clean();
		return $contents;
	}

	public function redirect($path) 
	{
		return header('Location: '.HTTP.'/'.$path);
	}

	public function crypt($post, $field='')
	{
		if(empty($field)) {
			$password = password_hash($post['password'], PASSWORD_BCRYPT);
			$post['password'] = $password;
			return $post;
		} else {
			$password = password_hash($post[$field], PASSWORD_BCRYPT);
			$post[$field] = $password;
			return $post;
		}
		
	}
}