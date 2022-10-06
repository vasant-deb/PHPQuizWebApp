<?php
App::uses('AppController', 'Controller');
/**
 * Sizes Controller
 *
 * @property Size $Size
 * @property PaginatorComponent $Paginator
 */
class MaterialsController extends AppController {

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
		  $sizes = $this->Material->find('all', array(          
            'order' => array( 
                'Material.id' => 'ASC'
           ),
            'conditions' => array( 
			//   'Size.active' => '1'
            ),
        ));
        $this->set(compact('sizes')); 
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid Material'));
		}
		$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
		$this->set('country', $this->Material->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		
		if ($this->request->is('post')) {
			
                  
			if(empty($this->data['Material']['slug']))
            {
			$this->request->data['Material']['slug'] = $this->generateSlug($this->request->data['Material']['name']);			
			}	
			
			$filename = "";
				if(!empty($this->data['Material']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Material']['image'], 'img-'.$this->request->data['Material']['slug'],'sizes/');
				}
				
			$this->request->data['Material']['image'] = $filename;
				
			$this->Material->create();
			if ($this->Material->save($this->request->data)) {
				$this->Session->setFlash(__('The Material has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Size could not be saved. Please, try again.'));
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
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid Material'));
		}
		 	
		$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
		$category_details = $this->Material->find('first', $options);
	
		$filename = $category_details['Material']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			if(empty($this->data['Material']['slug']))
            {
			$this->request->data['Material']['slug'] = $this->generateSlug($this->request->data['Material']['name']);			
			}	
			
			if(!empty($this->data['Material']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Material']['image'], 'img-'.$this->request->data['Material']['slug'],'sizes/');
				}
				
			$this->request->data['Material']['image'] = $filename;
												
			if ($this->Material->save($this->request->data)) {
				$this->Session->setFlash(__('The Material has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Material could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
			$this->request->data = $this->Material->find('first', $options);
		}
	}
	
	
	
 public function admin_change_size_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'materials', 'action'=>'index'));
        }
        
        if(!$this->Material->save(array('id'=>$this->request->data['material_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Material status updated.'));
        die;
    }
	

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Material->id = $id;
		if (!$this->Material->exists()) {
			throw new NotFoundException(__('Invalid Material'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Material->delete()) {
			$this->Session->setFlash(__('The Material has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Material could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
