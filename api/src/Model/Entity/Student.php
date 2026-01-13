<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property string $name1
 * @property string $name2
 * @property string $lastname1
 * @property string $lastname2
 * @property \Cake\I18n\Date $birth
 * @property int $dni
 * @property int $phone
 * @property string $email
 * @property string $address
 * @property int $representative_parentesco
 * @property int $representative_id
 * @property int $mother_id
 * @property int $father_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Representative $representative
 * @property \App\Model\Entity\AcademicProgres[] $academic_progress
 * @property \App\Model\Entity\Assistance[] $assistances
 * @property \App\Model\Entity\Registration[] $registrations
 */
class Student extends Entity
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
        'name1' => true,
        'name2' => true,
        'lastname1' => true,
        'lastname2' => true,
        'birth' => true,
        'dni' => true,
        'phone' => true,
        'email' => true,
        'address' => true,
        'representative_parentesco' => true,
        'representative_id' => true,
        'mother_id' => true,
        'father_id' => true,
        'created' => true,
        'modified' => true,
        'representative' => true,
        'academic_progress' => true,
        'assistances' => true,
        'registrations' => true,
    ];
}
