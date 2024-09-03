<?php

declare(strict_types=1);
use Phalcon\Di;
use Phalcon\Mvc\Model\Query;

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class APIController extends \Phalcon\Mvc\Controller
{

    /**
     * Simple GET API Request 
     * 
     * @method GET
     * @link /api/get
     */
    public function getAction() //GET請求
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response(); //創建一個新的 Response 物件

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method GET ( $this->request->isGet() )
        if ($request->isGet()) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            // Use Model for database Query
            $returnData = [
                "name" => "C Tech Hindi",
                "youtube" => "https://www.youtube.com/channel/UCfd4AN4UKiWyHDdq-fizQGA"
            ];

            // Set status code
            $response->setStatusCode(200, 'OK');

            // Set the content of the response
            $response->setJsonContent(["status" => true, "error" => false, "data" => $returnData ]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple POST API Request without Param Data
     * 
     * @method POST
     * @link /api/post
     */
    public function postAction()
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method POST ( $this->request->isPost() )
        if ($request->isPost()) {

            $q = $this->request->getPost('id');

            if(isset($q)){
                $id = $q;
            }else{
                $id = 1;
            }

            // $response = new Response();
            $container = Di::getDefault();
            $query = new Query(
                ('SELECT * FROM users WHERE id ='.$id),
                $container
            );

            $post = $query->execute();
            // return $post;

            // $returnData = [
            //     "name" => "C Tech Hindi",
            //     "youtube" => "https://www.youtube.com/channel/UCfd4AN4UKiWyHDdq-fizQGA"
            // ];

            // Set status code
            $response->setStatusCode(200, 'OK');


            //原生 php 寫法:
            // $data = array();
            // foreach ($posts as $post){
            //     $data[] = array(
            //         'id'				=>	$post->id,
            //         'owner_name'		=>	$post->name,					
            //         'horse_power'		=>	$post->email
            //     );
            // }
    
            // // 回傳資料為json格式
            // return json_encode($data);
            

            // Set the content of the response
            $response->setJsonContent(["status" => true, "error" => false, "data" => $post ]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple POST API Request with Param Data
     * 
     * @method POST
     * @link /api/post_param/{paramData}
     */
    public function post_paramAction($paramData)
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method POST ( $this->request->isPost() )
        if ($request->isPost()) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            // Use Model for database Query
            $returnData = [
                "name" => "C Tech Hindi",
                "youtube" => "https://www.youtube.com/channel/UCfd4AN4UKiWyHDdq-fizQGA",
                "paramData" => $paramData
            ];

            // Set status code
            $response->setStatusCode(200, 'OK');

            // Set the content of the response
            $response->setJsonContent(["status" => true, "error" => false, "data" => $returnData ]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple POST API Request with Form Data
     * 
     * @method POST
     * @link /api/post_form_data
     */
    public function post_form_dataAction()
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method POST ( $this->request->isPost() )
        if ($request->isPost()) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            // Use Model for database Query
            $returnData = [
                "name" => "C Tech Hindi",
                "youtube" => "https://www.youtube.com/channel/UCfd4AN4UKiWyHDdq-fizQGA",
                "postData" => $request->getPost()
            ];

            // Set status code
            $response->setStatusCode(200, 'OK');

            // Set the content of the response
            $response->setJsonContent(["status" => true, "error" => false, "data" => $returnData ]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple POST API Request for User Login
     * 
     * @method POST
     * @link /api/login
     */
    public function loginAction()
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method POST ( $this->request->isPost() )
        if ($request->isPost()) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            $email = $request->getPost("email");
            $password = md5($request->getPost("password"));

            // Check user exist in database table
            $user = Users::findFirst([
                'conditions' => 'email = ?1 and password = ?2',
                'bind' => [
                    1 => $email,
                    2 => $password,
                ]
            ]);

            if ($user) {

                // Use Model for database Query
                $returnData = [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $email,
                ];

                // Set status code
                $response->setStatusCode(200, 'OK');

                // Set the content of the response
                $response->setJsonContent(["status" => true, "error" => false, "message" => "Login Successful. :)", "data" => $returnData ]);

            } else {

                // Set status code
                $response->setStatusCode(400, 'Bad Request');

                // Set the content of the response
                $response->setJsonContent(["status" => false, "error" => "Invalid Email and Password."]);
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }
}
