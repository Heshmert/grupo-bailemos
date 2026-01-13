<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistrationsFixture
 */
class RegistrationsFixture extends TestFixture
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
                'program_id' => 1,
                'student_id' => 1,
                'status' => 1,
                'created' => '2026-01-12 21:28:27',
                'modified' => '2026-01-12 21:28:27',
            ],
        ];
        parent::init();
    }
}
