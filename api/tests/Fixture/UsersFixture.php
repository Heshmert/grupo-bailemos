<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name1' => 'Lorem ipsum dolor sit amet',
                'name2' => 'Lorem ipsum dolor sit amet',
                'lastname1' => 'Lorem ipsum dolor sit amet',
                'lastname2' => 'Lorem ipsum dolor sit amet',
                'dni' => 1,
                'birth' => '2026-01-12',
                'phone' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'password' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'role' => 1,
                'created' => '2026-01-12 21:28:29',
                'modified' => '2026-01-12 21:28:29',
            ],
        ];
        parent::init();
    }
}
