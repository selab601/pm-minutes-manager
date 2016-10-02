<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Projects
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Projects', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'project_id',
            'joinTable' => 'projects_users'
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
            ->requirePresence('id_string', 'create')
            ->notEmpty('id_string')
            ->add('id_string', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => '既に登録されているIDです'
            ]);

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', 5],
                    'last' => true,
                    'message' => '5文字以上で入力してください'
                ]
            ]);

        $validator
            ->allowEmpty('mail')
            ->add('mail', 'validFormat', [
                'rule' => 'email',
                'message' => 'メールアドレスの形式が不正です'
            ]);

        $validator
            ->boolean('is_authorized')
            ->allowEmpty('is_authorized');

        $validator
            ->boolean('is_deleted')
            ->allowEmpty('is_deleted');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

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
        $rules->add($rules->isUnique(['id_string']));

        return $rules;
    }
}
