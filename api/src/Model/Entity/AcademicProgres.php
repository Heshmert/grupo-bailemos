<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AcademicProgres Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $content_id
 * @property int $lesson_id
 * @property string $status
 * @property string $observations
 * @property string $activity
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Content $content
 * @property \App\Model\Entity\Lesson $lesson
 */
class AcademicProgres extends Entity
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
        'student_id' => true,
        'content_id' => true,
        'lesson_id' => true,
        'status' => true,
        'observations' => true,
        'activity' => true,
        'created' => true,
        'modified' => true,
        'student' => true,
        'content' => true,
        'lesson' => true,
    ];
}
