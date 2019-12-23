<?php
declare(strict_type=1);

namespace App\Repositories;

use Core\Repository;

/**
 * Class Subscribe
 * @package App\Repositories 
 */
class Subscribe extends Repository
{
    /**
     * create
     *
     * @param  int $participantId
     * @param  int $sessionId
     *
     * @return bool
     */
    public function create($participantId, $sessionId): bool
    {
		$params = [
		    'sessionId' => $sessionId,
			'participantId' => $participantId,
		];
		
		if ($this->db->query('INSERT INTO Subscribe (SessionID, SubscribeID) VALUES (:sessionId, :participantId)', $params)) {
		    return true;
		}
		else {
		    return false;
		}
    }
}