<?php
App::uses('AppController', 'Controller');
/**
 * Sizes Controller
 *
 * @property Size $Size
 * @property PaginatorComponent $Paginator
 */
class SizesController extends AppController {

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
		  $sizes = $this->Size->find('all', array(          
            'order' => array( 
                'Size.id' => 'ASC'
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
		if (!$this->Size->exists($id)) {
			throw new NotFoundException(__('Invalid Size'));
		}
		$options = array('conditions' => array('Size.' . $this->Size->primaryKey => $id));
		$this->set('country', $this->Size->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		
		if ($this->request->is('post')) {
			
                  
			if(empty($this->data['Size']['slug']))
            {
			$this->request->data['Size']['slug'] = $this->generateSlug($this->request->data['Size']['name']);			
			}	
			
			$filename = "";
				if(!empty($this->data['Size']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Size']['image'], 'img-'.$this->request->data['Size']['slug'],'sizes/');
				}
				
			$this->request->data['Size']['image'] = $filename;
				
			$this->Size->create();
			if ($this->Size->save($this->request->data)) {
				$this->Session->setFlash(__('The Size has been saved.'));
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
		if (!$this->Size->exists($id)) {
			throw new NotFoundException(__('Invalid Size'));
		}
		 	
		$options = array('conditions' => array('Size.' . $this->Size->primaryKey => $id));
		$category_details = $this->Size->find('first', $options);
	
		$filename = $category_details['Size']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			if(empty($this->data['Size']['slug']))
            {
			$this->request->data['Size']['slug'] = $this->generateSlug($this->request->data['Size']['name']);			
			}	
			
			if(!empty($this->data['Size']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Size']['image'], 'img-'.$this->request->data['Size']['slug'],'sizes/');
				}
				
			$this->request->data['Size']['image'] = $filename;
												
			if ($this->Size->save($this->request->data)) {
				$this->Session->setFlash(__('The Size has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Size could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Size.' . $this->Size->primaryKey => $id));
			$this->request->data = $this->Size->find('first', $options);
		}
	}
	
	
	
 public function admin_change_size_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'sizes', 'action'=>'index'));
        }
        
        if(!$this->Size->save(array('id'=>$this->request->data['size_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Size status updated.'));
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
		$this->Size->id = $id;
		if (!$this->Size->exists()) {
			throw new NotFoundException(__('Invalid Size'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Size->delete()) {
			$this->Session->setFlash(__('The Size has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Size could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
