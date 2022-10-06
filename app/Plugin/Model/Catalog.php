<?php
App::uses('AppModel', 'Model');
class Catalog extends AppModel {
 
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

        $subdomainIds = Set::extract('/Catalog/id', $subdomains);

        $this->updateAll(
            array(
                'Catalog.views' => 'Catalog.views + 1',
            ),
            array('Catalog.id' => $subdomainIds)
        );

    }

}