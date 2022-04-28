<?php
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
    // chat detail
    public function view($id = null)
    {
        $t_feed = $this->T_feed->findById($id)->firstOrFail();
        $this->set(compact('t_feed'));
    }
    // add chat
    public function add()
    {
        $t_feed = $this->T_feed->newEmptyEntity();
        if ($this->request->is('post')) {
            $chat = $this->T_feed->patchEntity($t_feed, $this->request->getData());
            // format time
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            date_default_timezone_get();
            $currentTime = FrozenTime::now();
            $dateTime = $currentTime->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $t_feed->create_at = $dateTime;
            $session = $this->getRequest()->getSession();
            $t_feed->user_id = $session->read('user_id');
            $t_feed->name = $session->read('name');
            // save media file into webroot
            if (!$t_feed->getErrors) {
                $attachment = $this->request->getData('Media');
                $name = $attachment->getClientFilename();
                if (strpos($name, '.mp4') !== false or strpos($name, '.webm') !== false or strpos($name, '.ogg') !== false) {
                    $targetPath = WWW_ROOT . 'video' . DS . $name;
                } elseif (strpos($name, '.mp3') !== false or strpos($name, '.wav') !== false) {
                    $targetPath = WWW_ROOT . 'audio' . DS . $name;
                } else $targetPath = WWW_ROOT . 'img' . DS . $name;
                if ($name) {
                    $attachment->moveTo($targetPath);
                    $t_feed->imagefilename = $name;
                }
            }
            // save into database
            if ($this->T_feed->save($t_feed)) {
                $this->Flash->success(__('Your chat is sended.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your chat.'));
        }
        $this->set('t_feed', $t_feed);
    }
    // edit chat
    public function edit($id)
    {
        $t_feed = $this->T_feed
            ->findById($id)
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->T_feed->patchEntity($t_feed, $this->request->getData());
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            date_default_timezone_get();
            $currentTime = FrozenTime::now();
            $dateTime = $currentTime->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $t_feed->update_at = $dateTime;
            if (!$t_feed->getErrors) {
                $attachment = $this->request->getData('Media');
                $name = $attachment->getClientFilename();
                if (strpos($name, '.mp4') !== false or strpos($name, '.webm') !== false or strpos($name, '.ogg') !== false) {
                    $targetPath = WWW_ROOT . 'video' . DS . $name;
                } elseif (strpos($name, '.mp3') !== false or strpos($name, '.wav') !== false) {
                    $targetPath = WWW_ROOT . 'audio' . DS . $name;
                } else $targetPath = WWW_ROOT . 'img' . DS . $name;
                if ($name) {
                    $attachment->moveTo($targetPath);
                    $t_feed->imagefilename = $name;
                }
            }
            if ($this->T_feed->save($t_feed)) {
                $this->Flash->success(__('This Message has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your message.'));
        }

        $this->set('t_feed', $t_feed);
    }
    // delete chat
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $t_feed = $this->T_feed->findById($id)->firstOrFail();
        if ($this->T_feed->delete($t_feed)) {
            $this->Flash->success(__('The message of {0} has been deleted.', $t_feed->name));
            return $this->redirect(['action' => 'index']);
        }
    }
}
