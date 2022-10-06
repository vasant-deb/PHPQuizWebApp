<?php
App::uses('AppModel', 'Model');
/**
* Location Model
*
*/
class Location extends AppModel {

 public $validate = array(
       'name' => array(
           'rule1' => array(
               'rule' => array('notBlank'),
               'message' => 'Location Name is required',
               //'allowEmpty' => false,
               //'required' => true,
               //'last' => false, // Stop validation after this rule
               //'on' => 'create', // Limit validation to 'create' or 'update' operations
           ),
           'rule2' => array(
               'rule' => array('isUnique'),
               'message' => 'Location Name is not Unique',
               //'allowEmpty' => false,
               //'required' => true,
               //'last' => false, // Stop validation after this rule
               //'on' => 'create', // Limit validation to 'create' or 'update' operations
           ),
       ),
/*
       'slug' => array(
           'rule1' => array(
               'rule' => array('lengthBetween', 3, 50),
               'message' => 'Slug is required',
               'allowEmpty' => false,
               'required' => false,
           ),
           'rule2' => array(
               'rule' => '/^[a-z\-]{3,50}$/',
               'message' => 'Only lowercase letters and dashes, between 3-50 characters',
               'allowEmpty' => false,
               'required' => false,
           ),
           'rule3' => array(
               'rule' => array('isUnique'),
               'message' => 'Slug already exists',
               'allowEmpty' => false,
               'required' => false,
           ),
       ),
*/
   );

public $belongsTo = array(
       'ParentLocation' => array(
           'className' => 'Location',
           'foreignKey' => 'parent_id',
           'conditions' => '',
           'fields' => '',
           'order' => ''
       )
   );

public $hasMany = array(
       'ChildLocation' => array(
           'className' => 'Location',
           'foreignKey' => 'parent_id',
           'dependent' => false
       ),       
   );
}
