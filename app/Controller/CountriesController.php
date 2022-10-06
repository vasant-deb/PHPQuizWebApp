<?php
App::uses('AppController', 'Controller');
/**
 * Country Controller
 *
 * @property Country $Country
 * @property PaginatorComponent $Paginator
 */
class CountriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	
	
	public function index() {
				
         $countries = $this->Country->find('all', array(          
            'order' => array( 
                'Country.id' => 'ASC'
           ),
            'conditions' => array( 
			   'Country.active' => '1'
            ),
        ));
        $this->set(compact('countries')); 
	}
    
    public function view($slug = null) {
 		
		  $country = $this->Country->find('first', array( 
                       'conditions' => array( 
                'Country.slug' => $slug
             ),
         )); 
       
        $this->set(compact('country'));
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		  $countries = $this->Country->find('all', array(          
            'order' => array( 
                'Country.id' => 'ASC'
           ),
            'conditions' => array( 
			//   'Country.active' => '1'
            ),
        ));
        $this->set(compact('countries')); 
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Country->exists($id)) {
			throw new NotFoundException(__('Invalid Country'));
		}
		$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
		$this->set('country', $this->Country->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		
		if ($this->request->is('post')) {
			
                  
			if(empty($this->data['Country']['slug']))
            {
			$this->request->data['Country']['slug'] = $this->generateSlug($this->request->data['Country']['name']);			
			}	
			
			$filename = "";
				if(!empty($this->data['Country']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Country']['image'], 'img-'.$this->request->data['Country']['slug'],'countries/');
				}
				
			$this->request->data['Country']['image'] = $filename;
				
			$this->Country->create();
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash(__('The Country has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Country could not be saved. Please, try again.'));
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
		if (!$this->Country->exists($id)) {
			throw new NotFoundException(__('Invalid Country'));
		}
		 	
		$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
		$category_details = $this->Country->find('first', $options);
	
		$filename = $category_details['Country']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			if(empty($this->data['Country']['slug']))
            {
			$this->request->data['Country']['slug'] = $this->generateSlug($this->request->data['Country']['name']);			
			}	
			
			if(!empty($this->data['Country']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Country']['image'], 'img-'.$this->request->data['Country']['slug'],'countries/');
				}
				
			$this->request->data['Country']['image'] = $filename;
												
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash(__('The Country has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Country could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
			$this->request->data = $this->Country->find('first', $options);
		}
	}
	
	
	
 public function admin_change_country_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'countries', 'action'=>'index'));
        }
        
        if(!$this->Country->save(array('id'=>$this->request->data['country_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Country status updated.'));
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
		$this->Country->id = $id;
		if (!$this->Country->exists()) {
			throw new NotFoundException(__('Invalid Country'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Country->delete()) {
			$this->Session->setFlash(__('The Country has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Country could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
