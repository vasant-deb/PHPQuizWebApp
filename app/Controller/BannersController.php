<?php
App::uses('AppController', 'Controller');
/**
 * Banners Controller
 *
 * @property Banner $Banner
 * @property PaginatorComponent $Paginator
 */
class BannersController extends AppController {

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
		
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '0');
		/*$this->Banner->recursive = 0;
		$this->set('banners', $this->Paginator->paginate());*/
		
	//$this->Banner->query('ALTER TABLE `banners` ADD `showon_catalog` TINYINT(4) NULL AFTER `showon_home`;');
 
		$banners = $this->Banner->find('all', array(
		 	'recursive' => 0,
		//	'limit' => 50, 
			'order' => array(
				'Banner.id' => 'desc'
			),
			'conditions' => array(
			),
		));
		
		
		$this->set(compact('banners'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
		$this->set('banner', $this->Banner->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($company_id = null) {
  
		if ($this->request->is(array('post', 'put'))) {
			 
					 $filename = "";
					 
					$service_slug = $this->Banner->generateSlug($this->request->data['Banner']['name']);
					 
									
		if(!empty($this->data['Banner']['image']['name']))
                    {
					
					  $filename = $this->process_image($this->request->data['Banner']['image'], 'img-'.$service_slug,'banners/');
					}
					
						$this->request->data['Banner']['image'] = $filename;
 					  
					 

					
			$this->Banner->create();
			if ($this->Banner->save($this->request->data)) {
				$this->Session->setFlash(__('The banner has been saved.'));
				return $this->redirect(array('controller' => 'banners', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
			}
		}	

$categories = $this->Banner->Category->find('list', array(
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
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		
		$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
		$banner_details = $this->Banner->find('first', $options);
	
		$filename = $banner_details['Banner']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

					$service_slug = $this->generateSlug($this->request->data['Banner']['name']);
					 
			 
			 if(!empty($this->data['Banner']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Banner']['image'], 'img-'.$service_slug,'banners/');  
					}
					
				
			$this->request->data['Banner']['image'] = $filename;
 					  
					
	 
						 
			if ($this->Banner->save($this->request->data)) {
				$this->Session->setFlash(__('The banner has been saved.'));
				return $this->redirect(array('controller' => 'banners', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
			$this->request->data = $this->Banner->find('first', $options);
		}		
		 	 
		$categories = $this->Banner->Category->find('list', array(
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
		$this->Banner->id = $id;
		if (!$this->Banner->exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Banner->delete()) {
			$this->Session->setFlash(__('The banner has been deleted.'));
		} else {
			$this->Session->setFlash(__('The banner could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

 public function admin_change_banner_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'banners', 'action'=>'index'));
        }
        
        if(!$this->Banner->save(array('id'=>$this->request->data['banner_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Banner status updated.'));
        die;
    }
}
