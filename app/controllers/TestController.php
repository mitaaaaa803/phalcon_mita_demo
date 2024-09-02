<?php
declare(strict_types=1);

class TestController extends \Phalcon\Mvc\Controller /* \Phalcon\Mvc\Controller 是 Phalcon 框架中用于處理 MVC 模式下控制器邏輯的 */
{
    public function indexAction()
    {
        $users = Users::find();
        $this->view->users = $users;
    }

    // 顯示用戶的現有資料在編輯頁面
    public function editAction($id) 
    {
        $user = Users::findFirst($id);

        if (!$user) {
        $this->flashSession->error("未找到用户");
        $this->dispatcher->forward(['action' => 'index']);
        }else{ 
            $this->tag->displayTo("id", $user->id);
            $this->tag->displayTo("name", $user->name);
            $this->tag->displayTo("email", $user->email);
        }
    }

    // 修改資料動作
    public function updateAction() 
    {
        if (!$this->request->isPost()) {
            $this->flashSession->error("無效的資料請求");
        } else {
            $id = $this->request->getPost("id");
            $user = Users::findFirst($id);// 使用這個 ID 從資料庫中查找相應的用戶。
        
        if (!$user) {
            $this->flashSession->error("沒有該筆資料");
        } else {
            //修改 名字 和 email
            $user->name = $this->request->getPost("name");
            $user->email = $this->request->getPost("email");
            
            error_log(print_r($user->toArray(), true));
            $success = $user->save();

            if (!$success) {
                foreach($user->getMessages() as $message) { 
                    error_log("更新失敗: " . $message);
                    $this->flashSession->outputMessage("error", ("更新失敗: ".$message));
                }
                
                // 到編輯頁面，以便他們可以修正錯誤。
                return $this->dispatcher->forward(array(
                    "action" => "edit",
                    "params" => array($user->id)
                )); 
            }
            
            //保存成功
            $this->flashSession->success("更新成功!");
            }
        } 
        // 無論成功與否，回到首頁。
        $this->dispatcher->forward(['action' => 'index']); 
    }
    
     // 刪除資料動作
    public function deleteAction($id)
        {
            $users = Users::findFirst($id);

            if (!$users) {
                $this->flashSession->error("未找到");
                return $this->response->redirect("test");
            }

            if ($users->delete()) {
                $this->flashSession->success("刪除成功");
                return $this->response->redirect("test"); /* 跳回 test 頁面 */
            }else {
                $messages = $users->getMessages();
                foreach ($messages as $message) {{
                    $this->flashSession->error("刪除失敗");
                }
            }    
        }
    }
}