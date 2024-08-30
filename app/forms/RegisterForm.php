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

        // form email field 
        $name = new Text(
            'name',
            [
                "placeholder" => "Type your name",
                "class" => "form-control",
            ]
        );

        // form email field 
        $email = new Email(
                "email",
                [
                    "placeholder" => "Type your email",
                    "class" => "form-control",
                ]
        );

        // form submit button
        $submit = new Submit(
                "submit",
                [
                    "value" => "Register",
                    "class" => "btn btn-primary",
                    "style" => "background-color: #000" /* 更改顏色 */
                ]
        );
        $this->add($name);
        $this->add($email);
        $this->add($submit);
        
    }
    
}