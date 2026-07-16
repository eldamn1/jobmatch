<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdvertisementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdvertisementsTable Test Case
 */
class AdvertisementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AdvertisementsTable
     */
    protected $Advertisements;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Advertisements',
        'app.Members',
        'app.Applications',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Advertisements') ? [] : ['className' => AdvertisementsTable::class];
        $this->Advertisements = $this->getTableLocator()->get('Advertisements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Advertisements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\AdvertisementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\AdvertisementsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
