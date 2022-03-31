<?php
// src/Controller/UserController.php

namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
class UserController extends AppController
{   
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('T_user');
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $session = $this->getRequest()->getSession();
        $session->delete('email');
        $session->delete('name');
    }

   public function login()
   {
        $t_user = $this->T_user->newEmptyEntity();
        if ($this->request->is(['post', 'put'])) {
            $this->T_user->patchEntity($t_user, $this->request->getData());
            if (!filter_var($t_user->email,FILTER_VALIDATE_EMAIL)){
                $this->Flash->error(_('error email format.'));
                return $this->redirect(['action'=>'login']);
            }
             else {
                $t_user_old = $this->T_user->find();
                $flag=0;
                foreach ($t_user_old as $tu):
                    if($tu->email==$t_user->email && $tu->password==$t_user->password){
                        //$this->Flash->success(_('Login successfully'));
                        $session = $this->getRequest()->getSession();
                        $session->write('email', $tu->email);
                        $session->write('name', $tu->name);
                        return $this->redirect(['controller'=>'chat','action'=>'index']);
                        $flag=1;
                        //break;
                    }
                endforeach;
                if($flag==0){
                    //$this->Flash->error(_('incorrect email or password'));
                    return $this->redirect(['action' => 'login']);
                }
            }
        }

        $this->set('t_user', $t_user);
   }
   public function regist()
   {
    $t_user = $this->T_user->newEmptyEntity();
    if ($this->request->is('post')) {
        $t_user = $this->T_user->patchEntity($t_user, $this->request->getData());
        $t_user_old=$this->T_user->find();
        foreach ($t_user_old as $tu):
            if($tu->email==$t_user->email){
                $this->Flash->success(__('This email is exict'));
            return $this->redirect(['action' => 'regist']);
            }
        else if ($this->T_user->save($t_user)) {
            $this->Flash->success(__('You is registed this account.'));
            return $this->redirect(['action' => 'login']);
        }
        $this->Flash->error(__('you do not regist successfully'));
    endforeach;
    }
    $this->set('t_user', $t_user);
   }
   public function logout(){
    $this->Authentication->logout();
    return $this->redirect(['controller' => 'user', 'action' => 'login']);
   }
}
