<?php
// src/Controller/ArticlesController.php

namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
class ChatController extends AppController
{   
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('T_feed');
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    public function index()
    {
        $this->loadComponent('Paginator');
        $t_feed = $this->Paginator->paginate($this->T_feed->find());
        $this->set(compact('t_feed'));
    }
    public function view($id = null)
    {
        $t_feed = $this->Chat->findBySlug($id)->firstOrFail();
        $this->set(compact('t_feed'));
    }
    public function add()
    {
        $t_feed = $this->T_feed->newEmptyEntity();
        if ($this->request->is('post')) {
            $chat = $this->T_feed->patchEntity($t_feed, $this->request->getData());
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            date_default_timezone_get();
            $time = FrozenTime::now();
            //$now = FrozenTime::parse('now');
            $_now = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $t_feed->create_at=$_now;
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$t_feed->id = 1;

            if ($this->T_feed->save($t_feed)) {
                $this->Flash->success(__('Your chat is sended.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('t_feed', $t_feed);
        // if($this->request->is('post')){
        //     $name=$this->request->getData('name');
        //     $message=$this->request->getData('message');
        //     $t_feed_table = TableRegistry::get('t_feed');
        //     $t_feed=$t_feed_table->newEntity($this->request->getData());
        //     $t_feed->name=$name;
        //     $t_feed->message=$message;
        //     $this->set('t_feed', $t_feed);
        //     if($t_feed_table->save($t_feed)){
        //         echo "message is sended";
        //         //$this->redirect(['action' => 'index']);
        //     }
        // }
    }
    public function edit($id)
    {
        $t_feed = $this->T_feed
            ->findById($id)
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->T_feed->patchEntity($t_feed, $this->request->getData());
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            date_default_timezone_get();
            $time = FrozenTime::now();
            //$now = FrozenTime::parse('now');
            $_now = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $t_feed->update_at=$_now;
            if ($this->T_feed->save($t_feed)) {
                $this->Flash->success(__('This Message has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('t_feed', $t_feed);
    }
    public function delete($id)
{
    $this->request->allowMethod(['post', 'delete']);

    $t_feed = $this->T_feed->findById($id)->firstOrFail();
    if ($this->T_feed->delete($t_feed)) {
        $this->Flash->success(__('The {0} message has been deleted.', $t_feed->name));
        return $this->redirect(['action' => 'index']);
    }
}
}