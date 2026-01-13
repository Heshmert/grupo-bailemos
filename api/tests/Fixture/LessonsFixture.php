<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LessonsFixture
 */
class LessonsFixture extends TestFixture
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
                'schedule_id' => 1,
                'program_id' => 1,
                'content_id' => 1,
                'date' => '2026-01-12',
                'created' => '2026-01-12 21:28:25',
                'modified' => '2026-01-12 21:28:25',
            ],
        ];
        parent::init();
    }
}
