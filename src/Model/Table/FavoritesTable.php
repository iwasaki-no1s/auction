<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FavoritesTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('favorites');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Products',[
				'foreignKey'=>'product_id'
		]);
		$this->belongsTo('Users',[
			'foreignKey'=>'user_id',	
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmpty('id','create');
		
		return $validator;
	}
}