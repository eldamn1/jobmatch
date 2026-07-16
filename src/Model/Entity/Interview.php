<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interview Entity
 *
 * @property int $id
 * @property int $application_id
 * @property \Cake\I18n\Date|null $interview_date
 * @property \Cake\I18n\Time|null $interview_time
 * @property string|null $mode
 * @property string|null $location
 * @property string|null $notes
 * @property int|null $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Application $application
 */
class Interview extends Entity
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
        'application_id' => true,
        'interview_date' => true,
        'interview_time' => true,
        'mode' => true,
        'location' => true,
        'notes' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'application' => true,
    ];
}
