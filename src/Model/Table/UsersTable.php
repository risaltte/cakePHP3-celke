<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Upload');
        $this->addBehavior('UploadRedimencionamento');
        $this->addBehavior('DeleteFile');
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
            ->scalar('name')
            ->maxLength('name', 255, 'O campo nome deve ter no máximo 255 caracteres.')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->notEmpty('email');

        $validator
            ->scalar('username')
            ->maxLength('username', 255, 'O campo Username deve ter no máximo 255 caracteres.')
            ->notEmpty('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255, 'O campo Password deve ter no máximo 255 caracteres.')
            ->notEmpty('password')
            ->minLength('password', 6, 'O password deve ter no mínimo 6 caracteres.');

        $validator
            ->dateTime('date')
            ->allowEmpty('date', 'create');

        $validator
            ->notEmpty('imagem', 'Selecione uma foto')
            ->add('imagem', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png']],
                'message' => 'Arquivo inválido. Selecione uma imagem no formato JPEG ou PNG.'
            ]);

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
        $rules->add($rules->isUnique(['email'], 'Este e-mail já está cadastrado.'));
        $rules->add($rules->isUnique(['username'], 'Este username já está em uso.'));

        return $rules;
    }

    public function getUserData(int $userId)
    {
        $query = $this->find()
            ->select(['id', 'name', 'email', 'imagem'])
            ->where([
                'Users.id' => $userId
            ])
        ;

        return $query->first();
    }
}
