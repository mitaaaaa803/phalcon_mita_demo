<?php
namespace App\Forms; //for loader.php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Submit;

class RegisterForm extends Form // Phalcon\Forms\Form
{
    public function initialize()
    {
        //定義一個 name 字段
        $name = new Text(
            'name',
            [
                "placeholder" => "Type your name",
                "class" => "form-control",
            ]
        );
        $this->add($name);

        //定義一個 email 字段
        $email = new Email(
                "email",
                [
                    "placeholder" => "Type your email",
                    "class" => "form-control",
                ]
        );
        $this->add($email);

        $sumit = new Submit(
                "sumit",
                [
                    "value" => "Register",
                    "class" => "btn btn-primary",
                    "style" => "background-color: #000" /* 更改顏色 */
                ]
        );
        $this->add($sumit);
    }
}