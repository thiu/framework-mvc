<?php 

namespace Routes;

use Src\Routes;

class Web extends Routes
{
	public $routes = []; 

	public function __construct() {
		// ROTAS 
        $this->routes[] = Routes::get('', 'WelcomeController@index', 'welcome_index');

	    // session_start();
	    // if(isset($_SESSION['auth'])) {
		// 		ROTAS COM AUTENTICAÇÃO
	    // 		$this->routes[] = Routes::get('', 'WelcomeController@index', 'welcome_index', 1);
	    // 		$this->routes[] = Routes::get('', 'WelcomeController@index', 'welcome_index', $_SESSION['auth']->isAdmin() ? '' : 1);
	    // }
    }
}

