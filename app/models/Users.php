<!-- Create New Folder: Users.php in app/models -->
<?php

use Phalcon\Mvc\Model;

class users extends Model /* users is MySQL table's name */
{
    public $id;
    public $name;
    public $email;
    
}
