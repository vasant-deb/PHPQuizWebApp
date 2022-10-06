<?php
App::uses('AppController', 'Controller');
/**
 * Socialicons Controller
 *
 * @property Socialicon $Socialicon
 * @property PaginatorComponent $Paginator
 */
class SocialiconsController extends AppController {

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

 
		$socialicons = $this->Socialicon->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Socialicon.id' => 'desc'
			),
			'conditions' => array(
			),
		));
				
		$this->set(compact('socialicons'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Socialicon->exists($id)) {
			throw new NotFoundException(__('Invalid socialicon'));
		}
		$options = array('conditions' => array('Socialicon.' . $this->Socialicon->primaryKey => $id));
		$this->set('socialicon', $this->Socialicon->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($company_id = null) {
  
		if ($this->request->is(array('post', 'put'))) {
			 
					 $filename = "";
					 
					$service_slug = $this->generateSlug($this->request->data['Socialicon']['name']);
					 
									
		if(!empty($this->data['Socialicon']['image']['name']))
                    {
					
					  $filename = $this->process_image($this->request->data['Socialicon']['image'], 'img-'.$service_slug,'socialicons/');
					}
					
						$this->request->data['Socialicon']['image'] = $filename;
 					  
					
			$this->Socialicon->create();
			if ($this->Socialicon->save($this->request->data)) {
				$this->Session->setFlash(__('The Socialicon has been saved.'));
				return $this->redirect(array('controller' => 'blogs', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Socialicon could not be saved. Please, try again.'));
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
		if (!$this->Socialicon->exists($id)) {
			throw new NotFoundException(__('Invalid Socialicon'));
		}
		
		$options = array('conditions' => array('Socialicon.' . $this->Socialicon->primaryKey => $id));
		$socialicon_details = $this->Socialicon->find('first', $options);
	
		$filename = $socialicon_details['Socialicon']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

					$service_slug = $this->generateSlug($this->request->data['Socialicon']['name']);
					 
			 
			 if(!empty($this->data['Socialicon']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Socialicon']['image'], 'img-'.$service_slug,'blogs/');  
					}
					
				
			$this->request->data['Socialicon']['image'] = $filename;
 					  
					
	 
						 
			if ($this->Socialicon->save($this->request->data)) {
				$this->Session->setFlash(__('The Socialicon has been saved.'));
				return $this->redirect(array('controller' => 'blogs', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Socialicon could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Socialicon.' . $this->Socialicon->primaryKey => $id));
			$this->request->data = $this->Socialicon->find('first', $options);
		}		
		 
		}

		
		
 public function admin_change_socialicon_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'socialicons', 'action'=>'index'));
        }
        
        if(!$this->Socialicon->save(array('id'=>$this->request->data['socialicon_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'status updated.'));
        die;
    }
	public function admin_change_socialicon_order()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'socialicons', 'action'=>'index'));
        }
        
        if(!$this->Socialicon->save(array('id'=>$this->request->data['socialicon_id'], 'socialicon_order'=>$this->request->data['socialicon_order'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update order at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Order updated.'));
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
		$this->Socialicon->id = $id;
		if (!$this->Socialicon->exists()) {
			throw new NotFoundException(__('Invalid Socialicon'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Socialicon->delete()) {
			$this->Session->setFlash(__('The Socialicon has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Socialicon could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
