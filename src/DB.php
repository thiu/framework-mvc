<?php 

namespace Src;

use Src\Config;

class DB extends Config
{
	private $server; 
	private $user;
	private $pass;
	private $query;

	public $fields;
	public $orderBy;
	public $groupBy;
	public $selectCount;
	public $selectCountAnd;
	public $selectSum;
	public $selectSumAnd;
	public $limitStmt;
	public $whereSpecific;
	public $where        = array();
	public $whereIn      = array();
	public $period       = array();
	public $comboWhere   = array();
	public $comboOrWhere = array();

	public $hasOneRelName   = array();
	public $hasOneStmtQuery = array();
	public $hasOneRef       = array();
	public $hasOneRefRel    = array();
	public $hasOneTable     = array();

	public $hasManyRelName   = array();
	public $hasManyStmtQuery = array();
	public $hasManyRef       = array();
	public $hasManyTable     = array();

	public $manyToManyRelName = array();
	public $hasManyToManyStmtQuery = array();
	public $hasManyToManyRef = array();
	public $hasManyToManyTable = array();
	public $hasManyToManyRefTable = array();

	public $syncTable = array();
	public $syncfieldClass = array();
	public $syncfieldThisClass = array();

	public $stmt;

	public $now;

	public function __construct() {
		$this->now = date("Y-m-d H:i:s");
        $config = Config::load('config/database.php');
		$this->server = 'mysql:host='.$config->database->server.';dbname='.$config->database->db.';charset=utf8';
		$this->user = $config->database->user;
		$this->pass = $config->database->pass;
    }

	public function conexao()
	{
		try {
			$con = new \PDO($this->server, $this->user, $this->pass);
		    $con->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			$con = 'ERROR: ' . $e->getMessage();
		}
		return $con;
	}

	public function select($fields="")
	{
		if(!empty($fields)) {
			$fields = preg_filter('/^/', $this->table.'.', $fields);
			$this->fields .= implode(',',$fields);
		} else {
			$this->fields ="*";
		}
		return $this;
	}

	public function selectCustom($funcoes="") 
	{
		if(!empty($funcoes)) {
			$this->fields .= implode(',',$funcoes);
		}
		return $this;
	}

	public function selectCustomAnd($funcoes="") 
	{
		if(!empty($funcoes)) {
			$this->fields .= implode(',',$funcoes);
			$this->fields .= ',';
		}
		return $this;
	}

	public function selectCount($field, $alias)
	{
		$this->selectCount = "COUNT($field) as $alias";
		return $this;
	}

	public function selectCountAnd($field, $alias)
	{
		$this->selectCountAnd = "COUNT($field) as $alias, ";
		return $this;
	}

	public function selectSum($field, $alias)
	{
		$this->selectSum = "SUM($field) as $alias";
		return $this;
	}

	public function selectSumAnd($field, $alias)
	{
		$this->selectSumAnd = "SUM($field) as $alias, ";
		return $this;
	}

	public function when($valid, $param)
	{
		if($valid) {
			return $this->where($param[0], $param[1], $param[2]);
		} else {
			return $this;
		}
	}

	public function whenDate($valid, $param)
	{
		if($valid) {
			return $this->whereDate($param[0], $param[1], $param[2]);
		} else {
			return $this;
		}
	}

	public function whereDate($param, $operand, $value)
	{
		$this->where[] = array(
			'param'   => 'DATE('.$param.')',
			'bind'    => ':'.$param.rand(1,time()),
			'operand' => $operand,
			'value'   => $value,
			'ext'     => 'AND',
		);
		return $this;
	}

	public function whereYear($param, $operand, $value)
	{
		$this->where[] = array(
			'param'   => 'YEAR('.$param.')',
			'bind'    => ':'.$param.rand(1,time()),
			'operand' => $operand,
			'value'   => $value,
			'ext'     => 'AND',
		);
		return $this;
	}

	public function whereMonth($param, $operand, $value)
	{
		$this->where[] = array(
			'param'   => 'MONTH('.$param.')',
			'bind'    => ':'.$param.rand(1,time()),
			'operand' => $operand,
			'value'   => $value,
			'ext'     => 'AND',
		);
		return $this;
	}

	public function whenPeriod($valid, $param)
	{
		if($valid) {
			return $this->period($param[0], $param[1]);
		} else {
			return $this;
		}
	}

	public function where($param, $operand, $value)
	{
		$this->where[] = array(
			'param'   => $param,
			'bind'    => ':'.$param.rand(1,time()),
			'operand' => $operand,
			'value'   => $value,
			'ext'     => 'AND',
		);
		return $this;
	}

	public function whereCustom($funcoes) 
	{
		$this->whereSpecific .= implode(',',$funcoes);
		$this->whereSpecific .= ' AND ';
		return $this;
	}

	public function orWhereCustom($funcoes="") 
	{
		$this->whereSpecific .= implode(',',$funcoes);
		$this->whereSpecific .= ' OR ';
		return $this;
	}

	public function whereIn($param, $values)
	{
		foreach($values as $value) {
			$binds[] = ':'.$param.rand(1,time());
		} 
		$this->whereIn[] = array(
			'param'   => $param,
			'bind'    => $binds,
			'operand' => 'IN',
			'value'   => $values,
			'ext'     => 'AND',
		);
		return $this;
	}

	public function period($param, $value) 
	{
		$data = $value.'-01';
		$this->period[] = array(
			'param'   => $param,
	 		'bind'    => ':'.$param.rand(1,time()),
	 		'operand' => '>=',
	 		'value'   => $data,
	 		'ext'   => 'AND',
		);
		$data = $value.'-31';
		$this->period[] = array(
			'param'   => $param,
	 		'bind'    => ':'.$param.rand(1,time()),
	 		'operand' => '<=',
	 		'value'   => $data,
	 		'ext'     => '',
		);
		return $this;
	}

	public function with($func, $fields='', $order='')
	{
		$this->withFields = $fields;
		$this->relName = $func;
		$this->withOrder = $order;
		$this->$func();
		return $this;
	}

	public function manyToMany($class, $table='', $refRel='', $ref='')
	{
		$class = new $class;
		$thisClass = $this;
		$this->manyToManyRelName[] = $this->relName;
		if(empty($table)) {
			$array = [substr($thisClass->table, 0, -1), substr($class->table, 0, -1)];
			sort($array);
			$table = $array[0].'_'.$array[1];
		}
		$this->hasManyToManyTable[] = $table;
		$this->hasManyToManyRefTable[] = $class->table;
		if(empty($ref)) {
			$ref = substr($thisClass->table, 0, -1).'_id';
		}
		if(empty($refRel)) {
			$this->hasManyToManyRefRel[] = substr($class->table, 0, -1).'_id';
		} else {
			$this->hasManyToManyRefRel[] = $refRel;
		}
		$this->hasManyToManyRef[] = $ref;
 		$this->hasManyToManyStmtQuery[] = "SELECT * FROM $table WHERE $ref IN (:id)";
	}

	public function hasOne($class, $ref='', $refRel= '') 
	{
		$class = new $class;
		$fields = "*";
		$order = '';
		$this->hasOneRelName[] = $this->relName;
		if(!empty($this->withFields)) {
			$fields = implode(', ', $this->withFields);
			$fields .= ', id';
		}
		if(!empty($this->withOrder)) {
			$order = "ORDER BY ";
			$i = count($this->withOrder);
			$x = 1;
			foreach($this->withOrder as $key => $value) {
				$order .= "$key $value";
				if($i > $x) {
					$order .= ', ';
				}
				$x++;
			}
		}			
		$this->hasOneStmtQuery[] = "SELECT $fields FROM $class->table WHERE id IN (:id) $order";
		$this->hasOneTable[] = $class->table;
		if(empty($ref)) {
			$this->hasOneRef[] = substr($class->table, 0, -1).'_id';
		} else {
			$this->hasOneRef[] = $ref;
		}
		if(empty($refRel)) {
			$this->hasOneRefRel[] = 'id';
		} else {
			$this->hasOneRefRel[] = $refRel;
		}
	}

	public function hasMany($class, $ref='')
	{
		$class = new $class;
		$fields = "*";
		$order = '';
		$this->hasManyRelName[] = $this->relName;
		if(!empty($this->withFields)) {
			$fields = implode(', ', $this->withFields);
			$fields .= ', id';
		}	
		if(!empty($this->withOrder)) {
			$order = "ORDER BY ";
			$i = count($this->withOrder);
			$x = 1;
			foreach($this->withOrder as $key => $value) {
				$order .= "$key $value";
				if($i > $x) {
					$order .= ', ';
				}
				$x++;
			}
		}	
		if(empty($ref)) {
			$this->hasManyRefThis = substr($this->table, 0, -1).'_id';
			$this->hasManyRef[] = substr($this->table, 0, -1).'_id';
		} else {
			$this->hasManyRefThis = $ref;
			$this->hasManyRef[] = $ref;
		}
		$this->hasManyStmtQuery[] = "SELECT $fields, $this->hasManyRefThis FROM $class->table WHERE $this->hasManyRefThis IN (:id) $order";
		$this->hasManyTable[] = $class->table;
	}

	public function orWhere($param, $operand, $value)
	{
		$this->where[] = array(
			'param'   => $param,
			'bind'    => ':'.$param.rand(1,time()),
			'operand' => $operand,
			'value'   => $value,
			'ext'     => 'OR',
		);
		return $this;
	}

	public function orWhereIn($param, $values)
	{
		foreach($values as $value) {
			$binds[] = ':'.$param.rand(1,time());
		} 
		$this->whereIn[] = array(
			'param'   => $param,
			'bind'    => $binds,
			'operand' => 'IN',
			'value'   => $values,
			'ext'     => 'OR',
		);
		return $this;
	}

	public function comboWhere($array)
	{
		foreach($array as $value)
		{
			$this->comboWhere[] = array(
				'param'   => $value[0],
				'bind'    => ':'.$value[0].rand(1,time()),
				'operand' => $value[1],
				'value'   => $value[2],
				'ext'     => isset($value[3])?$value[3]:'',
				'final'   => 'AND'
			);
		}
		return $this;
	}

	public function comboOrWhere($array)
	{
		foreach($array as $value)
			{
				$this->comboOrWhere[] = array(
					'param'   => $value[0],
					'bind'    => ':'.$value[0].rand(1,time()),
					'operand' => $value[1],
					'value'   => $value[2],
					'ext'     => isset($value[3])?$value[3]:'',
					'final'   => 'OR'
				);
			}
		return $this;
	}

	public function sync($class, $table='', $fieldClass='', $fieldThisClass='')
	{
		$class = new $class;
		$thisClass = $this;
		if(empty($table)) {
			$array = [substr($thisClass->table, 0, -1), substr($class->table, 0, -1)];
			sort($array);
			$table = $array[0].'_'.$array[1];
			$this->syncTable[] = $array[0].'_'.$array[1];
		} else {
			$this->syncTable[] = $table;
		}
		if(empty($fieldClass)) {
			$this->syncfieldClass[] = substr($class->table, 0, -1).'_id';
			$syncfieldClass = substr($class->table, 0, -1).'_id';
		} else {
			$this->syncfieldClass[] = $fieldClass;
			$syncfieldClass = $fieldClass;
		}
		if(empty($fieldThisClass)) {
			$this->syncfieldThisClass[] = substr($thisClass->table, 0, -1).'_id';
			$syncfieldThisClass = substr($thisClass->table, 0, -1).'_id';
		} else {
			$this->syncfieldThisClass[] = $fieldThisClass;
			$syncfieldThisClass = $fieldThisClass;
		}
		$syncFillable = $syncfieldClass.','.$syncfieldThisClass;
		$this->syncStmt[] = "INSERT INTO $table ($syncFillable) VALUES (:$syncfieldClass, :$syncfieldThisClass)";
		$this->syncRel[] = $class->table;
		return $this;
	}

	public function orderBy($order) 
	{
		$this->orderBy = "ORDER BY ";
		$i = count($order);
		$x = 1;
		foreach($order as $key => $value) {
			$this->orderBy .= "$key $value";
			if($i > $x) {
				$this->orderBy .= ', ';
			}
			$x++;
		}
		if(empty($order)) {
			$order = 'ASC';
		}
		return $this;
	}

	public function groupBy($group)
	{
		$this->groupBy = "GROUP BY ";
		$i = count($group);
		$x = 1;
		foreach($group as $value) {
			$this->groupBy .= " $value";
			if($i > $x) {
				$this->orderBy .= ', ';
			}
			$x++;
		}
		return $this;
	}

	public function limit($i) 
	{
		$this->limitStmt = "LIMIT ".$i;
		return $this;
	}

	public function values() 
	{
		$return = array();
		if(count($this->itens)>1) {
			foreach($this->itens as $itens) {
				array_push($return, $itens->values);
			}
		} else {
			$return = $this->itens[0]->values;
		}
		return $return;
	}

	public function create($post)
	{
		foreach($this->fillable as $fillable) {
			$post[$fillable] = (isset($post[$fillable]) && !empty($post[$fillable])) || (isset($post[$fillable]) && is_numeric($post[$fillable])) ? $post[$fillable] : NULL;
		}
		foreach($post as $key => $value) 
		{
			if (array_search($key, $this->fillable) === false) {
		    	unset($post[$key]); 
		    	$postsync[$key] = $value;
			}
		}
		$conexao   = $this->conexao();
		$fillable  = $this->fillable;
		$table     = $this->table;
		$values    = preg_filter('/^/', ':', $fillable);
		array_push($values, ':created_at');
		$values    = implode("," , $values);
		array_push($fillable, 'created_at');
		$fillable  = implode("," , $fillable);
		unset($post['id']);
		$post     += ['created_at' => $this->now];
		$conexao   = $this->conexao();
		$stmt      = $conexao->prepare("INSERT INTO $table ($fillable) VALUES ($values)");
		$stmt->execute($post);

		if(isset($this->syncStmt)) {
			$id = $this->select(['id'])->orderBy(['id'=>'DESC'])->limit(1)->get()->values();
			for($i=0; count($this->syncStmt) > $i; $i++) {
				if(isset($postsync[$this->syncRel[$i]])) {
					foreach($postsync[$this->syncRel[$i]] as $syncRel) {
						$stmt = $conexao->prepare($this->syncStmt[$i]);
						$stmt->execute([$this->syncfieldClass[$i] => $syncRel, $this->syncfieldThisClass[$i] => $id->id]);
					}	
				}
			}
		}
	}

	public function createUser($post, $password="")
	{
		if(empty($password)) {
			$password = 'password';
		}
		foreach($this->fillable as $fillable) {
			$post[$fillable] = (isset($post[$fillable]) && !empty($post[$fillable])) || (isset($post[$fillable]) && is_numeric($post[$fillable])) ? $post[$fillable] : NULL;
		}
		foreach($post as $key => $value) 
		{
			if($key != 'password') {
				if($key != $password) {
					if (array_search($key, $this->fillable) === false) {
						unset($post[$key]); 
						$postsync[$key] = $value;
					}
				}
			}
		}
		
		$conexao   = $this->conexao();
		$fillable  = $this->fillable;
		$table     = $this->table;
		$values    = preg_filter('/^/', ':', $fillable);
		array_push($values, ':created_at');
		array_push($values, ':'.$password);
		$values    = implode("," , $values);
		array_push($fillable, 'created_at');
		array_push($fillable, $password);
		$fillable  = implode("," , $fillable);
		unset($post['id']);
		$post     += ['created_at' => $this->now];
		$conexao   = $this->conexao();
		$stmt      = $conexao->prepare("INSERT INTO $table ($fillable) VALUES ($values)");
		$stmt->execute($post);

		if(isset($this->syncStmt)) {
			$id = $this->select(['id'])->orderBy(['id'=>'DESC'])->limit(1)->get()->values();
			for($i=0; count($this->syncStmt) > $i; $i++) {
				if(isset($postsync[$this->syncRel[$i]])) {
					foreach($postsync[$this->syncRel[$i]] as $syncRel) {
						$stmt = $conexao->prepare($this->syncStmt[$i]);
						$stmt->execute([$this->syncfieldClass[$i] => $syncRel, $this->syncfieldThisClass[$i] => $id->id]);
					}	
				}
			}
		}
	}

	public function update($post)
	{
		foreach($post as $key => $value) {
			if (array_search($key, $this->fillable) === false) {
		    	unset($post[$key]); 
		    	$postsync[$key] = $value;
			}
		}
		$post['id'] = $postsync['id'];
		$conexao   = $this->conexao();
		if(isset($this->syncStmt)) {
			for($i=0; count($this->syncStmt) > $i; $i++) {
				$syncTable = $this->syncTable[$i];
				$fieldThisClass = $this->syncfieldThisClass[$i];
				$stmt = $conexao->prepare("DELETE FROM $syncTable WHERE $fieldThisClass = :$fieldThisClass");
				$stmt->execute([$fieldThisClass => $post['id']]);
				if(isset($postsync[$this->syncRel[$i]])) {
					foreach($postsync[$this->syncRel[$i]] as $syncRel) {
						$stmt = $conexao->prepare($this->syncStmt[$i]);
						$stmt->execute([$this->syncfieldClass[$i] => $syncRel, $this->syncfieldThisClass[$i] => $post['id']]);
					}
				}
			}
		}
		$sets 	   = '';
		$table     = $this->table;
		foreach($post as $key => $value) {
			$sets .= $key.' = :'.$key.', ';
			$post[$key] = (isset($post[$key]) && !empty($post[$key])) || (isset($post[$key]) && is_numeric($post[$key])) ? $post[$key] : NULL;
		}
		$sets     .= 'updated_at = :updated_at';
		$post     += ['updated_at' => $this->now];
		$stmt      = $conexao->prepare("UPDATE $table SET $sets WHERE id = :id");
		$stmt->execute($post);
	}

	public function password($post, $key='')
	{
		if(!empty($post['password']) || !empty($post[$key])) {
			if(empty($key)) {
				$field = 'password = :password';
				$password = password_hash($post['password'], PASSWORD_BCRYPT);
				$post = ['id' => $post['id'], 'password' => $password];
			} else {
				$field = "$key = :$key";
				$password = password_hash($post[$key], PASSWORD_BCRYPT);
				$post = ['id' => $post['id'], $key => $password];
			}
			$conexao = $this->conexao();
			$table   = $this->table;
			$stmt    = $conexao->prepare("UPDATE $table SET $field WHERE id = :id");
			$stmt->execute($post);
		}
		return $this;
	}

	public function delete($id)
	{
		$conexao = $this->conexao();
		$table 	 = $this->table;
		$stmt    = $conexao->prepare("UPDATE $table SET deleted_at = :deleted_at WHERE id = :id");
		$stmt->execute(['id' => $id['id'], 'deleted_at' => $this->now]);
	}

	public function deleteWhere($param, $operand, $value)
	{
		$conexao = $this->conexao();
		$table 	 = $this->table;
		$stmt    = $conexao->prepare("UPDATE $table SET deleted_at = :deleted_at WHERE $param $operand :value");
		$stmt->execute(['value' => $value, 'deleted_at' => $this->now]);
	}

	public function deleteWhereNotIn($param, $array)
	{
		$conexao = $this->conexao();
		$table 	 = $this->table;
		$qMarks = str_repeat('?,', count($array) - 1) . '?';
		$stmt    = $conexao->prepare("UPDATE $table SET deleted_at = '$this->now' WHERE $param NOT IN ($qMarks)");
		$stmt->execute($array);
	}

	public function fullDelete($id)
	{
		$conexao = $this->conexao();
		$table 	 = $this->table;
		$stmt    = $conexao->prepare("DELETE FROM $table WHERE id = :id");
		$stmt->execute(['id' => $id['id']]);
	}

	public function fullDeleteWhere($param, $operand, $value)
	{
		$conexao = $this->conexao();
		$table 	 = $this->table;
		$stmt    = $conexao->prepare("DELETE FROM $table WHERE $param $operand :value");
		$stmt->execute(['value' => $value]);
	}

	public function fullDeleteWhereNotIn($param, $array)
	{
		$conexao = $this->conexao();
		$table 	 = $this->table;
		$qMarks  = str_repeat('?,', count($array) - 1) . '?';
		$stmt    = $conexao->prepare("DELETE FROM $table WHERE $param NOT IN ($qMarks)");
		$stmt->execute($array);
	}

	public function find($id)
	{
		$id = isset($id['id']) ? $id['id'] : $id;
		$fillable = $this->fillable;
		$table    = $this->table;
		$fillable = implode("," , $fillable);
		$fillable = 'id,' . $fillable;
		$conexao  = $this->conexao();
		$stmt     = $conexao->prepare("SELECT $fillable FROM $table WHERE id = :id AND deleted_at IS :deleted_at ORDER BY id ASC");
		$stmt->execute(['id' => $id, 'deleted_at' => NULL]);
		$registro = $stmt->fetch(\PDO::FETCH_OBJ);
		return $registro;
	}

	public function all()
	{
		$conexao = $this->conexao();
		$table   = $this->table;
		$stmt    = $conexao->prepare("SELECT * FROM $table WHERE deleted_at IS :deleted_at");
		$stmt->execute(['deleted_at' => null]);
		$registros = $stmt->fetchAll(\PDO::FETCH_OBJ);
		return $registros;
	}

	public function box($fields)
	{
		$conexao = $this->conexao();
		$table   = $this->table;
		$stmt    = $conexao->prepare("SELECT $fields FROM $table WHERE deleted_at IS :deleted_at");
		$stmt->execute(['deleted_at' => null]);
		$registros = $stmt->fetchAll(\PDO::FETCH_OBJ);
		return $registros;
	}

	public function get()
	{
		$whereOrCombo = '';
		$whereCombo   = '';
		$whereFields  = '';
		$whereInFields= '';
		$wherePeriod  = '';
		$fields       = $this->fields;
		$table	      = $this->table;
		$i=0;
		foreach($this->where as $where) {
			if ( $i==0 && count($this->where)==1 ) {
				$whereFields .= $where['param'].' '.$where['operand'].' '.$where['bind'].' '.$where['ext'];
			} else if ( $i==0 ) {
				$whereFields .= $where['param'].' '.$where['operand'].' '.$where['bind'].' ';
			} else if ( count($this->where)-1 > $i ) {
				$whereFields .= ' '.$where['ext'].' '.$where['param'].' '.$where['operand'].' ' .$where['bind'].' ';
			} else {
				$whereFields .= ' '.$where['ext'].' '.$where['param'].' '.$where['operand'].' ' .$where['bind'].' AND ';
			}
			$i++;
 		}

 		$i = 0;
 		foreach($this->whereIn as $whereIn) {
 			if ( $i==0 && count($this->whereIn)==1 ) {
 				$binds = implode(',', $whereIn['bind']);
				$whereInFields .= $whereIn['param'].' '.$whereIn['operand'].' ('.$binds.') '.$whereIn['ext'];
			} else if ( $i==0 ) {
				$binds = implode(',', $whereIn['bind']);
				$whereInFields .= $whereIn['param'].' '.$whereIn['operand'].' ('.$binds.') ';
			} else if ( count($this->whereIn)-1 > $i ) {
				$binds = implode(',', $whereIn['bind']);
				$whereInFields .= ' '.$whereIn['ext'].' '.$whereIn['param'].' '.$whereIn['operand'].' (' .$binds.') ';
			} else {
				$binds = implode(',', $whereIn['bind']);
				$whereInFields .= ' '.$whereIn['ext'].' '.$whereIn['param'].' '.$whereIn['operand'].' (' .$binds.') AND ';
			}
			$i++;
 		}

 		if(!empty($this->comboWhere)) {
 			$whereCombo = '( ';
 			foreach($this->comboWhere as $comboWhere) {
 				$whereCombo .= $comboWhere['param'].' '.$comboWhere['operand']. ' '.$comboWhere['bind'].' '.$comboWhere['ext'].' ';
 			}
 			$whereCombo .= ') '.$this->comboWhere[0]['final'].' ';
 		}
 		if(!empty($this->comboOrWhere)) {
 			$whereOrCombo = '( ';
 			foreach($this->comboOrWhere as $comboOrWhere) {
 				$whereOrCombo .= $comboOrWhere['param'].' '.$comboOrWhere['operand']. ' '.$comboOrWhere['bind'].' '.$comboOrWhere['ext'].' ';
 			}
 			$whereOrCombo .= ') '.$this->comboOrWhere[0]['final'].' ';
 		}

 		if(!empty($this->period)) {
 			$wherePeriod = '( ';
 			foreach($this->period as $period) {
 				$wherePeriod .= $period['param'].' '.$period['operand']. ' '.$period['bind'].' '.$period['ext'].' ';
 			}
 			$wherePeriod .= ' ) AND ';
 		}

		$conexao = $this->conexao();
		$stmt    = $conexao->prepare("SELECT $this->selectSumAnd $this->selectCountAnd $this->selectCount $this->selectSum $fields FROM $table WHERE $whereOrCombo $whereCombo $whereFields $whereInFields $wherePeriod $this->whereSpecific $table.deleted_at IS :deleted_at $this->groupBy $this->orderBy  $this->limitStmt");

		
		foreach($this->comboOrWhere as $comboOrWhere) {
			$stmt->bindParam($comboOrWhere['bind'], $comboOrWhere['value']);
		}
 		foreach($this->comboWhere as $comboWhere) {
 			$stmt->bindParam($comboWhere['bind'], $comboWhere['value']);
 		}
 		foreach($this->where as $where) {
 			$stmt->bindParam($where['bind'], $where['value']);
 			$i++;
 		}
 		foreach($this->period as $period) {
 			$stmt->bindParam($period['bind'], $period['value']);
 		}	
 		foreach($this->whereIn as $whereIn) {
 			for($i=0; $i < count($whereIn['bind']); $i++) { 
 				$stmt->bindParam($whereIn['bind'][$i], $whereIn['value'][$i], \PDO::PARAM_INT);
 			}
 			
		}
 		$stmt->bindValue(':deleted_at', null, \PDO::PARAM_NULL);
    	$stmt->execute();

		$result = $stmt->fetchAll(\PDO::FETCH_OBJ);


		if(!empty($result)) {
			if($this->hasOneStmtQuery) {
				for($i=0; count($this->hasOneStmtQuery) > $i; $i++) {
					$ids = array_map(function($v) use ($i) {
						$refs = $this->hasOneRef[$i];
					    return $v->$refs;
					}, $result);
					$in  = str_repeat('?,', count($ids) - 1) . '?';
					$this->hasOneStmtQuery[$i] = str_replace(':id', $in, $this->hasOneStmtQuery[$i]);
					$hasOneStmt = $conexao->prepare($this->hasOneStmtQuery[$i]);
					$hasOneStmt->execute($ids);
					$resultHasOne[] = $hasOneStmt->fetchAll(\PDO::FETCH_OBJ);
				}
			}
			if($this->hasManyStmtQuery) {
				for($i=0; count($this->hasManyStmtQuery) > $i; $i++) {
					$table = $this->hasManyTable[$i];
					$stmt = $conexao->prepare("SELECT id, ".$this->hasManyRef[$i]." FROM $table WHERE deleted_at IS NULL");
					$stmt->execute();
					$ids  = $stmt->fetchAll(\PDO::FETCH_OBJ);
					$ids = array_map(function($v) use ($i) {
						$refs = $this->hasManyRef[$i];
					    return $v->$refs;
					}, $ids);
					if(count($ids) - 1 >= 0) {
						$in  = str_repeat('?,', count($ids) - 1) . '?';
					}
					$ids = empty($ids) ? array('0') : $ids;
					$this->hasManyStmtQuery[$i] = str_replace(':id', $in, $this->hasManyStmtQuery[$i]);
					$hasManyStmt = $conexao->prepare($this->hasManyStmtQuery[$i]);
					$hasManyStmt->execute($ids);
					$resultHasMany[] = $hasManyStmt->fetchAll(\PDO::FETCH_OBJ);
				}
			}

			if($this->hasManyToManyStmtQuery) {
				for($i=0; count($this->hasManyToManyStmtQuery) > $i; $i++) {
					$table = $this->hasManyToManyTable[$i];
					$stmt = $conexao->prepare("SELECT * FROM $table");
					$stmt->execute();
					$ids = $stmt->fetchAll(\PDO::FETCH_OBJ);
					$ids = array_map(function($v) use ($i) {
						$refs = $this->hasManyToManyRef[$i];
					    return $v->$refs;
					}, $ids);
					if(!empty($ids)) {
						$in  = str_repeat('?,', count($ids) - 1) . '?';
						$this->hasManyToManyStmtQuery[$i] = str_replace(':id', $in, $this->hasManyToManyStmtQuery[$i]);
						$hasManyToManyStmt = $conexao->prepare($this->hasManyToManyStmtQuery[$i]);
						$hasManyToManyStmt->execute($ids);
						$resultHasManyToManyStmt[] = $hasManyToManyStmt->fetchAll(\PDO::FETCH_OBJ);
					}
				}
			}
		}

		$collection = new Model;
		foreach($result as $row) {
			if($this->hasOneStmtQuery) {
				for($i=0; count($this->hasOneStmtQuery) > $i; $i++) {
					$tableRef = $this->hasOneRef[$i];
					$table    = substr($this->hasOneTable[$i], 0, -1);
					$key     = array_search($row->$tableRef, array_column($resultHasOne[$i], $this->hasOneRefRel[$i]));
					if($key !== false) {
						$relName = $this->hasOneRelName[$i];
						$row->$relName = $resultHasOne[$i][$key];
					}
				}
			}
			if($this->hasManyStmtQuery) {
				for($i=0; count($this->hasManyStmtQuery) > $i; $i++) {
					$table = $this->hasManyTable[$i];
					$keys = (array_keys(array_column($resultHasMany[$i], $this->hasManyRef[$i]), $row->id));
					$relName = $this->hasManyRelName[$i];
					foreach($keys as $key) {
						if($key !== false) {
							$row->{$relName}[] = $resultHasMany[$i][$key];
						}
					}
				}
			}
			if($this->hasManyToManyStmtQuery) {
				for($i=0; count($this->hasManyToManyStmtQuery) > $i; $i++) {
					$table = $this->hasManyToManyTable[$i];
					if(isset($resultHasManyToManyStmt[$i])) {
						$keys = (array_keys(array_column($resultHasManyToManyStmt[$i], $this->hasManyToManyRef[$i]), $row->id));
						$relName = $this->manyToManyRelName[$i];
						$idsRel = [];
						foreach($keys as $key) {
							$idsRel[] .= $resultHasManyToManyStmt[$i][$key]->{$this->hasManyToManyRefRel[$i]};
						}
						if(!empty($idsRel)) {
							$table = $this->hasManyToManyRefTable[$i];
							$fields = "*";
							if(!empty($this->withFields)) {
								$fields = implode(', ', $this->withFields);
							}
							$stmt = "SELECT $fields FROM $table WHERE id IN (:id)";
							$in = str_repeat('?,', count($idsRel) - 1) . '?';
							$stmt = str_replace(':id', $in, $stmt);
							$hasManyToManyConvert = $conexao->prepare($stmt);
							$hasManyToManyConvert->execute($idsRel);
							$results = $hasManyToManyConvert->fetchAll(\PDO::FETCH_OBJ);
							foreach($results as $result) {
								if(!empty($result)) {
									$row->{$relName}[] = $result;
								}
							}	
						}
					}
				}
			}
			$retorno = new $this;
			$retorno->values = $row;
			$collection->addItem($retorno);
		}
		return $collection;
	}

	public function queryBuilder($query, $param="")
	{
		$conexao   = (new DB)->conexao();
		$this->stmt = $conexao->prepare($query);
		if(!empty($param)) {
			$param= explode(',',$param);
			foreach($param as $key => &$value){
				if($value === "NULL") {
					$value = null;
				}
				$this->stmt->bindParam($key+1, $value);
			}
		} 
		return $this;
	}

	public function getQuery()
	{		
		$this->stmt->execute();
		$registro  = $this->stmt->fetchAll(\PDO::FETCH_OBJ);
		return $registro;
	}

	public function runQuery()
	{	
		$this->stmt->execute();
	}

}