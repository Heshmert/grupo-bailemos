<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Representative Entity
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
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Student[] $students
 */
class Representative extends Entity
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
        'created' => true,
        'modified' => true,
        'students' => true,
    ];
}
