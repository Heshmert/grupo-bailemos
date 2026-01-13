<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Program Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $contract_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Contract $contract
 * @property \App\Model\Entity\Content[] $contents
 * @property \App\Model\Entity\Lesson[] $lessons
 * @property \App\Model\Entity\Logbook[] $logbook
 * @property \App\Model\Entity\Registration[] $registrations
 * @property \App\Model\Entity\Schedule[] $schedules
 */
class Program extends Entity
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
        'name' => true,
        'description' => true,
        'contract_id' => true,
        'created' => true,
        'modified' => true,
        'contract' => true,
        'contents' => true,
        'lessons' => true,
        'logbook' => true,
        'registrations' => true,
        'schedules' => true,
    ];
}
