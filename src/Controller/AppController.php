<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */

class AppController extends Controller
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

    }

    /**
     * @param \Cake\Event\EventInterface 
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $allowedWithoutLogin = [
            'Users' => ['login', 'register'],
            'Advertisements' => ['home', 'detail'],
        ];

        $controllerName = $this->getName();
        $actionName = $this->request->getParam('action');

        $isPublic = isset($allowedWithoutLogin[$controllerName])
            && in_array($actionName, $allowedWithoutLogin[$controllerName], true);

        if (!$isPublic) {
            $user = $this->request->getSession()->read('user');

            if (!$user) {
                $this->Flash->error(__('Sila log masuk dahulu.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        }

        return null;
    }
}