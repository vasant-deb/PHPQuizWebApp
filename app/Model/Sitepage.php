<?php
App::uses('AppModel', 'Model');
/**
 * Page Model
 *
 * @property PageType $PageType
 * @property Status $Status
 */
class Sitepage extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sitepages';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Page Name is required',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Page Name is not Unique',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
		
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	
	

}
