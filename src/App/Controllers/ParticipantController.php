<?php
declare(strict_type=1);

namespace App\Controllers;

use App\Repositories\Participant;

class ParticipantController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * indexAction
     *
     * @return string
     */
    public function indexAction(): string
    {
        $participants = (new Participant())->getAll();
        
        return $this->response(static::OK_STATUS, $participants, '');
        
    }

    /**
     * viewAction
     *
     * @param  mixed $id
     *
     * @return string
     */
    public function viewAction($id): string
    {
        if(!$id) {
             return $this->notifyResponse(static::ERR_STATUS, 'Не переданы обязательные параметры!', 422);
        }
        
        $participant = (new Participant())->getById($id);

        if(empty($participant)) {
            return $this->notifyResponse(static::ERR_STATUS, 'Новость ' . $participant . ' не найден!', 404);
        }
        
        return $this->response(static::OK_STATUS, $participant, '');
    }
}