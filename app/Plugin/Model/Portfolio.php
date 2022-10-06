<?php
App::uses('AppModel', 'Model');
class Portfolio extends AppModel {
 
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
 
    public function updateViews($portfolios) {

        if(!isset($portfolios[0])) {
            $a = $portfolios;
            unset($portfolios);
            $portfolios[0] = $a;
        }


        $blogIds = Set::extract('/Portfolio/id', $portfolios);

        $this->updateAll(
            array(
                'Portfolio.views' => 'Portfolio.views + 1',
            ),
            array('Portfolio.id' => $blogIds)
        );

    }

}