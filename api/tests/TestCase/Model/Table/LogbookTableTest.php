<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogbookTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogbookTable Test Case
 */
class LogbookTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LogbookTable
     */
    protected $Logbook;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Logbook',
        'app.Programs',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Logbook') ? [] : ['className' => LogbookTable::class];
        $this->Logbook = $this->getTableLocator()->get('Logbook', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Logbook);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\LogbookTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\LogbookTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
