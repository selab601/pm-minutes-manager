<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Minutes
 * @property \Cake\ORM\Association\BelongsTo $ItemMetaCategories
 * @property \Cake\ORM\Association\BelongsTo $ItemCategories
 * @property \Cake\ORM\Association\HasMany $Responsibilities
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null)
 */
class ItemsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('items');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Minutes', [
            'foreignKey' => 'minute_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemMetaCategories', [
            'foreignKey' => 'item_meta_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemCategories', [
            'foreignKey' => 'item_category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Responsibilities', [
            'foreignKey' => 'item_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('primary_char', 'create')
            ->notEmpty('primary_char');

        $validator
            ->integer('order_in_minute')
            ->requirePresence('order_in_minute', 'create')
            ->notEmpty('order_in_minute');

        $validator
            ->allowEmpty('contents');

        $validator
            ->integer('revision')
            ->allowEmpty('revision');

        $validator
            ->date('overed_at')
            ->allowEmpty('overed_at')
            ->add('overed_at', 'date', [
                'rule' => ['date', "ymd"],
                'message' => '日付の形式が不正です'
            ]);

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

        $validator
            ->boolean('is_followed')
            ->allowEmpty('is_followed');

        $validator
            ->integer('followed_by')
            ->allowEmpty('followed_by');

        $validator
            ->allowEmpty('followed_user_name');

        $validator
            ->dateTime('followed_at')
            ->allowEmpty('followed_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['minute_id'], 'Minutes'));
        $rules->add($rules->existsIn(['item_meta_category_id'], 'ItemMetaCategories'));
        $rules->add($rules->existsIn(['item_category_id'], 'ItemCategories'));

        return $rules;
    }
}
