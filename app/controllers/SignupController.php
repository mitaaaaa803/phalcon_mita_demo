<?php
use Phalcon\Http\Request;

// use form //新增 RegisterForm 路徑
use App\Forms\RegisterForm;  

class SignupController extends ControllerBase
{

    public function indexAction()
    { 
        // var_dump(new RegisterForm());exit;
        $this->view->form = new RegisterForm();

        // $this->flash->success('Thanks');
        // exit;
    }

    public function registerAction()
    {
        $request = new Request();
        $user = new users();

        if (!$this->request->isPost()) {
            return $this->response->redirect('signup');  /* 重回到 signup 頁面*/
            
        }
            $name = $this->request->getPost('name', 'string');/* post 請求中獲取 name 字段*/ /* echo 顯示 name = qqq */
            $email = $this->request->getPost('email', 'email');/* post 請求中獲取 email 字段*/ /* echo 顯示 email = mitawu0803@gmail.com */


        // print_r($this->request->isPost()); /* 在 PHP 中，true 被輸出時會顯示為 1，1 = true， 不顯示 = false */
        // exit;

        // 回傳值(true/false)
        // var_dump($request->isPost()); //Post Request
        // var_dump($request->isAjax()); //Ajax Request
        // exit;

        /*
        Debug: Check the data received from the form
        */
        // var_dump($this->request->getPost());
        // exit;



        //assign value from the form to $user
        $user->assign(
            // $this->request->getPost(), //不希望直接從 POST 數據中分配所有字段的值，而是想手動控制要分配的值
            [
                // 手動控制要分配的值 ' ' => $
                'name'=> $name,
                'email'=> $email,
            ],
            [   
                'name',
                'email'
            ],
        );
        
        // Store and check for errors
        $success = $user->save();

        /* var_dump() the types would be:
            array
            string
            int
            bool
        */

        // var_dump($success);exit;

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            // echo "Thanks for registering!";
            // $this->flash->success('Thanks for registering!'); 消息在當前請求處理後即被銷毀，不適用於跨請求的場景。
            $this->flashSession->success('Thanks for registering!');

            // Forward to the index action
            // return $this->response->redirect('signup'); /* 重回到 signup 頁面*/
        } else {
            // echo "Sorry, the following problems were generated:<br>"; 消息在會活存儲，直到下一次請求被處理，並在用户看到消息後銷毀。
            $this->flashSession->success('Sorry, the following problems were generated');
            // return $this->response->redirect('signup');  /* 重回到 signup 頁面*/
        }

    }
}

