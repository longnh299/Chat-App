<?php
// in src/Model/Table/T_userTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
// the Text class
use Cake\Utility\Text;
// the EventInterface class
use Cake\Event\EventInterface;
// the Validator class
use Cake\Validation\Validator;
// Add the following method.
class T_userTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function beforeSave(EventInterface $event, $entity, $options)
    {
        
    }
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('email')
            ->minLength('email', 1)
            ->maxLength('email', 255)

            ->notEmptyString('name')
            ->minLength('name', 1);

        return $validator;
    }
}
