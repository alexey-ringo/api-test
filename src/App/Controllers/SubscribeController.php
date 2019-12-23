<?php
declare(strict_type=1);

namespace App\Controllers;

use App\Repositories\Subscribe;
use App\Repositories\Session;
use App\Repositories\Participant;

class SubscribeController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }   

    
    /**
     * storeAction
     *
     * @return string
     */
    public function storeAction(): string
    {
        if (empty($_POST['sessionId'])) {
            return $this->notifyResponse(static::ERR_STATUS, 'Не переданы параметры сессии!', 422);
        }
        
        if (empty($_POST['userEmail'])) {
            return $this->notifyResponse(static::ERR_STATUS, 'Не переданы параметры пользователя!', 422);
        }
        
        $sessionId = $_POST['sessionId'];
        $userEmail = $_POST['userEmail'];
        
        $participant = (new Participant())->getByEmail($userEmail);     

       
        if(empty($participant)) {
            return $this->notifyResponse(static::ERR_STATUS, 'Пользователь не найден!', 404);
        }
        
        $session = (new Session())->getById($sessionId);
        
        if(empty($session)) {
            return $this->notifyResponse(static::ERR_STATUS, 'Сессия не найдена!', 404);
        }
        
        $subscribe = new Subscribe;
        
        if($subscribe->create($participant[0]['ID'], $session[0]['ID'])) {
            return $this->notifyResponse(static::OK_STATUS, 'Спасибо, вы успешно записаны!');
        }
        else {
            return $this->notifyResponse(static::OK_STATUS, 'Извините, произошла внутренняя ошибка сервера', 500);
        }       

    }
    
}