<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Advertisement Entity
 *
 * @property int $id
 * @property int $members_id
 * @property string $location
 * @property string $job_type
 * @property string $title
 * @property string $description
 * @property string $category
 * @property string $salary
 * @property string $requirements
 * @property \Cake\I18n\Date $deadlines
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Application[] $applications
 */
class Advertisement extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'members_id' => true,
        'location' => true,
        'job_type' => true,
        'title' => true,
        'description' => true,
        'category' => true,
        'salary' => true,
        'requirements' => true,
        'deadlines' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'member' => true,
        'applications' => true,
    ];
}
