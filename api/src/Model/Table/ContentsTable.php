<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contents Model
 *
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\AcademicProgressTable&\Cake\ORM\Association\HasMany $AcademicProgress
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\HasMany $Lessons
 *
 * @method \App\Model\Entity\Content newEmptyEntity()
 * @method \App\Model\Entity\Content newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Content> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Content get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Content findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Content patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Content> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Content|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Content saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Content>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Content>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Content>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Content> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Content>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Content>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Content>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Content> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContentsTable extends Table
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

        $this->setTable('contents');
        $this->setDisplayField('tema');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('AcademicProgress', [
            'foreignKey' => 'content_id',
        ]);
        $this->hasMany('Lessons', [
            'foreignKey' => 'content_id',
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
            ->scalar('tema')
            ->maxLength('tema', 255)
            ->requirePresence('tema', 'create')
            ->notEmptyString('tema');

        $validator
            ->integer('preference')
            ->requirePresence('preference', 'create')
            ->notEmptyString('preference');

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

        return $rules;
    }
}
