<?php
App::uses('AppModel', 'Model');
class Subdomain extends AppModel {
 
    public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('lengthBetween', 3, 60),
                'message' => 'Name is required',
                'allowEmpty' => false,
                'required' => false,
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Name already exists',
                'allowEmpty' => false,
                'required' => false,
            ),
        ), 
    );

    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ),
		  
    );
 
    public function updateViews($subdomains) {

        if(!isset($subdomains[0])) {
            $a = $subdomains;
            unset($subdomains);
            $subdomains[0] = $a;
        }

        $this->unbindModel(
            array('belongsTo' => array('Category', 'Brand'))
        );

        $subdomainIds = Set::extract('/Subdomain/id', $subdomains);

        $this->updateAll(
            array(
                'Subdomain.views' => 'Subdomain.views + 1',
            ),
            array('Subdomain.id' => $subdomainIds)
        );

    }

}