<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssistancesFixture
 */
class AssistancesFixture extends TestFixture
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
                'lesson_id' => 1,
                'student_id' => 1,
                'date' => '2026-01-12',
                'status' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-01-12 21:28:24',
                'modified' => '2026-01-12 21:28:24',
            ],
        ];
        parent::init();
    }
}
