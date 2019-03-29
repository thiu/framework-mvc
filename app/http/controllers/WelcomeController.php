<?php

namespace App\Http\Controllers;

use Src\Controller;

class WelcomeController extends Controller
{
	public function index()
	{
		$array = [1=>'Contoller', 2=>'Exemplo'];
		return $this->view('welcome.index', compact('array'));
	}
}