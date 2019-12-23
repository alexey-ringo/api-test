<?php
declare(strict_type=1);

namespace App\Repositories;

use Core\Repository;

/**
 * Class Speaker
 * @package App\Repositories 
 */
class Speaker extends Repository
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
        
        return $this->db->row('SELECT * FROM Speaker ORDER BY id DESC LIMIT :max', $params);
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
     
        return $this->db->row('SELECT * FROM Speaker WHERE ID = :id', $params);
    }
    
    /**
     * getBySessionId
     *
     * @param  int $id
     *
     * @return array
     */
    public function getBySessionId($id): array
    {
		$params = [
			'id' => $id,
		];
     
        return $this->db->row('SELECT * FROM Speaker WHERE SessionID = :id', $params);
    }
}