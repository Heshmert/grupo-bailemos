<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lessons Model
 *
 * @property \App\Model\Table\SchedulesTable&\Cake\ORM\Association\BelongsTo $Schedules
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\ContentsTable&\Cake\ORM\Association\BelongsTo $Contents
 * @property \App\Model\Table\AcademicProgressTable&\Cake\ORM\Association\HasMany $AcademicProgress
 * @property \App\Model\Table\AssistancesTable&\Cake\ORM\Association\HasMany $Assistances
 *
 * @method \App\Model\Entity\Lesson newEmptyEntity()
 * @method \App\Model\Entity\Lesson newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Lesson> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lesson get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Lesson findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Lesson patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Lesson> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lesson|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Lesson saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonsTable extends Table
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

        $this->setTable('lessons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schedules', [
            'foreignKey' => 'schedule_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Contents', [
            'foreignKey' => 'content_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('AcademicProgress', [
            'foreignKey' => 'lesson_id',
        ]);
        $this->hasMany('Assistances', [
            'foreignKey' => 'lesson_id',
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
            ->integer('schedule_id')
            ->notEmptyString('schedule_id');

        $validator
            ->integer('program_id')
            ->notEmptyString('program_id');

        $validator
            ->integer('content_id')
            ->notEmptyString('content_id');

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
        $rules->add($rules->existsIn(['schedule_id'], 'Schedules'), ['errorField' => 'schedule_id']);
        $rules->add($rules->existsIn(['program_id'], 'Programs'), ['errorField' => 'program_id']);
        $rules->add($rules->existsIn(['content_id'], 'Contents'), ['errorField' => 'content_id']);

        return $rules;
    }
}
