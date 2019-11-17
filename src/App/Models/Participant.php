<?php

namespace App\Models;

use Framework\Core\Model;

class Participant extends Model
{
    public function getAll(): array
    {
        $max = 100;
        $params = [
			'max' => $max,
		];
        
        return $this->db->row('SELECT * FROM Participant ORDER BY ID DESC LIMIT :max', $params);
    }
    
    public function getById($id): array
    {
		$params = [
			'id' => $id,
		];
       
        return $this->db->row('SELECT * FROM Participant WHERE ID = :id', $params);
    }
    
    public function getByEmail($email): array
    {
		$params = [
			'email' => $email,
		];
       
        return $this->db->row('SELECT * FROM Participant WHERE Email = :email', $params);
    }
}