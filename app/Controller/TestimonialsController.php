<?php
App::uses('AppController', 'Controller');
/**
 * Testimonial Controller
 *
 * @property Testimonial $Testimonial
 * @property PaginatorComponent $Paginator
 */
class TestimonialsController  extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

		 
	
		public function practitioners() {
				
         $testimonials = $this->Testimonial->find('all', array(          
            'order' => array( 
                'Testimonial.id' => 'ASC'
           ),
            'conditions' => array( 
			   'Testimonial.active' => '1',
			    'Testimonial.testimonial_type' => '1'
            ),
        ));
        $this->set(compact('testimonials')); 
        
       
	}

	public function patients() {
				
         $testimonials = $this->Testimonial->find('all', array(          
            'order' => array( 
                'Testimonial.id' => 'ASC'
           ),
            'conditions' => array( 
			   'Testimonial.active' => '1',
			   'Testimonial.testimonial_type' => '2'
            ),
        ));
        $this->set(compact('testimonials')); 
        
         
	}

 
	public function index() {
				
         $testimonials = $this->Testimonial->find('all', array(          
            'order' => array( 
                'Testimonial.id' => 'ASC'
           ),
            'conditions' => array( 
			   'Testimonial.active' => '1'
            ),
        ));
        $this->set(compact('testimonials')); 
	}
    
    public function view($slug = null) {
 		
		  $testimonial = $this->Testimonial->find('first', array( 
                       'conditions' => array( 
                'Testimonial.slug' => $slug
             ),
         )); 
       
        $this->set(compact('testimonial'));
	}
	
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Testimonial->recursive = 0;
		$this->set('testimonials', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Testimonial->exists($id)) {
			throw new NotFoundException(__('Invalid Testimonial'));
		}
		$options = array('conditions' => array('Testimonial.' . $this->Testimonial->primaryKey => $id));
		$this->set('video', $this->Testimonial->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		
		if ($this->request->is('post')) {
			
                  
			if(empty($this->data['Testimonial']['slug']))
            {
			$this->request->data['Testimonial']['slug'] = $this->generateSlug($this->request->data['Testimonial']['name']);			
			}	
			
			$filename = "";
			
				if(!empty($this->data['Testimonial']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Testimonial']['image'], 'img-'.time(),'testimonials/');
					}
					
					 
					else {
						$this->request->data['Testimonial']['image']  = null;
					}
					$this->request->data['Testimonial']['image'] = $filename;
					
			$this->Testimonial->create();
			if ($this->Testimonial->save($this->request->data)) {
				$this->Session->setFlash(__('The Testimonial has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Testimonial could not be saved. Please, try again.'));
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
		if (!$this->Testimonial->exists($id)) {
			throw new NotFoundException(__('Invalid Testimonial'));
		}
		
		$options = array('conditions' => array('Testimonial.' . $this->Testimonial->primaryKey => $id));
		$banner_details = $this->Testimonial->find('first', $options);
	
		$filename = $banner_details['Testimonial']['image'];
	
	
		if ($this->request->is(array('post', 'put'))) {
			
				if(empty($this->data['Testimonial']['slug']))
            {
			$this->request->data['Testimonial']['slug'] = $this->generateSlug($this->request->data['Testimonial']['name']);			
			}	
				if(!empty($this->data['Testimonial']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Testimonial']['image'], 'img-'.time(),'testimonials/');
					}
					$this->request->data['Testimonial']['image'] = $filename;
					
						
			if ($this->Testimonial->save($this->request->data)) {
				$this->Session->setFlash(__('The Testimonial has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Testimonial could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Testimonial.' . $this->Testimonial->primaryKey => $id));
			$this->request->data = $this->Testimonial->find('first', $options);
		}
	}
	
	
	
 public function admin_change_testimonial_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'testimonials', 'action'=>'index'));
        }
        
        if(!$this->Testimonial->save(array('id'=>$this->request->data['testimonial_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Testimonial status updated.'));
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
		$this->Testimonial->id = $id;
		if (!$this->Testimonial->exists()) {
			throw new NotFoundException(__('Invalid Testimonial'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Testimonial->delete()) {
			$this->Session->setFlash(__('The Testimonial has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Testimonial could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
