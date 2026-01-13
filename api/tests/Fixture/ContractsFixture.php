<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContractsFixture
 */
class ContractsFixture extends TestFixture
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
                'user_id' => 1,
                'start' => '2026-01-12',
                'end' => '2026-01-12',
                'position_id' => 1,
                'created' => '2026-01-12 21:28:25',
                'modified' => '2026-01-12 21:28:25',
            ],
        ];
        parent::init();
    }
}
