<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriesTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('categories');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->hasMany('Products',[
				'foreignKey'=>'category_id'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmpty('id','create');
		
		$validator
			->requirePresence('name','create')
			->notEmpty('name');
		
		return $validator;
	}
}