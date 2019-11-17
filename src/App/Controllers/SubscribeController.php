<?php

namespace App\Controllers;

use App\Models\Subscribe;
use App\Models\Session;
use App\Models\Participant;

class SubscribeController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    const OK_STATUS = 'ok';
    const ERR_STATUS = 'error';

    
    public function storeAction()
    {
        if (empty($_POST['sessionId'])) {
            return $this->notifyResponse($this->errStatus, 'Не переданы параметры сессии!', 422);
        }
        
        if (empty($_POST['userEmail'])) {
            return $this->notifyResponse($this->errStatus, 'Не переданы параметры пользователя!', 422);
        }
        
        $sessionId = $_POST['sessionId'];
        $userEmail = $_POST['userEmail'];
        
        $participant = (new Participant())->getByEmail($userEmail);
       
        if(empty($participant)) {
            return $this->notifyResponse($this->errStatus, 'Пользователь не найден!', 422);
        }
        
        $session = (new Session())->getById($sessionId);
        
        if(empty($session)) {
            return $this->notifyResponse($this->errStatus, 'Сессия не найдена!', 422);
        }
        
        $subscribe = new Subscribe;
        
        if($subscribe->create($participant[0]['ID'], $session[0]['ID'])) {
            return $this->notifyResponse($this->okStatus, 'Спасибо, вы успешно записаны!', 422);
        }
        else {
            return $this->notifyResponse($this->errStatus, 'Извините, произошла внутренняя ошибка сервера', 422);
        }
    }
    
}