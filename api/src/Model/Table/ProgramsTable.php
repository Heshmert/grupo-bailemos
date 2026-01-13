<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programs Model
 *
 * @property \App\Model\Table\ContractsTable&\Cake\ORM\Association\BelongsTo $Contracts
 * @property \App\Model\Table\ContentsTable&\Cake\ORM\Association\HasMany $Contents
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\HasMany $Lessons
 * @property \App\Model\Table\LogbookTable&\Cake\ORM\Association\HasMany $Logbook
 * @property \App\Model\Table\RegistrationsTable&\Cake\ORM\Association\HasMany $Registrations
 * @property \App\Model\Table\SchedulesTable&\Cake\ORM\Association\HasMany $Schedules
 *
 * @method \App\Model\Entity\Program newEmptyEntity()
 * @method \App\Model\Entity\Program newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Program> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Program get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Program findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Program patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Program> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Program|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Program saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Program>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Program>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Program>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Program> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Program>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Program>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Program>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Program> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProgramsTable extends Table
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

        $this->setTable('programs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Contracts', [
            'foreignKey' => 'contract_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Contents', [
            'foreignKey' => 'program_id',
        ]);
        $this->hasMany('Lessons', [
            'foreignKey' => 'program_id',
        ]);
        $this->hasMany('Logbook', [
            'foreignKey' => 'program_id',
        ]);
        $this->hasMany('Registrations', [
            'foreignKey' => 'program_id',
        ]);
        $this->hasMany('Schedules', [
            'foreignKey' => 'program_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('contract_id')
            ->notEmptyString('contract_id');

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
        $rules->add($rules->existsIn(['contract_id'], 'Contracts'), ['errorField' => 'contract_id']);

        return $rules;
    }
}
