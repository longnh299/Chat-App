<?php
// src/Model/Entity/T_feed.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class T_feed extends Entity
{
    protected $_accessible = [
        '*' => true, // * là tất cả các trường còn lại
        'id' => false
    ];
}