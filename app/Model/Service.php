<?php
App::uses('AppModel', 'Model');
/**
 * Service Model
 *
 * @property Company $Company
 */
class Service extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
		
	public function generateSlug($service_name){
	$pattern="[?()\/&#\,\;\.$+%]";
	$slug_name=preg_replace($pattern,"-",$service_name);
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
