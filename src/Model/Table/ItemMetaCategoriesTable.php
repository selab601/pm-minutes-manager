<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemMetaCategories Model
 *
 * @method \App\Model\Entity\ItemMetaCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemMetaCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemMetaCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemMetaCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemMetaCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemMetaCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemMetaCategory findOrCreate($search, callable $callback = null)
 */
class ItemMetaCategoriesTable extends Table
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

        $this->table('item_meta_categories');
        $this->displayField('name');
        $this->primaryKey('id');
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
