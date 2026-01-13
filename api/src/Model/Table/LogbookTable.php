<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logbook Model
 *
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Logbook newEmptyEntity()
 * @method \App\Model\Entity\Logbook newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Logbook> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Logbook get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Logbook findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Logbook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Logbook> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Logbook|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Logbook saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Logbook>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Logbook>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Logbook>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Logbook> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Logbook>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Logbook>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Logbook>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Logbook> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LogbookTable extends Table
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

        $this->setTable('logbook');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->integer('program_id')
            ->notEmptyString('program_id');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

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
        $rules->add($rules->existsIn(['program_id'], 'Programs'), ['errorField' => 'program_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
