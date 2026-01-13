<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logbook Entity
 *
 * @property int $id
 * @property int $program_id
 * @property int $user_id
 * @property \Cake\I18n\Date $date
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\User $user
 */
class Logbook extends Entity
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
        'program_id' => true,
        'user_id' => true,
        'date' => true,
        'created' => true,
        'modified' => true,
        'program' => true,
        'user' => true,
    ];
}
