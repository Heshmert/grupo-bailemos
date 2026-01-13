<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contracts Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PositionsTable&\Cake\ORM\Association\BelongsTo $Positions
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\HasMany $Programs
 *
 * @method \App\Model\Entity\Contract newEmptyEntity()
 * @method \App\Model\Entity\Contract newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Contract> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contract get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Contract findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Contract patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Contract> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contract|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Contract saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContractsTable extends Table
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

        $this->setTable('contracts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Programs', [
            'foreignKey' => 'contract_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->date('start')
            ->requirePresence('start', 'create')
            ->notEmptyDate('start');

        $validator
            ->date('end')
            ->requirePresence('end', 'create')
            ->notEmptyDate('end');

        $validator
            ->integer('position_id')
            ->notEmptyString('position_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['position_id'], 'Positions'), ['errorField' => 'position_id']);

        return $rules;
    }
}
