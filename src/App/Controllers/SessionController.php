<?php
declare(strict_type=1);

namespace App\Controllers;

use App\Repositories\Session;
use App\Repositories\Speaker;

class SessionController extends ApiController
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
        $sessions = (new Session())->getAll();
        
        return $this->response($this->okStatus, $sessions, '');
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
        
        $session = (new Session())->getById($id);
         
        $session['Speakers'] = (new Speaker())->getBySessionId($id);
        
        return $this->response(static::OK_STATUS, $session, '');
    }
}