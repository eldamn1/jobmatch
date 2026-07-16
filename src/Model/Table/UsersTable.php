<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('fullname');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Auditable');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
        ]);

        $this->hasOne('Members', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 255)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->minLength('password', 6, 'Password mesti sekurang-kurangnya 6 aksara.')
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', null, 'update');

        $validator->allowEmptyString('avatar');
        $validator->allowEmptyString('avatar_dir');
        $validator->allowEmptyString('token');
        $validator->allowEmptyDateTime('token_created_at');
        $validator->allowEmptyString('status');
        $validator->allowEmptyString('is_email_verified');
        $validator->allowEmptyString('slug');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}