<?php
App::uses('AppController', 'Controller');
/**
 * Color Controller
 *
 * @property Banner $Banner
 * @property PaginatorComponent $Paginator
 */
class ColorsController extends AppController {

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
		  $colors = $this->Color->find('all', array(          
            'order' => array( 
                'Color.id' => 'ASC'
           ),
            'conditions' => array( 
			//   'Color.active' => '1'
            ),
        ));
        $this->set(compact('colors')); 
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Color->exists($id)) {
			throw new NotFoundException(__('Invalid Color'));
		}
		$options = array('conditions' => array('Color.' . $this->Color->primaryKey => $id));
		$this->set('country', $this->Color->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		
		if ($this->request->is('post')) {
			
                  
			if(empty($this->data['Color']['slug']))
            {
			$this->request->data['Color']['slug'] = $this->generateSlug($this->request->data['Color']['name']);			
			}	
			
			$filename = "";
				if(!empty($this->data['Color']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Color']['image'], 'img-'.$this->request->data['Color']['slug'],'colors/');
				}
				
			$this->request->data['Color']['image'] = $filename;
				
			$this->Color->create();
			if ($this->Color->save($this->request->data)) {
				$this->Session->setFlash(__('The Color has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Color could not be saved. Please, try again.'));
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
		if (!$this->Color->exists($id)) {
			throw new NotFoundException(__('Invalid Color'));
		}
		 	
		$options = array('conditions' => array('Color.' . $this->Color->primaryKey => $id));
		$category_details = $this->Color->find('first', $options);
	
		$filename = $category_details['Color']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			if(empty($this->data['Color']['slug']))
            {
			$this->request->data['Color']['slug'] = $this->generateSlug($this->request->data['Color']['name']);			
			}	
			
			if(!empty($this->data['Color']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Color']['image'], 'img-'.$this->request->data['Color']['slug'],'colors/');
				}
				
			$this->request->data['Color']['image'] = $filename;
												
			if ($this->Color->save($this->request->data)) {
				$this->Session->setFlash(__('The Color has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Color could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Color.' . $this->Color->primaryKey => $id));
			$this->request->data = $this->Color->find('first', $options);
		}
	}
	
	
	
 public function admin_change_color_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'colors', 'action'=>'index'));
        }
        
        if(!$this->Color->save(array('id'=>$this->request->data['color_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Color status updated.'));
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
		$this->Color->id = $id;
		if (!$this->Color->exists()) {
			throw new NotFoundException(__('Invalid Color'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Color->delete()) {
			$this->Session->setFlash(__('The Color has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Color could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
