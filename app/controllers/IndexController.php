<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $users = Users::find();      //查詢所有用戶數據
        $this->view->users = $users; //結果傳遞到前台
    }

}

