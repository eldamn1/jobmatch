<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable 
 */
class MembersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
    }

    public function myProfile()
    {
        $user = $this->request->getSession()->read('user');

        if (!$user) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $member = $this->Members->find()->where(['user_id' => $user->id])->first();

        if (!$member) {
            $member = $this->Members->newEmptyEntity();
            $member->user_id = $user->id;
            $member->name = $user->fullname;
            $member->status = 1;
            $this->Members->save($member, ['validate' => false, 'checkRules' => false]);
        }

        return $this->redirect(['action' => 'edit', $member->id]);
    }

    public function edit($id = null)
    {
        $member = $this->Members->get($id);
        $sessionUser = $this->request->getSession()->read('user');
        $profileUser = $this->Members->Users->get($member->user_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $avatarFile = $this->request->getUploadedFile('avatar');
            unset($data['avatar']);
            if ($avatarFile && $avatarFile->getError() === UPLOAD_ERR_OK) {
                $ext = pathinfo($avatarFile->getClientFilename(), PATHINFO_EXTENSION);
                $newName = 'avatar_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                $dir = WWW_ROOT . 'img' . DS . 'avatars' . DS;
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                $avatarFile->moveTo($dir . $newName);

                $profileUser->avatar = $newName;
                $profileUser->avatar_dir = 'img/avatars';
                $this->Members->Users->save($profileUser, ['validate' => false, 'checkRules' => false]);

                if ($sessionUser) {
                    $sessionUser->avatar = $newName;
                    $this->request->getSession()->write('user', $sessionUser);
                }
            }

            $resumeFile = $this->request->getUploadedFile('resume');
            unset($data['resume']);
            if ($resumeFile && $resumeFile->getError() === UPLOAD_ERR_OK) {
                if ($resumeFile->getSize() <= 5 * 1024 * 1024) {
                    $rname = time() . '_' . $resumeFile->getClientFilename();
                    $rdir = WWW_ROOT . 'uploads' . DS . 'resumes' . DS;
                    if (!is_dir($rdir)) {
                        mkdir($rdir, 0755, true);
                    }
                    $resumeFile->moveTo($rdir . $rname);
                    $data['resume'] = $rname;
                    $data['resume_dir'] = 'uploads/resumes/';
                } else {
                    $this->Flash->error(__('Resume too large (max 5 MB).'));
                }
            }

            $member = $this->Members->patchEntity($member, $data, ['accessibleFields' => ['*' => true]]);

            if ($this->Members->save($member, ['validate' => false, 'checkRules' => false])) {
                $this->Flash->success(__('Profile updated successfully.'));

                return $this->redirect(['action' => 'edit', $member->id]);
            }

            $this->Flash->error(__('Could not update profile. Please try again.'));
        }

        $this->set(compact('member', 'profileUser', 'sessionUser'));
    }
}