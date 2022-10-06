<?php
App::uses('AppController', 'Controller');
/**
 * Services Controller
 *
 * @property Service $Service
 * @property PaginatorComponent $Paginator
 */
class ServicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	
	
 public function view($comapany_id=null,$id = null) {
		$this->layout = "safeguard";
		 
		
		if(is_numeric($id)) {
			$conditions = array('Service.id' => $id);
		}
		else {
			$conditions = array('Service.slug' => $id);
		}
		
		$service = $this->Service->find('first', array(
 			'conditions' => array(
				$conditions
			)
		));
		 
		$this->loadModel('Company');

		
		$company = $this->Company->find('first', array(
 			'conditions' => array(
				'Company.id' => $service['Service']['company_id']
			)
		));
		
		$this->loadModel('Service');

		
		$services = $this->Service->find('all', array(
 			'conditions' => array(
				'Service.company_id' => $service['Service']['company_id'],
				'Service.servicetype' => '1'
			)
		));
		
		
		$products = $this->Service->find('all', array(
 			'conditions' => array(
				'Service.company_id' => $service['Service']['company_id'],
				'Service.servicetype' => '2'

			)
		));
		
		
		if(empty($service)) {
			return $this->redirect(array('action' => 'index'));
		}
		 
	//	$this->Service->updateViews($service);

		$this->set(compact('company','service','services','products'));
 
	} 
	
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Service->recursive = 0;
		$this->set('services', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
		$this->set('service', $this->Service->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			
			
			if(!empty($this->data['Service']['image']['name']))
                    {
						
						
                        $file = $this->data['Service']['image']; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                            //do the actual uploading of the file. First arg is the tmp name, second arg is
                            //where we are putting it
                            move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload_images/' . $file['name']);

                            //prepare the filename for database entry
                            $this->request->data['Service']['image'] = $file['name'];
                        }
					//	echo $this->data['Service']['image']; exit;
					}
					else {
							$this->request->data['Service']['image']  = null;
					}

					if($this->data['Service']['slug'] == '') {

					$service_slug = $this->Service->generateSlug($this->request->data['Service']['name']);
					$this->request->data['Service']['slug'] = $service_slug;
					}
	 
	 
			$this->Service->create();
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		}
		$companies = $this->Service->Company->find('list');
		$this->set(compact('companies'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		
		$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
		$service_details = $this->Service->find('first', $options);
	
		$filename = $service_details['Service']['image'];
		
		
		if ($this->request->is(array('post', 'put'))) {
			 
			if(!empty($this->data['Service']['image']['name']))
                    {
						
						
                        $file = $this->data['Service']['image']; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                            //do the actual uploading of the file. First arg is the tmp name, second arg is
                            //where we are putting it
                            move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload_images/' . $file['name']);

                            //prepare the filename for database entry
                           $filename = $file['name'];
                        }
					 
					}
					$this->request->data['Service']['image'] = $filename;
					
					if($this->data['Service']['slug'] == '') {

					$service_slug = $this->Company->generateSlug($this->request->data['Service']['name']);
					$this->request->data['Service']['slug'] = $service_slug;
					}
	 
	 
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
			$this->request->data = $this->Service->find('first', $options);
		}
		$companies = $this->Service->Company->find('list');
		$this->set(compact('companies'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Service->delete()) {
			$this->Session->setFlash(__('The service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
