<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class SitepagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
    public $name = 'Sitepages';

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
 
  public function index() {
        	//$this->layout = "brilltech";
		 	
    }
    
	public function admin_index() { 
		
		$pages = $this->Sitepage->find('all', array(
			'recursive' => 0,
			'order' => array(				
			),
			'conditions' => array(			
			),
		));		  			 
		$this->set(compact('pages'));		
	}
 	  
	public function about() {
	
	$page = $this->Sitepage->find('first', array(
	'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'about-us'
			),
		));
		  			 
		$this->set(compact('page'));
	}
	
	public function clients() {
	
	}
		
	public function contact() {
			$page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'contact-us'
			),
		));		 

		//  $this->viewVars['meta_title'];
	
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
	}
	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
	}
		 
	$this->set(compact('meta_title','meta_keyword','meta_desc'));
			 
	$this->set(compact('page'));
	
	}
	
	
	public function admin_view($id = null) {
		if (!$this->Sitepage->exists($id)) {
			throw new NotFoundException('Invalid page');
		}
		$page = $this->Sitepage->find('first', array(			
			'conditions' => array(
				'Sitepage.id' => $id
			)
		));
		$this->set(compact('page'));
	}

////////////////////////////////////////////

	public function admin_add() {		
		
		if ($this->request->is('post')) {
			
			if(empty($this->data['Sitepage']['slug']))
            {
			$this->request->data['Sitepage']['slug'] = $this->generateSlug($this->request->data['Sitepage']['name']);			
			}	
			
			$filename = "";
			
				if(!empty($this->data['Sitepage']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Sitepage']['image'], $this->request->data['Sitepage']['slug'],'sitepages/');
					}
					$this->request->data['Sitepage']['image'] = $filename;

			$this->Sitepage->create();
			if ($this->Sitepage->save($this->request->data)) {
				$this->Session->setFlash('The page has been saved');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The page could not be saved. Please, try again.');
			}
		}
	
	}

////////////////////////////////////////////

	public function admin_edit($id = null) {
		if (!$this->Sitepage->exists($id)) {
			throw new NotFoundException('Invalid page');
		}
		
		$options = array('conditions' => array('Sitepage.' . $this->Sitepage->primaryKey => $id));
		$page_details = $this->Sitepage->find('first', $options);
	
		$filename = $page_details['Sitepage']['image'];
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(empty($this->data['Sitepage']['slug']))
            {
			$this->request->data['Sitepage']['slug'] = $this->generateSlug($this->request->data['Sitepage']['name']);			
			}	
		
			if(!empty($this->data['Sitepage']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Sitepage']['image'], $this->request->data['Sitepage']['slug'],'sitepages/');
					}
					
					$this->request->data['Sitepage']['image'] = $filename;
						
			if ($this->Sitepage->save($this->request->data)) {
				$this->Session->setFlash('The page has been saved');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The page could not be saved. Please, try again.');
			}
		} else {
			$this->request->data = $this->Sitepage->find('first', array('conditions' => array('Sitepage.id' => $id)));
		}

	}

////////////////////////////////////////////


 public function admin_change_page_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'categories', 'action'=>'index'));
        }
        
        if(!$this->Sitepage->save(array('id'=>$this->request->data['page_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Sitepage status updated.'));
        die;
    }
	public function admin_change_page_order()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'categories', 'action'=>'index'));
        }
        
        if(!$this->Sitepage->save(array('id'=>$this->request->data['page_id'], 'page_order'=>$this->request->data['page_order'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update page order at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Sitepage Order updated.'));
        die;
    }
	
	
	public function admin_delete($id = null) {
		$this->Sitepage->id = $id;
		if (!$this->Sitepage->exists()) {
			throw new NotFoundException('Invalid page');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sitepage->delete()) {
			$this->Session->setFlash('Sitepage deleted');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Sitepage was not deleted');
		return $this->redirect(array('action' => 'index'));
	}

}
