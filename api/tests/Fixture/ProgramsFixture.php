<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProgramsFixture
 */
class ProgramsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'contract_id' => 1,
                'created' => '2026-01-12 21:28:27',
                'modified' => '2026-01-12 21:28:27',
            ],
        ];
        parent::init();
    }
}
