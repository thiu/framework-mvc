<?php

namespace App\Model;

use Src\Model; 

class Welcome extends Model
{
	public $table = 'table_name'; 
	public $fillable = [
		'field_1', 'field_2', 'field_etc'
	];
}