<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductsTable extends Table
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
				'foreignKey'=>'product_id'
		]);
		$this->hasMany('Favorites',[
				'foreignKey'=>'product_id'
		]);
		$this->belongsTo('Categories',[
				'foreignKey'=>'category_id',
				'joinType'=>'INNER'
		]);
		$this->hasMany('Images',[
				'foreignKey'=>'product_id'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmpty('id','create');
		
		$validator
			->requirePresence('product_name','create')
			->notEmpty('product_name');
		
		$validator
			->integer('category_id')
			->notEmpty('category_id');
	
		return $validator;
	}
}