<?php

namespace App\Http\Controllers;

use Src\Controller;
use Src\Auth;

class AuthController extends Controller
{
	public function index()
	{
		return $this->view('login.index');
	}

	public function entrar()
	{
		(new Auth)->login('App\Model\Usuario', $_POST)->acl('App\Model\Acesso');

		if($_SESSION['auth']) {
			return $this->redirect('ocorrencias');
		} else {
			return $this->redirect('');
		}
	}

	public function sair()
	{
		session_destroy();
		return $this->redirect('');
	}
}