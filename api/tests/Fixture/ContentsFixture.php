<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContentsFixture
 */
class ContentsFixture extends TestFixture
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
                'tema' => 'Lorem ipsum dolor sit amet',
                'preference' => 1,
                'created' => '2026-01-12 21:28:24',
                'modified' => '2026-01-12 21:28:24',
            ],
        ];
        parent::init();
    }
}
