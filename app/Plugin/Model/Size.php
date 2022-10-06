<?php
App::uses('AppModel', 'Model');
/**
 * Size Model
 *
 */
class Size extends AppModel {

 public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Size Name is required',              
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Size Name is not Unique',              
            ),
        ),		 
    );
	 public $hasMany = array(
        
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'size_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
