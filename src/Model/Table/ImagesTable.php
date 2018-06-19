<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ImagesTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('images');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Products',[
				'foreignKey'=>'product_id'
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