<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;


/**
 * User Entity
 *
 * @property int $id
 * @property string $name1
 * @property string $name2
 * @property string $lastname1
 * @property string $lastname2
 * @property int $dni
 * @property \Cake\I18n\Date $birth
 * @property int $phone
 * @property string $email
 * @property bool $status
 * @property string $password
 * @property string $address
 * @property int $role
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Contract[] $contracts
 * @property \App\Model\Entity\Logbook[] $logbook
 */
class User extends Entity
{


    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
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
        'dni' => true,
        'birth' => true,
        'phone' => true,
        'email' => true,
        'status' => true,
        'password' => true,
        'address' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'contracts' => true,
        'logbook' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];
}
