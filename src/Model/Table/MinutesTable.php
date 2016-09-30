<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Minutes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\HasMany $Items
 * @property \Cake\ORM\Association\HasMany $Participations
 *
 * @method \App\Model\Entity\Minute get($primaryKey, $options = [])
 * @method \App\Model\Entity\Minute newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Minute[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Minute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Minute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Minute[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Minute findOrCreate($search, callable $callback = null)
 */
class MinutesTable extends Table
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

        $this->table('minutes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'minute_id'
        ]);
        $this->hasMany('Participations', [
            'foreignKey' => 'minute_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('holded_place');

        $validator
            ->dateTime('holded_at')
            ->allowEmpty('holded_at');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

        $validator
            ->integer('revision')
            ->allowEmpty('revision');

        $validator
            ->boolean('is_examined')
            ->allowEmpty('is_examined');

        $validator
            ->boolean('is_approved')
            ->allowEmpty('is_approved');

        $validator
            ->dateTime('examined_at')
            ->allowEmpty('examined_at');

        $validator
            ->dateTime('approved_at')
            ->allowEmpty('approved_at');

        $validator
            ->integer('examined_by')
            ->allowEmpty('examined_by');

        $validator
            ->integer('approved_by')
            ->allowEmpty('approved_by');

        $validator
            ->allowEmpty('examined_user_name');

        $validator
            ->allowEmpty('approved_user_name');

        $validator
            ->boolean('is_deletable')
            ->allowEmpty('is_deletable');

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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));

        return $rules;
    }
}
