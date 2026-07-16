<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * AuditLogs Controller
 *
 * @property \App\Model\Table\AuditLogsTable 
 */
class AuditLogsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout(null);
    }

    public function index()
    {
        $query = $this->AuditLogs->find();

        $search = $this->request->getQuery('search');
        $type = $this->request->getQuery('type');
        $status = $this->request->getQuery('status');

        if (!empty($search)) {
            $query->where([
                'OR' => [
                    'AuditLogs.transaction LIKE' => '%' . $search . '%',
                    'AuditLogs.source LIKE' => '%' . $search . '%',
                    'AuditLogs.slug LIKE' => '%' . $search . '%',
                ],
            ]);
        }

        if ($type !== null && $type !== '') {
            $query->where(['AuditLogs.type' => $type]);
        }

        if ($status !== null && $status !== '') {
            $query->where(['AuditLogs.status' => (int)$status]);
        }

        $query->orderBy(['AuditLogs.created' => 'DESC']);

        $this->paginate = ['limit' => 10];
        $auditLogs = $this->paginate($query);

        $this->set(compact('auditLogs'));
    }

    public function view($id = null)
    {
        $auditLog = $this->AuditLogs->get($id);
        $this->set(compact('auditLog'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $auditLog = $this->AuditLogs->get($id);
        if ($this->AuditLogs->delete($auditLog)) {
            $this->Flash->success(__('The audit log has been deleted.'));
        } else {
            $this->Flash->error(__('The audit log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}