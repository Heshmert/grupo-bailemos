<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AcademicProgressFixture
 */
class AcademicProgressFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'academic_progress';
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
                'student_id' => 1,
                'content_id' => 1,
                'lesson_id' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'observations' => 'Lorem ipsum dolor sit amet',
                'activity' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-01-12 21:28:23',
                'modified' => '2026-01-12 21:28:23',
            ],
        ];
        parent::init();
    }
}
