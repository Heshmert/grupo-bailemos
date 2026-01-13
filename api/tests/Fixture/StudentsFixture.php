<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentsFixture
 */
class StudentsFixture extends TestFixture
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
                'birth' => '2026-01-12',
                'dni' => 1,
                'phone' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'representative_parentesco' => 1,
                'representative_id' => 1,
                'mother_id' => 1,
                'father_id' => 1,
                'created' => '2026-01-12 21:28:29',
                'modified' => '2026-01-12 21:28:29',
            ],
        ];
        parent::init();
    }
}
