<?php
// src/Model/Entity/T_user.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class T_user extends Entity
{
    protected $_accessible = [
        '*' => true, // * là tất cả các trường còn lại
    ];
}