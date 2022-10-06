<?php
App::uses('AppModel', 'Model');
/**
 * Banner Model
 *
 * @property Company $Company
 */
class Creditenquiries extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	 
  public $validate = array(
        'business_name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Business Name is required',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Business Name is not Unique',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
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
