<?php
declare(strict_types=1);

class TestController extends \Phalcon\Mvc\Controller /* \Phalcon\Mvc\Controller 是 Phalcon 框架中用于處理 MVC 模式下控制器邏輯的 */
{
    public function indexAction()
    {
        $users = Users::find();
        $this->view->users = $users;
    }

    // 編輯的 Action
    public function editAction()
    {

    }
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