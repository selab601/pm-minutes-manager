<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $minute_id
 * @property string $primary_char
 * @property int $item_meta_category_id
 * @property int $item_category_id
 * @property int $order_in_minute
 * @property string $contents
 * @property int $revision
 * @property \Cake\I18n\Time $overed_at
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 * @property bool $is_followed
 * @property int $followed_by
 * @property string $followed_user_name
 * @property \Cake\I18n\Time $followed_at
 *
 * @property \App\Model\Entity\Minute $minute
 * @property \App\Model\Entity\ItemCategory $item_category
 * @property \App\Model\Entity\Responsibility[] $responsibilities
 */
class Item extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
