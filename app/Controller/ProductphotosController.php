<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Productgallerie $Productgallerie
 * @property PaginatorComponent $Paginator
 */
class ProductphotosController extends AppController {

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
		$galleries = $this->Productphoto->find('all', array(
		 	'recursive' => 0,
		//	'limit' => 50, 
			'order' => array(
				'Productphoto.id' => 'desc'
			),
			'conditions' => array(
			'Productphoto.product_id' => $product_id
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
		if (!$this->Productphoto->exists($id)) {
			throw new NotFoundException(__('Invalid Productphoto'));
		}
		$options = array('conditions' => array('Productphoto.' . $this->Productphoto->primaryKey => $id));
		$this->set('Productphoto', $this->Productphoto->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($product_id = null) {
		if ($this->request->is('post')) {
			
			
			$filename = "";

			$service_slug = $this->generateSlug($this->request->data['Productphoto']['name']);


			if(!empty($this->data['Productphoto']['image']['name']))
			{

			$filename = $this->process_image($this->request->data['Productphoto']['image'], 'img-'.$product_id.$service_slug,'productphotos/');
			}

			$this->request->data['Productphoto']['image'] = $filename;

					
					
			$this->Productphoto->create();
			if ($this->Productphoto->save($this->request->data)) {
				$this->Session->setFlash(__('The Productphoto has been saved.'));
				return $this->redirect(array('controller' => 'productphotos', 'action' => 'index',  $this->data['Productphoto']['product_id']));
			} else {
				$this->Session->setFlash(__('The Productphoto could not be saved. Please, try again.'));
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
		if (!$this->Productphoto->exists($id)) {
			throw new NotFoundException(__('Invalid Productphoto'));
		}
		
		$options = array('conditions' => array('Productphoto.' . $this->Productphoto->primaryKey => $id));
		$banner_details = $this->Productphoto->find('first', $options);
	
		$filename = $banner_details['Productphoto']['image'];
		$product_id = $banner_details['Productphoto']['product_id'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			
			$service_slug = $this->generateSlug($this->request->data['Productphoto']['name']);
					 
			 
			 if(!empty($this->data['Productphoto']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Productphoto']['image'], 'img-'.$product_id.$service_slug,'productphotos/');  
					}
					
				
			$this->request->data['Productphoto']['image'] = $filename;
 					  
					
						
			if ($this->Productphoto->save($this->request->data)) {
				$this->Session->setFlash(__('The Productphoto has been saved.'));
				return $this->redirect(array('controller' => 'productphotos', 'action' => 'index',  $banner_details['Productphoto']['product_id']));
			} else {
				$this->Session->setFlash(__('The Productgallerie could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Productphoto.' . $this->Productphoto->primaryKey => $id));
			$this->request->data = $this->Productphoto->find('first', $options);
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
		$this->Productphoto->id = $id;
		if (!$this->Productphoto->exists()) {
			throw new NotFoundException(__('Invalid Productgallerie'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Productphoto->delete()) {
			$this->Session->setFlash(__('The Productgallerie has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Productgallerie could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
