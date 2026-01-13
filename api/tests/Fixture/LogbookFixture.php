<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LogbookFixture
 */
class LogbookFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'logbook';
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
                'user_id' => 1,
                'date' => '2026-01-12',
                'created' => '2026-01-12 21:28:26',
                'modified' => '2026-01-12 21:28:26',
            ],
        ];
        parent::init();
    }
}
