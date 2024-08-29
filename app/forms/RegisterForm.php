<?php
namespace App\Forms; //for loader.php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;

class RegisterForm extends Form // Phalcon\Forms\Form
{
    public function initialize()
    {
        //定義一個 name 字段
        $this->add(
            new Text(
                'name',
                [
                    "placeholder" => "Type your name",
                    "class" => "form-control",
                ]
            )
        );

        //定義一個 email 字段
        $this->add(
            new Email(
                "email",
                [
                    "placeholder" => "Type your email",
                    "class" => "form-control",
                ]
            )
        );
    }
}