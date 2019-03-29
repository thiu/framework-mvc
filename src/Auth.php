<?php 

namespace Src;

use Src\DB;

class Auth extends Controller
{
	public $values; 

	public function __construct() {
        $this->config = Config::load('config/app.php');
        $this->folder = $this->config->view->folder;
    }

	public function login($class, $post, $username='', $password='')
	{
		session_start();
		session_destroy();
		$username = $username <> '' ? $username : 'email';
		$password = $password <> '' ? $password : 'password';
		$usuario = (new $class)->select()
							   ->where($username, '=', $_POST[$username])
							   ->get();
		if( $usuario->size() > 0 ) {
			if( password_verify($_POST[$password], $usuario->itens[0]->values->{$password}) ) {		
				$this->values = new \stdClass;
				$this->values->id = $usuario->itens[0]->values->id;
				$this->values->class = $class;
				foreach($usuario->itens[0]->fillable as $fillable) {
					$this->values->{$fillable} = $usuario->itens[0]->values->$fillable;
				}
				session_start();
				unset($this->config);
				unset($this->folder);
				$_SESSION['auth'] = $this;
				return $this;
			} else {
				session_start();
				$_SESSION['login_failed'] = 'wrong_pass';
				return $this;
			}
		} else {
			session_start();
			$_SESSION['login_failed'] = 'wrong_user';
			return $this;
		}
	}

    public function acl($class, $table='', $fieldClass='', $field='')
    {
    	if(isset($_SESSION['auth'])) {
    		$usuario = (new $_SESSION['auth']->values->class)->select(['id'])
    													->where('id', '=', $_SESSION['auth']->values->id)
    													->get();
	    	$class = new $class;
	    	if(empty($table)) {
				$array = [substr($usuario->itens[0]->table, 0, -1), substr($class->table, 0, -1)];
				sort($array);
				$table = $array[0].'_'.$array[1];
			}
	    	if(empty($fieldClass)) {
				$fieldClass = substr($class->table, 0, -1).'_id';
			}
			if(empty($field)) {
				$field = substr($usuario->itens[0]->table, 0, -1).'_id';
			} 
	    	$conexao = (new DB)->conexao();
	    	$stmt     = $conexao->prepare("SELECT * FROM $table WHERE $field = :$field ORDER BY $field ASC");
			$stmt->execute([$field => $usuario->itens[0]->values->id]);
			$ids = $stmt->fetchAll(\PDO::FETCH_OBJ);
			$ids = array_map(function($v) use ($fieldClass) {
				$refs = $fieldClass;
			    return $v->$refs;
			}, $ids);
			if(!empty($ids)) {
				$in  = str_repeat('?,', count($ids) - 1) . '?';
				$classFillable  = implode("," , $class->fillable);
				$stmt = $conexao->prepare("SELECT id, $classFillable FROM $class->table WHERE id IN ($in)");
				$stmt->execute($ids);
				$result = $stmt->fetchAll(\PDO::FETCH_OBJ);
				foreach($result as $dado) {
					$this->values->acl[] = $dado;
				}
			}
    	}
    }

    public function can($array) 
    {
    	$ids = array_map(function($v) {
    		return $v->id;
		}, $_SESSION['auth']->values->acl);
		$compare = array_intersect($ids, $array);
		if(count($compare) > 0) {
			return true;
		} else {
			return false;
		}
    }

	public function isAdmin($field='')
	{
		$field = $field <> '' ? $field : 'admin';
		if($this->values->{$field}==1) {
			return true;
		} else {
			return false;
		}
	}

	public function idAuth()
	{
		return $this->values->id;
	}

	public function forbidden()
	{
		return $this->view($this->config->app->pageForbidden);
	}

	public function notFound()
	{
		return $this->view($this->config->app->pageNotFound);
	}
}