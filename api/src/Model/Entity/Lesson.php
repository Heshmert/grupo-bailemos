<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lesson Entity
 *
 * @property int $id
 * @property int $schedule_id
 * @property int $program_id
 * @property int $content_id
 * @property \Cake\I18n\Date $date
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Schedule $schedule
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Content $content
 * @property \App\Model\Entity\AcademicProgres[] $academic_progress
 * @property \App\Model\Entity\Assistance[] $assistances
 */
class Lesson extends Entity
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
        'schedule_id' => true,
        'program_id' => true,
        'content_id' => true,
        'date' => true,
        'created' => true,
        'modified' => true,
        'schedule' => true,
        'program' => true,
        'content' => true,
        'academic_progress' => true,
        'assistances' => true,
    ];
}
