<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * @property \App\Model\Table\ApplicationsTable 
 */
class ApplicationsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
    }

    public function index()
    {
        $sessionUser  = $this->request->getSession()->read('user');
        $membersTable = $this->fetchTable('Members');

        $member = $membersTable->find()
            ->where(['user_id' => $sessionUser->id ?? 0])
            ->first();

        $jobId = $this->request->getQuery('job');
        $selectedJob = null;
        if ($jobId) {
            $selectedJob = $this->fetchTable('Advertisements')->find()
                ->where(['id' => (int)$jobId])->first();
        }

        if ($this->request->is('post') && $member) {
            $advertisementId = (int)$this->request->getData('advertisement_id');

            $already = $this->Applications->find()
                ->where(['members_id' => $member->id, 'advertisement_id' => $advertisementId])
                ->first();
            if ($already) {
                $this->Flash->error(__('You have already applied for this position.'));

                return $this->redirect(['action' => 'index']);
            }

            $resume = $this->request->getData('resume');
            if ($resume instanceof \Psr\Http\Message\UploadedFileInterface
                && $resume->getError() === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo((string)$resume->getClientFilename(), PATHINFO_EXTENSION));
                $allowed = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'];

                if (!in_array($ext, $allowed, true)) {
                    $this->Flash->error(__('Resume must be PDF, DOC, DOCX, PNG, or JPG.'));

                    return $this->redirect(['action' => 'index', '?' => ['job' => $advertisementId]]);
                }

                $maxSize = 5 * 1024 * 1024; // 5 MB
                if ((int)$resume->getSize() > $maxSize) {
                    $this->Flash->error(__('Resume file is too large (max 5 MB).'));

                    return $this->redirect(['action' => 'index', '?' => ['job' => $advertisementId]]);
                }

                $uploadDir = WWW_ROOT . 'uploads' . DS;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = time() . '_' . $resume->getClientFilename();
                $resume->moveTo($uploadDir . $filename);

                $member->resume = $filename;
                $member->resume_dir = 'uploads/';
                $membersTable->save($member, ['validate' => false, 'checkRules' => false]);
            }

            if (empty($member->resume)) {
                $this->Flash->error(__('Please upload a resume before applying.'));

                return $this->redirect(['action' => 'index', '?' => ['job' => $advertisementId]]);
            }

            $application = $this->Applications->newEmptyEntity();
            $application = $this->Applications->patchEntity($application, [
                'members_id' => $member->id,
                'advertisement_id' => $advertisementId,
                'status' => 0,
            ]);

            if ($this->Applications->save($application)) {
                $this->Flash->success(__('Your application has been submitted.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not submit your application. Please try again.'));
        }

        $myApplications = [];
        if ($member) {
            $myApplications = $this->Applications->find()
                ->where(['Applications.members_id' => $member->id])
                ->contain(['Advertisements'])
                ->orderBy(['Applications.created' => 'DESC'])
                ->all();
        }

        $interviews = [];
        if ($member && $myApplications) {
            $appIds = [];
            foreach ($myApplications as $a) {
                $appIds[] = $a->id;
            }
            if (!empty($appIds)) {
                foreach ($this->fetchTable('Interviews')->find()->where(['Interviews.application_id IN' => $appIds])->all() as $iv) {
                    $interviews[$iv->application_id] = $iv;
                }
            }
        }

        $this->set(compact('member', 'selectedJob', 'myApplications', 'interviews'));
    }

    public function view($id = null)
    {
        $application = $this->Applications->get($id, contain: ['Members', 'Advertisements']);
        $this->set(compact('application'));
    }

    public function letter($id = null)
    {
        $this->viewBuilder()->setLayout(null);
        $application = $this->Applications->get($id, contain: ['Members', 'Advertisements']);

        if (empty($application->offer_letter)) {
            $this->Flash->error(__('No offer letter available.'));

            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('application'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($id);
        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}