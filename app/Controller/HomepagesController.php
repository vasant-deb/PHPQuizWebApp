<?php
App::uses('AppController', 'Controller');
/**
 * Homepages Controller
 *
 * @property Homepage $Homepage
 * @property PaginatorComponent $Paginator
 */
class HomepagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
 
 	public function admin_index() {
 
 
		$homepages = $this->Homepage->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Homepage.id' => 'asc'
			),
			'conditions' => array(
			),
		));
				
		$this->set(compact('homepages'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Homepage->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio'));
		}
		$options = array('conditions' => array('Homepage.' . $this->Homepage->primaryKey => $id));
		$this->set('portfolio', $this->Homepage->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($company_id = null) {
  
		if ($this->request->is(array('post', 'put'))) {
			 
					 $filename = "";
					 
					$service_slug = $this->generateSlug($this->request->data['Homepage']['name']);
					 
									
		if(!empty($this->data['Homepage']['image']['name']))
                    {
					
					  $filename = $this->process_image($this->request->data['Homepage']['image'], 'img-'.$service_slug,'homepages/');
					}
					
						$this->request->data['Homepage']['image'] = $filename;
 					  
					 

					
			$this->Homepage->create();
			if ($this->Homepage->save($this->request->data)) {
				$this->Session->setFlash(__('Item has been saved.'));
				return $this->redirect(array('controller' => 'homepages', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Item could not be saved. Please, try again.'));
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
		if (!$this->Homepage->exists($id)) {
			throw new NotFoundException(__('Invalid Homepage'));
		}
		
		$options = array('conditions' => array('Homepage.' . $this->Homepage->primaryKey => $id));
		$portfolio_details = $this->Homepage->find('first', $options);
	
		$filename = $portfolio_details['Homepage']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

					$service_slug = $this->generateSlug($this->request->data['Homepage']['name']);
					 
			 
			 if(!empty($this->data['Homepage']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Homepage']['image'], 'img-'.$service_slug,'homepages/');  
					}
					
				
			$this->request->data['Homepage']['image'] = $filename;
 					  
					
	 
						 
			if ($this->Homepage->save($this->request->data)) {
				$this->Session->setFlash(__('The Homepage has been saved.'));
				return $this->redirect(array('controller' => 'homepages', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Homepage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Homepage.' . $this->Homepage->primaryKey => $id));
			$this->request->data = $this->Homepage->find('first', $options);
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
		$this->Homepage->id = $id;
		if (!$this->Homepage->exists()) {
			throw new NotFoundException(__('Invalid Homepage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Homepage->delete()) {
			$this->Session->setFlash(__('The Homepage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Homepage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
