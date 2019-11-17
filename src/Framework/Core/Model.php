<?php

namespace Framework\Core;

use Framework\Db\Db;

abstract class Model {
    
	public $db;
	
	public function __construct() {
		$this->db = new Db;
	}
}