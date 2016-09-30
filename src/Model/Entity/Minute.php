<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Minute Entity
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $holded_place
 * @property \Cake\I18n\Time $holded_at
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 * @property int $revision
 * @property bool $is_examined
 * @property bool $is_approved
 * @property \Cake\I18n\Time $examined_at
 * @property \Cake\I18n\Time $approved_at
 * @property bool $is_deletable
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Item[] $items
 * @property \App\Model\Entity\Participation[] $participations
 */
class Minute extends Entity
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
