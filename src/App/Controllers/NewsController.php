<?php

namespace App\Controllers;

use App\Models\News;
use Framework\Db\Db;

class NewsController extends ApiController
{   
    //define ("OK_STATUS", "ok");
    const OK_STATUS = 'ok';
    const ERR_STATUS = 'error';
    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function indexAction()
    {
        $news = (new News())->getAll();
       
        return $this->response($this->okStatus, $news, 'Список новостей', 200);
      
    }

    
    public function viewAction($id)
    {
        if(!$id) {
            return $this->notifyResponse($this->errStatus, 'Не переданы обязательные параметры!', 422);
        }
        
        $news = (new News())->getById($id);
        
        return $this->response($this->okStatus, $news, 'Новость № '. $id, 200);
    }
   
}