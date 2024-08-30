<?php
use Phalcon\Http\Request;

// use form //新增 RegisterForm 路徑
use App\Forms\RegisterForm;  

class SignupController extends ControllerBase
{  
    public function indexAction()
    { 
        $this->view->form = new RegisterForm();

    }

    public function registerAction()
    {
        $request = new Request();
        $user = new Users();
        $form = new RegisterForm();

        if (!$this->request->isPost()) {
            return $this->response->redirect('signup');  /* 重回到 signup 頁面*/    
        }

        $name = $this->request->getPost('name', 'string');  /* post 請求中獲取 name 字段*/  /* echo 顯示 name = qqq */
        $email = $this->request->getPost('email', 'email'); /* post 請求中獲取 email 字段*/ /* echo 顯示 email = mitawu0803@gmail.com */

        $user->assign(
            // $this->request->getPost(), //不希望直接從 POST 數據中分配所有字段的值，而是想手動控制要分配的值
            [
                // 手動控制要分配的值 ' ' => $
                'name'=> $name,
                'email'=> $email,
            ],
        );
        
        $success = $user->save();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $this->flashSession->success('Thanks for registering!');
        } else {
            $this->flashSession->success('Sorry, the following problems were generated');
        }
    }
}

