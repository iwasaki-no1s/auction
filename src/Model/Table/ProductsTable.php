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
		
		$this->table('products');
		$this->displayField('product_name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Users',[
				'foreignKey'=>'user_id'
		]);
		$this->hasMany('Bids',[
				'foreginKey'=>'product_id'
		]);
		$this->hasMany('Favorites',[
				'foreginKey'=>'product_id'
		]);
		$this->belongsTo('Categories',[
				'foreginKey'=>'category_id'
		]);
		$this->hasMany('Images',[
				'foreginKey'=>'product_id'
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