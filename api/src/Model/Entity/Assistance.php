<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assistance Entity
 *
 * @property int $id
 * @property int $lesson_id
 * @property int $student_id
 * @property \Cake\I18n\Date $date
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Lesson $lesson
 * @property \App\Model\Entity\Student $student
 */
class Assistance extends Entity
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
        'lesson_id' => true,
        'student_id' => true,
        'date' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'lesson' => true,
        'student' => true,
    ];
}
