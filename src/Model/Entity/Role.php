<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Role extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
    ];
}
