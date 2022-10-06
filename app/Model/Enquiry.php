<?php
App::uses('AppModel', 'Model');
/**
 * Enquiry Model
 *
 */
class Enquiry extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 
 public function Emailsent($array = null) {
	 
	 return true;
 }
 
	public $validate = array(
		'enquiry_for' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
