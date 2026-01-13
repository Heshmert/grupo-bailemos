<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssistancesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssistancesTable Test Case
 */
class AssistancesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssistancesTable
     */
    protected $Assistances;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Assistances',
        'app.Lessons',
        'app.Students',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Assistances') ? [] : ['className' => AssistancesTable::class];
        $this->Assistances = $this->getTableLocator()->get('Assistances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Assistances);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\AssistancesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\AssistancesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
