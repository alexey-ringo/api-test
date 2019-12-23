<?php
declare(strict_type=1);

namespace App\Repositories;

use Core\Repository;

/**
 * Class Session
 * @package App\Repositories 
 */
class Session extends Repository
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
        
        return $this->db->row('SELECT * FROM Session ORDER BY ID DESC LIMIT :max', $params);
        
        //return $this->db->row('SELECT * FROM Session, Speaker WHERE Session.SpeakerId = Speaker.ID ORDER BY Session.ID DESC LIMIT :max', $params);
        //return $this->db->row('SELECT * FROM Session JOIN Speaker ON Session.SpeakerId = Speaker.ID ORDER BY Session.ID DESC LIMIT :max', $params);
        
        
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
		
        return $this->db->row('SELECT * FROM Session WHERE ID = :id', $params);
    }
}