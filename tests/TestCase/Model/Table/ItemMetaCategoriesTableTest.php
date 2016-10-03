<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemMetaCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemMetaCategoriesTable Test Case
 */
class ItemMetaCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemMetaCategoriesTable
     */
    public $ItemMetaCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_meta_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemMetaCategories') ? [] : ['className' => 'App\Model\Table\ItemMetaCategoriesTable'];
        $this->ItemMetaCategories = TableRegistry::get('ItemMetaCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemMetaCategories);

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
}
