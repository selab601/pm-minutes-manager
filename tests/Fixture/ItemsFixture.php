<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFixture
 *
 */
class ItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'minute_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'primary_char' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'item_meta_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'item_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'order_in_minute' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'contents' => ['type' => 'string', 'length' => 300, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'revision' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'overed_at' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'updated_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'is_followed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'followed_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'followed_user_name' => ['type' => 'string', 'length' => 201, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'followed_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'minute_key' => ['type' => 'index', 'columns' => ['minute_id'], 'length' => []],
            'item_category_key' => ['type' => 'index', 'columns' => ['item_category_id'], 'length' => []],
            'item_meta_category_key' => ['type' => 'index', 'columns' => ['item_meta_category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'items_ibfk_1' => ['type' => 'foreign', 'columns' => ['minute_id'], 'references' => ['minutes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'items_ibfk_2' => ['type' => 'foreign', 'columns' => ['item_category_id'], 'references' => ['item_categories', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'items_ibfk_3' => ['type' => 'foreign', 'columns' => ['item_meta_category_id'], 'references' => ['item_meta_categories', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'minute_id' => 1,
            'primary_char' => 'Lorem ip',
            'item_meta_category_id' => 1,
            'item_category_id' => 1,
            'order_in_minute' => 1,
            'contents' => 'Lorem ipsum dolor sit amet',
            'revision' => 1,
            'overed_at' => '2016-10-03',
            'created_at' => '2016-10-03 19:40:16',
            'updated_at' => 1475491216,
            'is_followed' => 1,
            'followed_by' => 1,
            'followed_user_name' => 'Lorem ipsum dolor sit amet',
            'followed_at' => '2016-10-03 19:40:16'
        ],
    ];
}
