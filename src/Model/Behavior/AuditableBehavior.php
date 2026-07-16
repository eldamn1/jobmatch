<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\Routing\Router;
use Cake\Utility\Text;

/**
 * Auditable Behavior
 *
 * Add to any table with:  $this->addBehavior('Auditable');
 * It records create / update / delete activity into the `audit_logs` table,
 * including WHO performed the action (from the logged-in session user).
 *
 * SAFE: all logging is wrapped in try/catch — a failure here never breaks
 * the main save or delete.
 */
class AuditableBehavior extends Behavior
{
    public function beforeSave(EventInterface $event, EntityInterface $entity, \ArrayObject $options): void
    {
        // remember if it was new BEFORE the save completes
        $entity->set('_wasNew', $entity->isNew());
    }

    public function afterSave(EventInterface $event, EntityInterface $entity, \ArrayObject $options): void
    {
        $type = $entity->get('_wasNew') ? 'create' : 'update';
        $this->writeLog($type, $entity);
    }

    public function afterDelete(EventInterface $event, EntityInterface $entity, \ArrayObject $options): void
    {
        $this->writeLog('delete', $entity);
    }

    private function writeLog(string $type, EntityInterface $entity): void
    {
        try {
            $table = $this->table();
            $source = $table->getTable();

            // Who performed this action (logged-in session user)
            $actorName = 'System';
            try {
                $request = Router::getRequest();
                if ($request) {
                    $actor = $request->getSession()->read('user');
                    if ($actor && !empty($actor->fullname)) {
                        $actorName = (string)$actor->fullname;
                    }
                }
            } catch (\Throwable $e) {
                // ignore — fall back to 'System'
            }

            $displayField = $table->getDisplayField();
            $recordLabel = '';
            if (is_string($displayField)) {
                $recordLabel = (string)($entity->get($displayField) ?? '');
            }

            $meta = json_encode([
                'username' => $actorName,
                'record' => $recordLabel,
            ]);

            $pk = $table->getPrimaryKey();
            $pkField = is_array($pk) ? ($pk[0] ?? 'id') : $pk;
            $primaryKey = (int)$entity->get($pkField);

            $table->getConnection()->execute(
                'INSERT INTO audit_logs
                 (transaction, type, primary_key, source, parent_source, original, changed, meta, status, slug, created)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())',
                [
                    Text::uuid(),
                    $type,
                    $primaryKey,
                    $source,
                    '',
                    '{}',
                    '{}',
                    $meta,
                    1,
                    $actorName,
                ]
            );
        } catch (\Throwable $e) {
            // Never break the main action.
        }
    }
}