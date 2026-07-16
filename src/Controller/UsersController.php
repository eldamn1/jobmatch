<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout(null);
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            return $this->redirect(['action' => 'dashboard']);
        }

        $query = $this->Users->find();

        $search = $this->request->getQuery('search');
        $role = $this->request->getQuery('role');
        $status = $this->request->getQuery('status');
        $verified = $this->request->getQuery('verified');

        if (!empty($search)) {
            $or = [
                'Users.fullname LIKE' => '%' . $search . '%',
                'Users.email LIKE' => '%' . $search . '%',
            ];
            if (is_numeric($search)) {
                $or['Users.id'] = (int)$search;
            }
            $query->where(['OR' => $or]);
        }

        if ($role !== null && $role !== '') {
            $query->where(['Users.role_id' => (int)$role]);
        }
        if ($status !== null && $status !== '') {
            $query->where(['Users.status' => (string)$status]);
        }
        if ($verified !== null && $verified !== '') {
            $query->where(['Users.is_email_verified' => (int)$verified]);
        }

        if (!$this->request->getQuery('sort')) {
            $query->orderBy(['Users.created' => 'DESC']);
        }

        $users = $this->paginate($query);
        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        if (!$this->isAdmin()) {
            return $this->redirect(['action' => 'dashboard']);
        }

        $user = $this->Users->get($id, contain: ['Members']);
        $this->set(compact('user'));
    }

    public function add()
    {
        if (!$this->isAdmin()) {
            return $this->redirect(['action' => 'dashboard']);
        }

        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $isAdmin = ((int)($data['user_group_id'] ?? 0) === 1);
            $ugid = $isAdmin ? 1 : 0;
            $roleId = $isAdmin ? 1 : 2;

            $data['status'] = isset($data['status']) ? (string)(int)$data['status'] : '1';

            $avatarName = null;
            $avatarFile = $this->request->getUploadedFile('avatar');
            unset($data['avatar']);
            if ($avatarFile && $avatarFile->getError() === UPLOAD_ERR_OK) {
                $ext = pathinfo($avatarFile->getClientFilename(), PATHINFO_EXTENSION);
                $avatarName = 'avatar_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                $uploadPath = WWW_ROOT . 'img' . DS . 'avatars' . DS;
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $avatarFile->moveTo($uploadPath . $avatarName);
            }

            $user = $this->Users->patchEntity($user, $data);

            $user->user_group_id = $ugid;
            $user->role_id = $roleId;
            $user->status = $data['status'];
            $user->is_email_verified = 0;
            $user->slug = strtolower(str_replace(' ', '-', (string)($data['fullname'] ?? 'user'))) . '-' . time();
            $user->token_created_at = date('Y-m-d H:i:s');
            if ($avatarName) {
                $user->avatar = $avatarName;
                $user->avatar_dir = 'img/avatars';
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('User has been created.'));

                return $this->redirect(['action' => 'index']);
            }

            $errors = $user->getErrors();
            $this->Flash->error(__('Could not save user. ') . json_encode($errors));
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        if (!$this->isAdmin()) {
            return $this->redirect(['action' => 'dashboard']);
        }

        $user = $this->Users->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (isset($data['user_group_id']) && $data['user_group_id'] !== '') {
                $isAdmin = ((int)$data['user_group_id'] === 1);
                $data['user_group_id'] = $isAdmin ? 1 : 0;
                $data['role_id'] = $isAdmin ? 1 : 2;
            }

            if (isset($data['status'])) {
                $data['status'] = (string)(int)$data['status'];
            }
            if (empty($data['password'])) {
                unset($data['password']);
            }

            $uploadPath = WWW_ROOT . 'img' . DS . 'avatars' . DS;

            if (isset($data['delete_avatar']) && $data['delete_avatar'] === '1') {
                if (!empty($user->avatar) && is_file($uploadPath . $user->avatar)) {
                    @unlink($uploadPath . $user->avatar);
                }
                $data['avatar'] = null;
                $data['avatar_dir'] = null;
            }

            $avatarFile = $this->request->getUploadedFile('avatar');
            if ($avatarFile && $avatarFile->getError() === UPLOAD_ERR_OK) {
                $ext = pathinfo($avatarFile->getClientFilename(), PATHINFO_EXTENSION);
                $newName = 'avatar_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                if (!empty($user->avatar) && is_file($uploadPath . $user->avatar)) {
                    @unlink($uploadPath . $user->avatar);
                }
                $avatarFile->moveTo($uploadPath . $newName);
                $data['avatar'] = $newName;
                $data['avatar_dir'] = 'img/avatars';
            } else {
                if (!isset($data['delete_avatar']) || $data['delete_avatar'] !== '1') {
                    unset($data['avatar'], $data['avatar_dir']);
                }
            }

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('User has been updated.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Could not update user. ') . json_encode($user->getErrors()));
        }

        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        if (!$this->isAdmin()) {
            return $this->redirect(['action' => 'dashboard']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        $membersTable = $this->fetchTable('Members');
        foreach ($membersTable->find()->where(['user_id' => $id]) as $m) {
            $membersTable->delete($m);
        }

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('User has been deleted.'));
        } else {
            $this->Flash->error(__('Could not delete user.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $email = strtolower(trim((string)$this->request->getData('email')));
            $password = (string)$this->request->getData('password');

            $user = $this->Users->find()
                ->contain(['Roles'])
                ->where(['email' => $email])
                ->first();

            if ($user && (string)$user->password === $password) {
                $user->last_login = date('Y-m-d H:i:s');
                $this->Users->save($user, ['validate' => false, 'checkRules' => false]);

                $this->request->getSession()->write('user', $user);

                return $this->redirect(['action' => 'dashboard']);
            }

            $this->Flash->error(__('Login failed. Please check your email and password.'));
        }

        return $this->render('/Auth/login');
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $email = strtolower(trim((string)($data['email'] ?? '')));
            $password = (string)($data['password'] ?? '');
            $fullname = trim((string)($data['fullname'] ?? ''));

            if (str_ends_with($email, '@gmail.com')) {
                $roleId = 2;
                $ugid = 0;
            } elseif (str_ends_with($email, '@admin.com')) {
                $roleId = 1;
                $ugid = 1;
            } else {
                $this->Flash->error(__('Email must end with @gmail.com or @admin.com.'));
                $this->set(compact('user'));

                return $this->render('/Auth/register');
            }

            if (!$this->isStrongPassword($password)) {
                $this->Flash->error(__('Password must have 8+ chars, uppercase, lowercase, number, and a symbol.'));
                $this->set(compact('user'));

                return $this->render('/Auth/register');
            }

            $conn = $this->Users->getConnection();
            $slug = 'user-' . time();

            $conn->execute(
                'INSERT INTO users (role_id, user_group_id, fullname, password, email, status, is_email_verified, slug, token_created_at, created, modified)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), NOW())',
                [$roleId, $ugid, $fullname, $password, $email, '1', 0, $slug]
            );

            $userId = (int)$conn->execute('SELECT LAST_INSERT_ID() AS id')->fetch('assoc')['id'];

            $conn->execute(
                'INSERT INTO members (user_id, name, address, phone_number, resume, resume_dir, status, created, modified)
                 VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())',
                [$userId, $fullname, '', '', '', '', 1]
            );

            $this->Flash->success(__('Registration successful. Please log in.'));

            return $this->redirect(['action' => 'login']);
        }

        $this->set(compact('user'));

        return $this->render('/Auth/register');
    }

    public function dashboard()
    {
        $user = $this->request->getSession()->read('user');

        if (!$user) {
            return $this->redirect(['action' => 'login']);
        }

        $roleId = (int)($user->role_id ?? 0);
        $search = trim((string)$this->request->getQuery('search'));
        $statusFilter = $this->request->getQuery('status');
        $hasStatus = ($statusFilter !== null && $statusFilter !== '');

        $stats = ['total' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0];
        $recentApplications = [];
        $interviewAlert = null;
        $offerAlert = null;
        $latestJobs = [];
        $member = null;

        $adminStats = ['jobs' => 0, 'applicants' => 0, 'pending' => 0, 'approved' => 0];
        $recentApplicants = [];
        $recentJobs = [];

        if ($roleId === 1) {
            $advertisementsTable = $this->fetchTable('Advertisements');
            $applicationsTable = $this->fetchTable('Applications');

            $adminStats['jobs'] = $advertisementsTable->find()->count();
            $adminStats['applicants'] = $applicationsTable->find()->count();
            $adminStats['pending'] = $applicationsTable->find()->where(['status' => 0])->count();
            $adminStats['approved'] = $applicationsTable->find()->where(['status' => 1])->count();

            $appQuery = $applicationsTable->find()
                ->contain(['Members', 'Advertisements'])
                ->orderBy(['Applications.created' => 'DESC']);
            if ($search !== '') {
                $appQuery->where(['OR' => [
                    'Members.name LIKE' => '%' . $search . '%',
                    'Advertisements.title LIKE' => '%' . $search . '%',
                ]]);
            }
            if ($hasStatus) {
                $appQuery->where(['Applications.status' => (int)$statusFilter]);
            }
            $recentApplicants = $appQuery->limit(10)->toArray();

            $jobQuery = $advertisementsTable->find()
                ->contain(['Applications'])
                ->orderBy(['Advertisements.created' => 'DESC']);
            if ($search !== '') {
                $jobQuery->where(['Advertisements.title LIKE' => '%' . $search . '%']);
            }
            $recentJobs = $jobQuery->toArray();
        } else {
            $membersTable = $this->fetchTable('Members');
            $member = $membersTable->find()->where(['user_id' => $user->id])->first();

            if ($member) {
                $allApps = $this->fetchTable('Applications')->find()
                    ->where(['Applications.members_id' => $member->id])
                    ->contain(['Advertisements'])
                    ->orderBy(['Applications.created' => 'DESC'])
                    ->toArray();

                $stats['total'] = count($allApps);
                foreach ($allApps as $a) {
                    $st = (int)$a->status;
                    if (!empty($a->offer_letter)) {
                        $st = 1; 
                    }
                    if ($st === 0) {
                        $stats['pending']++;
                    } elseif ($st === 1) {
                        $stats['approved']++;
                    } elseif ($st === 2) {
                        $stats['rejected']++;
                    }
                }

                $filtered = $allApps;
                if ($search !== '') {
                    $filtered = array_filter($filtered, function ($a) use ($search) {
                        $title = (string)($a->advertisement->title ?? '');
                        return stripos($title, $search) !== false;
                    });
                }
                if ($hasStatus) {
                    $filtered = array_filter($filtered, function ($a) use ($statusFilter) {
                        $st = (int)$a->status;
                        if (!empty($a->offer_letter)) {
                            $st = 1;
                        }
                        return $st === (int)$statusFilter;
                    });
                }
                $recentApplications = array_slice(array_values($filtered), 0, 10);

                $ivAppIds = [];
                foreach ($allApps as $a) {
                    $ivAppIds[] = $a->id;
                }
                if (!empty($ivAppIds)) {
                    $interviewAlert = $this->fetchTable('Interviews')->find()
                        ->where(['Interviews.application_id IN' => $ivAppIds, 'Interviews.status' => 0])
                        ->contain(['Applications' => ['Advertisements']])
                        ->orderBy(['Interviews.interview_date' => 'ASC'])
                        ->first();
                }

                foreach ($allApps as $a) {
                    if (!empty($a->offer_letter)) {
                        $offerAlert = $a;
                        break;
                    }
                }
            }

            $jobQuery = $this->fetchTable('Advertisements')->find()
                ->orderBy(['Advertisements.created' => 'DESC']);
            if ($search !== '') {
                $jobQuery->where(['Advertisements.title LIKE' => '%' . $search . '%']);
            }
            $latestJobs = $jobQuery->toArray();
        }

        $this->set(compact(
            'user', 'roleId', 'search', 'statusFilter', 'interviewAlert', 'offerAlert',
            'stats', 'recentApplications', 'latestJobs', 'member',
            'adminStats', 'recentApplicants', 'recentJobs'
        ));

        return $this->render('/Dashboard/index');
    }

    public function logout()
    {
        $this->request->getSession()->destroy();

        return $this->redirect(['action' => 'login']);
    }

    private function isAdmin(): bool
    {
        $sessionUser = $this->request->getSession()->read('user');

        if (!$sessionUser || (int)$sessionUser->role_id !== 1) {
            $this->Flash->error(__('ADMIN ONLY.'));

            return false;
        }

        return true;
    }

    private function isStrongPassword(string $pw): bool
    {
        return strlen($pw) >= 8
            && preg_match('/[A-Z]/', $pw)
            && preg_match('/[a-z]/', $pw)
            && preg_match('/[0-9]/', $pw)
            && preg_match('/[^A-Za-z0-9]/', $pw);
    }
}