<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $user_group_id
 * @property string $fullname
 * @property string $password
 * @property string $email
 * @property string|null $avatar
 * @property string|null $avatar_dir
 * @property string|null $token
 * @property \Cake\I18n\DateTime|null $token_created_at
 * @property string|null $status
 * @property int|null $is_email_verified
 * @property \Cake\I18n\DateTime|null $last_login
 * @property string|null $ip_address
 * @property string|null $slug
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @property \App\Model\Entity\Member $member
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_group_id' => true,
        'fullname' => true,
        'password' => true,
        'email' => true,
        'avatar' => true,
        'avatar_dir' => true,
        'token' => true,
        'token_created_at' => true,
        'status' => true,
        'is_email_verified' => true,
        'last_login' => true,
        'ip_address' => true,
        'slug' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'member' => true,
    ];
}