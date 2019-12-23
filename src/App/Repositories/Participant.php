<?php
declare(strict_type=1);

namespace App\Repositories;

use Core\Repository;

/**
 * Class Participant
 * @package App\Repositories 
 */
class Participant extends Repository
{
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        $max = 100;
        $params = [
			'max' => $max,
		];
        
        return $this->db->row('SELECT * FROM Participant ORDER BY ID DESC LIMIT :max', $params);
    }
    
    /**
     * getById
     *
     * @param  int $id
     *
     * @return array
     */
    public function getById($id): array
    {
		$params = [
			'id' => $id,
		];
       
        return $this->db->row('SELECT * FROM Participant WHERE ID = :id', $params);
    }
    
    /**
     * getByEmail
     *
     * @param  string $email
     *
     * @return array
     */
    public function getByEmail($email): array
    {
		$params = [
			'email' => $email,
		];
       
        return $this->db->row('SELECT * FROM Participant WHERE Email = :email', $params);
    }
}