<?php
App::uses('AppModel', 'Model');
/**
 * Banner Model
 *
 * @property Company $Company
 */
class Banner extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	 
  public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Banner Name is required',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Banner Name is not Unique',
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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
public $hasMany = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'Category',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		 
	);
public function generateSlug($company_name){
	$pattern="[?()\/&#\,\;\.$+%]";
	$slug_name=preg_replace($pattern,"-",$company_name);
	$slug_name=strtolower($slug_name);
	$slug_name=str_replace("  ","-",$slug_name);
	$slug_name=str_replace(" ","-",$slug_name);
	$slug_name=str_replace("_","-",$slug_name);
	$slug_name=str_replace("%","",$slug_name);
	$slug_name=str_replace("__","-",$slug_name);
	$slug_name=str_replace("--","-",$slug_name);
	return strtolower($slug_name);
}

}
