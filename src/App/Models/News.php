<?php

namespace App\Models;

use Framework\Core\Model;

class News extends Model
{
    public function getAll(): array
    {
        $max = 100;
        $params = [
			'max' => $max,
		];
        
        return $this->db->row('SELECT * FROM News ORDER BY ID DESC LIMIT :max', $params);
    }
    
    public function getById($id): array
    {
        $max = 100;
        
		$params = [
			'id' => $id,
		];
		
        return $this->db->row('SELECT * FROM News WHERE ID = :id', $params);
    }
    
}