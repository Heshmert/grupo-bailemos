<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcademicProgressTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcademicProgressTable Test Case
 */
class AcademicProgressTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcademicProgressTable
     */
    protected $AcademicProgress;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.AcademicProgress',
        'app.Students',
        'app.Contents',
        'app.Lessons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AcademicProgress') ? [] : ['className' => AcademicProgressTable::class];
        $this->AcademicProgress = $this->getTableLocator()->get('AcademicProgress', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AcademicProgress);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\AcademicProgressTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\AcademicProgressTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
