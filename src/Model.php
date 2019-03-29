<?php 

namespace Src;

class Model extends DB
{
	public $itens = array();

    public function addItem($obj) {    	
    	unset($obj->itens);
    	unset($obj->where);
    	unset($obj->period);
    	unset($obj->fields);
    	unset($obj->comboWhere);
    	unset($obj->comboOrWhere);
    	unset($obj->withStmtQuery);
    	unset($obj->withRef);
    	unset($obj->withTable);
    	unset($obj->db);
    	unset($obj->app);
    	unset($obj->hasOneRelName);
    	unset($obj->hasOneStmtQuery);
    	unset($obj->hasOneRef);
    	unset($obj->hasOneRefRel);
    	unset($obj->hasOneTable);
    	unset($obj->hasManyRelName);
    	unset($obj->hasManyStmtQuery);
    	unset($obj->hasManyRef);
    	unset($obj->hasManyTable);
    	unset($obj->manyToManyRelName);
    	unset($obj->hasManyToManyStmtQuery);
    	unset($obj->hasManyToManyRef);
    	unset($obj->hasManyToManyTable);
    	unset($obj->hasManyToManyRefTable);
    	unset($obj->orderBy);
    	unset($obj->limitStmt);
    	unset($obj->syncTable);
    	unset($obj->syncfieldClass);
    	unset($obj->syncfieldThisClass);
		unset($this->where);
		unset($this->period);
		unset($this->fields);
		unset($this->comboWhere);
		unset($this->comboOrWhere);
		unset($this->withStmtQuery);
		unset($this->withRef);
		unset($this->withTable);
		unset($this->db);
		unset($this->app);
		unset($this->hasOneRelName);
		unset($this->hasOneStmtQuery);
		unset($this->hasOneRef);
		unset($this->hasOneRefRel);
		unset($this->hasOneTable);
		unset($this->hasManyRelName);
		unset($this->hasManyStmtQuery);
		unset($this->hasManyRef);
		unset($this->hasManyTable);
		unset($this->manyToManyRelName);
		unset($this->hasManyToManyStmtQuery);
		unset($this->hasManyToManyRef);
		unset($this->hasManyToManyTable);
		unset($this->hasManyToManyRefTable);
		unset($this->orderBy);
    	unset($this->limitStmt);
    	unset($this->syncTable);
    	unset($this->syncfieldClass);
    	unset($this->syncfieldThisClass);
    	$this->itens[] = $obj;
	}

    public function deleteItem($key) {
	    if (isset($this->itens[$key])) {
	        unset($this->itens[$key]);
	    } else {
	        throw new \Exception("A key $key é invalida.");
	    }
	}

    public function getItem($key) {
	    if (isset($this->itens[$key])) {
	        return $this->itens[$key];
	    } else {
	        throw new \Exception("A key $key é invalida.");
	    }
	}

	public function keys() {
	    return array_keys($this->itens);
	}

	public function size() {
	    return count($this->itens);
	}

	public function issetKey($key) {
	    return isset($this->itens[$key]);
	}
	
	public function sum($colum) {
		$total = 0;
		foreach($this->itens as $item) {
			$total = $total + $item->values->{$colum};
		}
		return $total;
	}
}