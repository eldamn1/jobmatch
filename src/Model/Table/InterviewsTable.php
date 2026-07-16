<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Interviews Model
 */
class InterviewsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('interviews');
        $this->setDisplayField('location');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Auditable');

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('application_id')
            ->requirePresence('application_id', 'create')
            ->notEmptyString('application_id');

        $validator->allowEmptyDate('interview_date');
        $validator->allowEmptyTime('interview_time');
        $validator->allowEmptyString('location');
        $validator->allowEmptyString('status');
        $validator->allowEmptyString('notes');

        return $validator;
    }
}