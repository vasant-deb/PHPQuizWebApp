<?php
App::uses('AppController', 'Controller');
class FaqsController extends AppController {

////////////////////////////////////////////

	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
 public function index() {
	  
		
		  $this->loadModel('Faq');	

	     $faqs = $this->Faq->find('all', [   
			
            'conditions' => [
                'Faq.active' => 1,
				
            ],
            'order' => [
                'faq.id' => 'ASC'
            ],
			'limit' => 4
        ]);
		
     $this->set(compact('faqs')); 
	
    }
 
 	public function admin_index() {
		
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '0');
		/*$this->Banner->recursive = 0;
		$this->set('banners', $this->Paginator->paginate());*/
		
	//$this->Banner->query('ALTER TABLE `banners` ADD `showon_catalog` TINYINT(4) NULL AFTER `showon_home`;');
 
		$faqs = $this->Faq->find('all', array(
		 	'recursive' => 0,
		//	'limit' => 50, 
			'order' => array(
				'Faq.id' => 'desc'
			),
			'conditions' => array(
			),
		));
		
		
		$this->set(compact('faqs'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->faq->exists($id)) {
			throw new NotFoundException(__('Invalid video'));
		}
		$options = array('conditions' => array('Faq.' . $this->Video->primaryKey => $id));
		$this->set('faq', $this->Video->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	
	public function admin_add() {		
		
		if ($this->request->is('post')) {
			
			if(empty($this->data['Faq']['slug']))
            {
			$this->request->data['Faq']['slug'] = $this->generateSlug($this->request->data['Faq']['name']);			
			}	
			
			$filename = "";
			
				if(!empty($this->data['Faq']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Faq']['image'], $this->request->data['Faq']['slug'],'Faqs/');
					}
					$this->request->data['Faq']['image'] = $filename;

			$this->Faq->create();
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash('The page has been saved');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The page could not be saved. Please, try again.');
			}
		}
	
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Faq->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		
		$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
		$faq_details = $this->Faq->find('first', $options);
	
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

				
					 
			 
			 
						 
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash(__('The banner has been saved.'));
				return $this->redirect(array('controller' => 'Faqs', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
			$this->request->data = $this->Faq->find('first', $options);
		}		
		 	 
		
	}
		
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Faq->delete()) {
			$this->Session->setFlash(__('The banner has been deleted.'));
		} else {
			$this->Session->setFlash(__('The banner could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
