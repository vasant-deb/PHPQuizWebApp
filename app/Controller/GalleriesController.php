<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 * @property PaginatorComponent $Paginator
 */
class GalleriesController extends AppController {

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
	public function admin_index($product_id=null) {	 	
		$galleries = $this->Gallery->find('all', array(
		 	'recursive' => 0,
		//	'limit' => 50, 
			'order' => array(
				'Gallery.id' => 'desc'
			),
			'conditions' => array(
			'Gallery.product_id' => $product_id
			),
		));
		
		
		$this->set(compact('galleries','product_id'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$this->set('gallery', $this->Gallery->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($product_id = null) {
		if ($this->request->is('post')) {
			
			
			$filename = "";

			$service_slug = $this->generateSlug($this->request->data['Gallery']['name']);


			if(!empty($this->data['Gallery']['image']['name']))
			{

			$filename = $this->process_image($this->request->data['Gallery']['image'], 'img-'.$product_id.$service_slug,'galleries/');
			}

			$this->request->data['Gallery']['image'] = $filename;

					
					
			$this->Gallery->create();
			if ($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash(__('The gallery has been saved.'));
				return $this->redirect(array('controller' => 'galleries', 'action' => 'index',  $this->data['Gallery']['product_id']));
			} else {
				$this->Session->setFlash(__('The gallery could not be saved. Please, try again.'));
			}
		}
 		$this->set(compact('product_id'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		
		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$banner_details = $this->Gallery->find('first', $options);
	
		$filename = $banner_details['Gallery']['image'];
		$product_id = $banner_details['Gallery']['product_id'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			
			$service_slug = $this->generateSlug($this->request->data['Gallery']['name']);
					 
			 
			 if(!empty($this->data['Gallery']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Gallery']['image'], 'img-'.$product_id.$service_slug,'galleries/');  
					}
					
				
			$this->request->data['Gallery']['image'] = $filename;
 					  
					
						
			if ($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash(__('The gallery has been saved.'));
				return $this->redirect(array('controller' => 'galleries', 'action' => 'index',  $banner_details['Gallery']['product_id']));
			} else {
				$this->Session->setFlash(__('The gallery could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
			$this->request->data = $this->Gallery->find('first', $options);
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
		$this->Gallery->id = $id;
		if (!$this->Gallery->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Gallery->delete()) {
			$this->Session->setFlash(__('The gallery has been deleted.'));
		} else {
			$this->Session->setFlash(__('The gallery could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
