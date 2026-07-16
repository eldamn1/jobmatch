<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Advertisements Model
 *
 * @property \App\Model\Table\MembersTable&\Cake\ORM\Association\BelongsTo 
 * @property \App\Model\Table\ApplicationsTable&\Cake\ORM\Association\HasMany 
 */
class AdvertisementsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('advertisements');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Auditable');

        $this->belongsTo('Members', [
            'foreignKey' => 'members_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'advertisement_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('members_id')
            ->notEmptyString('members_id');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        $validator
            ->scalar('job_type')
            ->maxLength('job_type', 100)
            ->requirePresence('job_type', 'create')
            ->notEmptyString('job_type');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('category')
            ->maxLength('category', 100)
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        $validator
            ->decimal('salary')
            ->requirePresence('salary', 'create')
            ->notEmptyString('salary');

        $validator
            ->scalar('requirements')
            ->requirePresence('requirements', 'create')
            ->notEmptyString('requirements');

        $validator
            ->date('deadlines')
            ->requirePresence('deadlines', 'create')
            ->notEmptyDate('deadlines');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['members_id'], 'Members'), ['errorField' => 'members_id']);

        return $rules;
    }
}