<?php
declare(strict_type=1);

namespace App\Repositories;

use Core\Repository;

/**
 * Class News
 * @package App\Repositories 
 */
class News extends Repository
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
        
        return $this->db->row('SELECT * FROM News ORDER BY ID DESC LIMIT :max', $params);
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
        $max = 100;
        
		$params = [
			'id' => $id,
		];
		
        return $this->db->row('SELECT * FROM News WHERE ID = :id', $params);
    }
    
}