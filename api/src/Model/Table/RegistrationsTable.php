<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Registrations Model
 *
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\Registration newEmptyEntity()
 * @method \App\Model\Entity\Registration newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Registration> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Registration get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Registration findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Registration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Registration> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Registration|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Registration saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Registration>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Registration>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Registration>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Registration> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Registration>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Registration>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Registration>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Registration> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegistrationsTable extends Table
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

        $this->setTable('registrations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
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
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'), ['errorField' => 'student_id']);

        return $rules;
    }
}
