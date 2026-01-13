<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Content Entity
 *
 * @property int $id
 * @property int $program_id
 * @property string $tema
 * @property int $preference
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\AcademicProgres[] $academic_progress
 * @property \App\Model\Entity\Lesson[] $lessons
 */
class Content extends Entity
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
        'tema' => true,
        'preference' => true,
        'created' => true,
        'modified' => true,
        'program' => true,
        'academic_progress' => true,
        'lessons' => true,
    ];
}
