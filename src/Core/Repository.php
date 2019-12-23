<?php

namespace Core;

abstract class Repository {
    
	protected $db;
	
	public function __construct() {
		$this->db = Db::getInstance();
	}
}