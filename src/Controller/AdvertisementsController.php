<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Advertisements Controller
 * @property \App\Model\Table\AdvertisementsTable 
 */
class AdvertisementsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
    }

    public function home()
    {
        $this->viewBuilder()->setLayout(null);

        $advertisements = $this->Advertisements->find()
            ->orderBy(['Advertisements.created' => 'DESC'])
            ->all();

        $this->set(compact('advertisements'));
    }

    public function detail($id = null)
    {
        $this->viewBuilder()->setLayout(null);

        $advertisement = $this->Advertisements->get($id);

        $this->set(compact('advertisement'));
    }

    public function index()
    {
        $search = trim((string)$this->request->getQuery('search'));
        $category = trim((string)$this->request->getQuery('category'));
        $jobType = trim((string)$this->request->getQuery('job_type'));

        $query = $this->Advertisements->find()
            ->contain(['Applications'])
            ->orderBy(['Advertisements.created' => 'DESC']);

        if ($search !== '') {
            $query->where([
                'OR' => [
                    'Advertisements.title LIKE' => '%' . $search . '%',
                    'Advertisements.location LIKE' => '%' . $search . '%',
                ],
            ]);
        }

        if ($category !== '') {
            $query->where(['Advertisements.category' => $category]);
        }

        if ($jobType !== '') {
            $query->where(['Advertisements.job_type' => $jobType]);
        }

        $advertisements = $this->paginate($query);

        $categories = $this->Advertisements->find()
            ->select(['category'])
            ->distinct(['category'])
            ->where(['category IS NOT' => null, 'category !=' => ''])
            ->orderBy(['category' => 'ASC'])
            ->all()
            ->extract('category')
            ->toList();

        $jobTypes = $this->Advertisements->find()
            ->select(['job_type'])
            ->distinct(['job_type'])
            ->where(['job_type IS NOT' => null, 'job_type !=' => ''])
            ->orderBy(['job_type' => 'ASC'])
            ->all()
            ->extract('job_type')
            ->toList();

        $this->set(compact('advertisements', 'search', 'category', 'jobType', 'categories', 'jobTypes'));
    }

    public function add()
    {
        $advertisement = $this->Advertisements->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $membersTable = $this->Advertisements->Members;
            $sessionUser = $this->request->getSession()->read('user');
            $member = null;
            if ($sessionUser && !empty($sessionUser->id)) {
                $member = $membersTable->find()->where(['user_id' => $sessionUser->id])->first();
            }
            if (!$member) {
                $member = $membersTable->find()->first();
            }
            $data['members_id'] = $member ? $member->id : null;
            $data['status'] = 1;

            $poster = $data['poster'] ?? null;
            unset($data['poster']);

            $advertisement = $this->Advertisements->patchEntity($advertisement, $data);

            if ($poster && is_object($poster) && $poster->getError() === UPLOAD_ERR_OK) {
                $uploadDir = WWW_ROOT . 'uploads' . DS . 'posters' . DS;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = time() . '_' . $poster->getClientFilename();
                $poster->moveTo($uploadDir . $filename);
                $advertisement->poster = $filename;
                $advertisement->poster_dir = 'uploads/posters/';
            }

            if ($this->Advertisements->save($advertisement)) {
                $this->Flash->success(__('Job position has been added.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save the job. Please check the form.'));
        }

        $this->set(compact('advertisement'));
    }

    public function manage($id = null)
    {
        $advertisement = $this->Advertisements->get($id, contain: [
            'Applications' => ['Members'],
        ]);

        $applicantCount = count($advertisement->applications);

        $interviews = [];
        $appIds = [];
        foreach ($advertisement->applications as $a) {
            $appIds[] = $a->id;
        }
        if (!empty($appIds)) {
            foreach ($this->fetchTable('Interviews')->find()
                ->where(['Interviews.application_id IN' => $appIds])
                ->all() as $iv) {
                $interviews[$iv->application_id] = $iv;
            }
        }

        $this->set(compact('advertisement', 'applicantCount', 'interviews'));
    }

    public function edit($id = null)
    {
        $advertisement = $this->Advertisements->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $poster = $data['poster'] ?? null;
            unset($data['poster']);

            $advertisement = $this->Advertisements->patchEntity($advertisement, $data);

            if ($poster && is_object($poster) && $poster->getError() === UPLOAD_ERR_OK) {
                $uploadDir = WWW_ROOT . 'uploads' . DS . 'posters' . DS;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = time() . '_' . $poster->getClientFilename();
                $poster->moveTo($uploadDir . $filename);
                $advertisement->poster = $filename;
                $advertisement->poster_dir = 'uploads/posters/';
            }

            if ($this->Advertisements->save($advertisement)) {
                $this->Flash->success(__('Job position has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not update. Please check the form.'));
        }

        $this->set(compact('advertisement'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $advertisement = $this->Advertisements->get($id);
        if ($this->Advertisements->delete($advertisement)) {
            $this->Flash->success(__('Job position has been deleted.'));
        } else {
            $this->Flash->error(__('Could not delete the job position.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function offerLetter($id = null)
    {
        $this->request->allowMethod(['post']);

        $applicationsTable = $this->fetchTable('Applications');
        $application = $applicationsTable->get($id);

        $application->offer_letter = (string)$this->request->getData('offer_letter');
        $application->status = 1; // 1 = Approved (candidate got the job)

        if ($applicationsTable->save($application, ['validate' => false, 'checkRules' => false])) {
            $this->Flash->success(__('Offer letter sent. The applicant has been approved and hired.'));
        } else {
            $this->Flash->error(__('Could not save offer letter.'));
        }

        return $this->redirect(['action' => 'manage', $application->advertisement_id]);
    }

    public function downloadResume($id = null)
    {
        $application = $this->fetchTable('Applications')->get($id, contain: ['Members']);
        $member = $application->member;

        if (empty($member->resume)) {
            $this->Flash->error(__('Resume not found.'));
            return $this->redirect($this->referer());
        }

        $path = WWW_ROOT . str_replace('/', DS, rtrim((string)$member->resume_dir, '/')) . DS . $member->resume;

        if (!is_file($path)) {
            $this->Flash->error(__('Resume file is missing on the server.'));
            return $this->redirect($this->referer());
        }

        return $this->response->withFile($path, ['download' => true, 'name' => $member->resume]);
    }

    public function applicantProfile($id = null)
    {
        $application = $this->fetchTable('Applications')->get($id, contain: [
            'Members' => ['Users'],
            'Advertisements',
        ]);

        $this->set(compact('application'));
    }

    public function changeStatus($id = null, $status = null)
    {
        $this->request->allowMethod(['post']);

        $application = $this->fetchTable('Applications')->get($id);
        $application->status = (int)$status;

        if ($this->fetchTable('Applications')->save($application)) {
            $this->Flash->success(__('Applicant status updated successfully.'));
        } else {
            $this->Flash->error(__('Failed to update status.'));
        }

        return $this->redirect($this->referer());
    }
}