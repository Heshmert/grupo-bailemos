<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SchedulesFixture
 */
class SchedulesFixture extends TestFixture
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
                'day' => 'Lorem ipsum dolor sit amet',
                'start' => '21:28:28',
                'end' => '21:28:28',
                'location' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-01-12 21:28:28',
                'modified' => '2026-01-12 21:28:28',
            ],
        ];
        parent::init();
    }
}
