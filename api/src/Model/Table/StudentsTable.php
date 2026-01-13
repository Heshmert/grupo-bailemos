<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \App\Model\Table\RepresentativesTable&\Cake\ORM\Association\BelongsTo $Representatives
 * @property \App\Model\Table\AcademicProgressTable&\Cake\ORM\Association\HasMany $AcademicProgress
 * @property \App\Model\Table\AssistancesTable&\Cake\ORM\Association\HasMany $Assistances
 * @property \App\Model\Table\RegistrationsTable&\Cake\ORM\Association\HasMany $Registrations
 *
 * @method \App\Model\Entity\Student newEmptyEntity()
 * @method \App\Model\Entity\Student newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Student> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Student findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Student> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Student saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('name1');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Representatives', [
            'foreignKey' => 'representative_id',
            'joinType' => 'INNER',
        ]);
                // En src/Model/Table/StudentsTable.php dentro de initialize()
        $this->belongsTo('Mothers', [
            'className' => 'Representatives',
            'foreignKey' => 'mother_id',
        ]);
        $this->belongsTo('Fathers', [
            'className' => 'Representatives',
            'foreignKey' => 'father_id',
        ]);
        $this->hasMany('AcademicProgress', [
            'foreignKey' => 'student_id',
        ]);
        $this->hasMany('Assistances', [
            'foreignKey' => 'student_id',
        ]);
        $this->hasMany('Registrations', [
            'foreignKey' => 'student_id',
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

        $validator
            ->integer('representative_parentesco')
            ->requirePresence('representative_parentesco', 'create')
            ->notEmptyString('representative_parentesco');

        $validator
            ->integer('representative_id')
            ->notEmptyString('representative_id');

        $validator
            ->integer('mother_id')
            ->requirePresence('mother_id', 'create')
            ->notEmptyString('mother_id');

        $validator
            ->integer('father_id')
            ->requirePresence('father_id', 'create')
            ->notEmptyString('father_id');

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
        $rules->add($rules->existsIn(['representative_id'], 'Representatives'), ['errorField' => 'representative_id']);

        return $rules;
    }
}
