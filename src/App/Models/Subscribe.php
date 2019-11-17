<?php

namespace App\Models;

use Framework\Core\Model;

class Subscribe extends Model
{
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