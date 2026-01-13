<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Representatives Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\HasMany $Students
 *
 * @method \App\Model\Entity\Representative newEmptyEntity()
 * @method \App\Model\Entity\Representative newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Representative> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Representative get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Representative findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Representative patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Representative> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Representative|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Representative saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Representative>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Representative>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Representative>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Representative> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Representative>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Representative>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Representative>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Representative> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RepresentativesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('representatives');
        $this->setDisplayField('name1');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Students', [
            'foreignKey' => 'representative_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name1')
            ->maxLength('name1', 255)
            ->requirePresence('name1', 'create')
            ->notEmptyString('name1');

        $validator
            ->scalar('name2')
            ->maxLength('name2', 255)
            ->requirePresence('name2', 'create')
            ->notEmptyString('name2');

        $validator
            ->scalar('lastname1')
            ->maxLength('lastname1', 255)
            ->requirePresence('lastname1', 'create')
            ->notEmptyString('lastname1');

        $validator
            ->scalar('lastname2')
            ->maxLength('lastname2', 255)
            ->requirePresence('lastname2', 'create')
            ->notEmptyString('lastname2');

        $validator
            ->date('birth')
            ->requirePresence('birth', 'create')
            ->notEmptyDate('birth');

        $validator
            ->requirePresence('dni', 'create')
            ->notEmptyString('dni');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        return $validator;
    }
}
