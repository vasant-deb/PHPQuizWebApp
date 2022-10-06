<?php
App::uses('AppController', 'Controller');
/**
 * Portfolios Controller
 *
 * @property Portfolio $Portfolio
 * @property PaginatorComponent $Paginator
 */
class PortfoliosController extends AppController {

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

 
		$portfolios = $this->Portfolio->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Portfolio.id' => 'desc'
			),
			'conditions' => array(
			),
		));
				
		$this->set(compact('portfolios'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Portfolio->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio'));
		}
		$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
		$this->set('portfolio', $this->Portfolio->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($company_id = null) {
  
		if ($this->request->is(array('post', 'put'))) {
			 
					 $filename = "";
					 
					$service_slug = $this->generateSlug($this->request->data['Portfolio']['name']);
					 
									
		if(!empty($this->data['Portfolio']['image']['name']))
                    {
					
					  $filename = $this->process_image($this->request->data['Portfolio']['image'], 'img-'.$service_slug,'portfolios/');
					}
					
						$this->request->data['Portfolio']['image'] = $filename;
 					  
					 

					
			$this->Portfolio->create();
			if ($this->Portfolio->save($this->request->data)) {
				$this->Session->setFlash(__('The Portfolio has been saved.'));
				return $this->redirect(array('controller' => 'portfolios', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Portfolio could not be saved. Please, try again.'));
			}
		}	

$categories = $this->Portfolio->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		$this->set(compact('categories'));		
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Portfolio->exists($id)) {
			throw new NotFoundException(__('Invalid Portfolio'));
		}
		
		$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
		$portfolio_details = $this->Portfolio->find('first', $options);
	
		$filename = $portfolio_details['Portfolio']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

					$service_slug = $this->generateSlug($this->request->data['Portfolio']['name']);
					 
			 
			 if(!empty($this->data['Portfolio']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Portfolio']['image'], 'img-'.$service_slug,'portfolios/');  
					}
					
				
			$this->request->data['Portfolio']['image'] = $filename;
 					  
					
	 
						 
			if ($this->Portfolio->save($this->request->data)) {
				$this->Session->setFlash(__('The Portfolio has been saved.'));
				return $this->redirect(array('controller' => 'portfolios', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Portfolio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
			$this->request->data = $this->Portfolio->find('first', $options);
		}		
		 	 
		$categories = $this->Portfolio->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		$this->set(compact('categories'));
		}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Portfolio->id = $id;
		if (!$this->Portfolio->exists()) {
			throw new NotFoundException(__('Invalid Portfolio'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Portfolio->delete()) {
			$this->Session->setFlash(__('The Portfolio has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Portfolio could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
