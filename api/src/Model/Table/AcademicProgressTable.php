<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AcademicProgress Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\ContentsTable&\Cake\ORM\Association\BelongsTo $Contents
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\BelongsTo $Lessons
 *
 * @method \App\Model\Entity\AcademicProgres newEmptyEntity()
 * @method \App\Model\Entity\AcademicProgres newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AcademicProgres> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AcademicProgres get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AcademicProgres findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AcademicProgres patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AcademicProgres> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AcademicProgres|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AcademicProgres saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AcademicProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AcademicProgres>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AcademicProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AcademicProgres> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AcademicProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AcademicProgres>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AcademicProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AcademicProgres> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AcademicProgressTable extends Table
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

        $this->setTable('academic_progress');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Contents', [
            'foreignKey' => 'content_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Lessons', [
            'foreignKey' => 'lesson_id',
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
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->integer('content_id')
            ->notEmptyString('content_id');

        $validator
            ->integer('lesson_id')
            ->notEmptyString('lesson_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->scalar('observations')
            ->maxLength('observations', 255)
            ->requirePresence('observations', 'create')
            ->notEmptyString('observations');

        $validator
            ->scalar('activity')
            ->maxLength('activity', 255)
            ->requirePresence('activity', 'create')
            ->notEmptyString('activity');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'), ['errorField' => 'student_id']);
        $rules->add($rules->existsIn(['content_id'], 'Contents'), ['errorField' => 'content_id']);
        $rules->add($rules->existsIn(['lesson_id'], 'Lessons'), ['errorField' => 'lesson_id']);

        return $rules;
    }
}
