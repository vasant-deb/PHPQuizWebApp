<?php
App::uses('AppModel', 'Model');
/**
 * Color Model
 *
 */
class Color extends AppModel {

 public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Color Name is required',              
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Color Name is not Unique',              
            ),
        ),		 
    );

   public $hasMany = array(
        
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'color_id',
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