<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\Speaker;
use Framework\Db\Db;

class SessionController extends ApiController
{
    const OK_STATUS = 'ok';
    const ERR_STATUS = 'error';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function indexAction()
    {
        $sessions = (new Session())->getAll();
        
        return $this->response($this->okStatus, $sessions, '', 200);
    }

    public function viewAction($id)
    {
        if(!$id) {
            return $this->notifyResponse($this->errStatus, 'Не переданы обязательные параметры!', 422);
        }
        
        $session = (new Session())->getById($id);
         
        $session['Speakers'] = (new Speaker())->getBySessionId($id);
        
        return $this->response($this->okStatus, $session, '', 200);
    }
}