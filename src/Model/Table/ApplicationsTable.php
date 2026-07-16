<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applications Model
 *
 * @property \App\Model\Table\MembersTable&\Cake\ORM\Association\BelongsTo 
 * @property \App\Model\Table\AdvertisementsTable&\Cake\ORM\Association\BelongsTo 
 */
class ApplicationsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('applications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Auditable');

        $this->belongsTo('Members', [
            'foreignKey' => 'members_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Advertisements', [
            'foreignKey' => 'advertisement_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('members_id')
            ->notEmptyString('members_id');

        $validator
            ->integer('advertisement_id')
            ->notEmptyString('advertisement_id');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['members_id'], 'Members'), ['errorField' => 'members_id']);
        $rules->add($rules->existsIn(['advertisement_id'], 'Advertisements'), ['errorField' => 'advertisement_id']);

        return $rules;
    }
}