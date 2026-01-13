<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assistances Model
 *
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\BelongsTo $Lessons
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\Assistance newEmptyEntity()
 * @method \App\Model\Entity\Assistance newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Assistance> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Assistance get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Assistance findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Assistance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Assistance> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Assistance|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Assistance saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Assistance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assistance>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Assistance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assistance> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Assistance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assistance>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Assistance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assistance> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssistancesTable extends Table
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

        $this->setTable('assistances');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Lessons', [
            'foreignKey' => 'lesson_id',
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
            ->integer('lesson_id')
            ->notEmptyString('lesson_id');

        $validator
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
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
        $rules->add($rules->existsIn(['lesson_id'], 'Lessons'), ['errorField' => 'lesson_id']);
        $rules->add($rules->existsIn(['student_id'], 'Students'), ['errorField' => 'student_id']);

        return $rules;
    }
}
