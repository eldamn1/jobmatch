<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuditLogs Model
 */
class AuditLogsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('audit_logs');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                ],
            ],
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('type')
            ->maxLength('type', 7)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->nonNegativeInteger('primary_key')
            ->allowEmptyString('primary_key');

        $validator
            ->scalar('source')
            ->maxLength('source', 255)
            ->requirePresence('source', 'create')
            ->notEmptyString('source');

        $validator->allowEmptyString('transaction');
        $validator->allowEmptyString('parent_source');
        $validator->allowEmptyString('original');
        $validator->allowEmptyString('changed');
        $validator->allowEmptyString('meta');
        $validator->allowEmptyString('slug');
        $validator->allowEmptyString('status');

        return $validator;
    }
}