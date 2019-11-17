<?php

namespace App\Controllers;

use App\Models\Participant;

class ParticipantController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    const OK_STATUS = 'ok';
    const ERR_STATUS = 'error';

    
    public function indexAction()
    {
        $participants = (new Participant())->getAll();
        
        return $this->response($this->okStatus, $participants, '', 200);
        
    }

    public function viewAction($id)
    {
        if(!$id) {
             return $this->notifyResponse($this->errStatus, 'Не переданы обязательные параметры!', 422);
        }
        
        $participant = (new Participant())->getById($id);
        
        return $this->response($this->okStatus, $participant, '', 200);
    }
}