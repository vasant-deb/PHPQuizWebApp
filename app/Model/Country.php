<?php
App::uses('AppModel', 'Model');
/**
 * News Model
 *
 */
class Country extends AppModel {

 public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Country Name is required',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Country Name is not Unique',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),		 
    );
}
