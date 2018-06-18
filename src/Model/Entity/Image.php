<?php
namespace App\Model\Entity;

use cake\ORM\Entity;
use cake\Auth\DefaultPasswordHasher;
use cake\Auth\Cake\Auth;

class Image extends Entity
{
	protected $_accessible=[
			'*'=>true,
			'id'=>false
	];
}