<?php

namespace App\Models;

use Framework\Core\Model;

class Speaker extends Model
{
    public function getAll(): array
    {
        $max = 100;
        $params = [
			'max' => $max,
		];
        
        return $this->db->row('SELECT * FROM Speaker ORDER BY id DESC LIMIT :max', $params);
    }
    
    public function getById($id): array
    {
		$params = [
			'id' => $id,
		];
     
        return $this->db->row('SELECT * FROM Speaker WHERE ID = :id', $params);
    }
    
    public function getBySessionId($id): array
    {
		$params = [
			'id' => $id,
		];
     
        return $this->db->row('SELECT * FROM Speaker WHERE SessionID = :id', $params);
    }
}