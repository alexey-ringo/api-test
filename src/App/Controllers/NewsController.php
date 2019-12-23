<?php
declare(strict_type=1);

namespace App\Controllers;

use App\Repositories\News;

class NewsController extends ApiController
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
        $news = (new News())->getAll();        
       
        return $this->response(static::OK_STATUS, $news, 'Список новостей');
      
    }

    
    /**
     * viewAction
     *
     * @param  int $id
     *
     * @return string
     */
    public function viewAction($id): string
    {
        if(!$id) {
            return $this->notifyResponse(static::ERR_STATUS, 'Не переданы обязательные параметры!', 422);
        }

        $news = (new News())->getById($id);

        if(empty($news)) {
            return $this->notifyResponse(static::ERR_STATUS, 'Новость ' . $id . ' не найдена!', 404);
        }
        
        return $this->response(static::OK_STATUS, $news, 'Новость № '. $id);
    }   
}