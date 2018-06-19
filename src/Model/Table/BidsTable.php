<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BidsTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('bids');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Products',[
				'foreignKey'=>'product_id'
		]);
		$this->belongsTo('Users',[
				'foreignKey'=>'user_id'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmpty('id','create');
		
		$validator
			->requirePresence('price','create')
			->notEmpty('price');
		
		$validator
			->requirePresence('user_id','create')
			->notEmpty('user_id');
		
		return $validator;
	}
}