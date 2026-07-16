<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Interviews Controller
 * @property \App\Model\Table\InterviewsTable 
 */
class InterviewsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
    }

    public function index()
    {
        $interviews = $this->Interviews->find()
            ->contain(['Applications' => ['Members', 'Advertisements']])
            ->orderBy(['Interviews.interview_date' => 'DESC', 'Interviews.interview_time' => 'ASC'])
            ->all();

        $this->set(compact('interviews'));
    }

    public function schedule($applicationId = null)
    {
        $this->request->allowMethod(['post']);

        $application = $this->fetchTable('Applications')->get($applicationId, contain: ['Members', 'Advertisements']);

        $interview = $this->Interviews->find()
            ->where(['Interviews.application_id' => (int)$applicationId])
            ->first();

        if (!$interview) {
            $interview = $this->Interviews->newEmptyEntity();
            $interview->application_id = (int)$applicationId;
        }

        $data = $this->request->getData();
        $dateStr = $data['interview_date'] ?? '';
        $timeStr = $data['interview_time'] ?? '';
        $location = (string)($data['location'] ?? '');

        $interview->interview_date = $dateStr !== '' ? $dateStr : null;
        $interview->interview_time = $timeStr !== '' ? $timeStr : null;
        $interview->location = $location;
        $interview->status = 0; 
        $interview->letter = $this->buildInvitation($application, $dateStr, $timeStr, $location);

        if ($this->Interviews->save($interview, ['validate' => false, 'checkRules' => false])) {
            $this->Flash->success(__('Applicant invited to interview. Invitation letter generated.'));
        } else {
            $this->Flash->error(__('Could not save the interview.'));
        }

        return $this->redirect($this->referer());
    }

    public function reject($applicationId = null)
    {
        $this->request->allowMethod(['post']);

        $applicationsTable = $this->fetchTable('Applications');
        $application = $applicationsTable->get($applicationId, contain: ['Members', 'Advertisements']);

        $interview = $this->Interviews->find()
            ->where(['Interviews.application_id' => (int)$applicationId])
            ->first();

        if (!$interview) {
            $interview = $this->Interviews->newEmptyEntity();
            $interview->application_id = (int)$applicationId;
        }

        $interview->status = 2; 
        $interview->letter = $this->buildRejection($application);

        $this->Interviews->save($interview, ['validate' => false, 'checkRules' => false]);

        $application->status = 2;
        $applicationsTable->save($application, ['validate' => false, 'checkRules' => false]);

        $this->Flash->success(__('Applicant marked as not qualified. Rejection letter generated.'));

        return $this->redirect($this->referer());
    }

    public function result($id = null, $status = null)
    {
        $this->request->allowMethod(['post']);

        $interview = $this->Interviews->get($id, contain: ['Applications' => ['Members', 'Advertisements']]);
        $status = (int)$status;
        $interview->status = $status;

        if ($status === 3) {
            $interview->letter = $this->buildFailedInterview($interview->application);
        }

        $this->Interviews->save($interview, ['validate' => false, 'checkRules' => false]);

        $application = $interview->application;
        if ($status === 3) {
            $application->status = 2; 
            $this->fetchTable('Applications')->save($application, ['validate' => false, 'checkRules' => false]);
        }

        $this->Flash->success(__('Interview result updated.'));

        return $this->redirect($this->referer());
    }

    public function letter($id = null)
    {
        $this->viewBuilder()->setLayout(null);

        $interview = $this->Interviews->get($id, contain: ['Applications' => ['Members', 'Advertisements']]);

        if (empty($interview->letter)) {
            $this->Flash->error(__('No letter available.'));

            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('interview'));
    }

    private function buildInvitation($application, string $dateStr, string $timeStr, string $location): string
    {
        $name = $application->member->name ?? 'Applicant';
        $position = $application->advertisement->title ?? 'the position';
        $today = date('j F Y');
        $dateFmt = $dateStr !== '' ? date('j F Y', strtotime($dateStr)) : '(to be confirmed)';
        $timeFmt = $timeStr !== '' ? date('g:i A', strtotime($timeStr)) : '(to be confirmed)';
        $venue = $location !== '' ? $location : '(to be confirmed)';
        $POS = strtoupper($position);

        return "To      : {$name}\n"
            . "From    : Human Resource Department, JobMatch\n"
            . "Date    : {$today}\n"
            . "Subject : Invitation to Interview — {$POS}\n\n"
            . "Dear {$name},\n\n"
            . "Thank you for your application for the position of {$position} at JobMatch. We are "
            . "pleased to inform you that, following a review of your application, you have been "
            . "shortlisted for an interview.\n\n"
            . "We would like to invite you to attend an interview session with the details below:\n\n"
            . "   1. Position   : {$position}\n"
            . "   2. Date       : {$dateFmt}\n"
            . "   3. Time       : {$timeFmt}\n"
            . "   4. Venue      : {$venue}\n\n"
            . "Kindly confirm your attendance by replying to this letter. Please bring along a copy of "
            . "your resume and any relevant certificates. Should you be unable to attend at the "
            . "scheduled time, please contact our Human Resource Department to arrange an alternative "
            . "date.\n\n"
            . "We look forward to meeting you.\n\n"
            . "Yours sincerely,\n\n\n"
            . "_______________________\n"
            . "Human Resource Department\n"
            . "JobMatch\n"
            . "Connect · Match · Succeed";
    }

    private function buildRejection($application): string
    {
        $name = $application->member->name ?? 'Applicant';
        $position = $application->advertisement->title ?? 'the position';
        $today = date('j F Y');
        $POS = strtoupper($position);

        return "To      : {$name}\n"
            . "From    : Human Resource Department, JobMatch\n"
            . "Date    : {$today}\n"
            . "Subject : Application Outcome — {$POS}\n\n"
            . "Dear {$name},\n\n"
            . "Thank you for your interest in the position of {$position} at JobMatch and for taking "
            . "the time to submit your application.\n\n"
            . "After careful review of all applications received, we regret to inform you that you "
            . "have not been shortlisted to proceed to the interview stage for this position on this "
            . "occasion.\n\n"
            . "We appreciate the effort you put into your application and encourage you to apply for "
            . "future opportunities that match your skills and experience. We wish you every success "
            . "in your job search.\n\n"
            . "Yours sincerely,\n\n\n"
            . "_______________________\n"
            . "Human Resource Department\n"
            . "JobMatch\n"
            . "Connect · Match · Succeed";
    }

    private function buildFailedInterview($application): string
    {
        $name = $application->member->name ?? 'Applicant';
        $position = $application->advertisement->title ?? 'the position';
        $today = date('j F Y');
        $POS = strtoupper($position);

        return "To      : {$name}\n"
            . "From    : Human Resource Department, JobMatch\n"
            . "Date    : {$today}\n"
            . "Subject : Interview Result — {$POS}\n\n"
            . "Dear {$name},\n\n"
            . "Thank you for taking the time to attend the interview for the position of {$position} "
            . "at JobMatch. We appreciate the opportunity to have met with you.\n\n"
            . "After careful consideration following your interview, we regret to inform you that you "
            . "have not been selected for this position on this occasion. This was a difficult "
            . "decision, as we met with a number of strong candidates.\n\n"
            . "We were genuinely impressed by your background, and we encourage you to apply for "
            . "future opportunities with us. We wish you every success in your future endeavours.\n\n"
            . "Yours sincerely,\n\n\n"
            . "_______________________\n"
            . "Human Resource Department\n"
            . "JobMatch\n"
            . "Connect · Match · Succeed";
    }
}