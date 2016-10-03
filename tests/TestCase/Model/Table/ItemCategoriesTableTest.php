<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemCategoriesTable Test Case
 */
class ItemCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemCategoriesTable
     */
    public $ItemCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_categories',
        'app.item_meta_categories',
        'app.items',
        'app.minutes',
        'app.projects',
        'app.users',
        'app.projects_users',
        'app.roles',
        'app.participations',
        'app.responsibilities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemCategories') ? [] : ['className' => 'App\Model\Table\ItemCategoriesTable'];
        $this->ItemCategories = TableRegistry::get('ItemCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemCategories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
