<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 * @property PaginatorComponent $Paginator
 */
class QuizesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function index() {
 	if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}			
					
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'quiz-results'
			),
		));
		 
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
	}
	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
	}
 
 	$this->set(compact('page','meta_title','meta_keyword','meta_desc'));
	
	
	$this->loadModel('Report');	
	$reports = $this->Report->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Report.id' => 'ASC'
			),
			'conditions' => array(
			'Report.user_id' => $this->Session->read('User.id')
		//	'Blog.active' => 1			
			),
		));
		

		
        $this->set(compact('reports')); 
	
		$this->loadModel('Quizes');	
  
		
  
		$quizes = $this->Quizes->find('all', [   
			'contain' => [
                'Report', 			
						
            ],         
            'conditions' => [
                'Quizes.active' => 1,
			//	'Quizes.id !=' => 'Report.quiz_id',
				
            ],
            'order' => [
                'Quizes.id' => 'DESC'
            ],
			//'limit' => 3
        ]);
		
		$this->set(compact('quizes'));
		
	  $orders="";	
		

		$this->loadModel('Order');	
  
		
      
		$orders = $this->Order->find('all', [   
			'contain' => [
               // 'Report', 			
						
            ],         
            'conditions' => [
                //'Order.product_id' => 1,
				'Order.user_id ' => $this->Session->read('User.id'),
				
            ],
            'order' => [
           //     'Quizes.id' => 'DESC'
            ],
			//'limit' => 3
        ]);
		

		$this->set(compact('orders'));
	$order_product_id=[];
		foreach($orders as $order){
		    
		    $order_product_id[]=$order['Order']['product_id'];
		}
			

	
	$this->set(compact('orders','order_product_id'));

	}	
	
	public function view($slug=null) {
 				 $this->layout = false;
	 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}
			
			
			$this->loadModel('User');	
    $isverified = $this->User->find('first', array(
			'recursive' => 0,
			'order' => array(
				'User.id' => 'ASC'
			),
			'conditions' => array(
			'User.id' =>  $this->Session->read('User.id')
					
			),
		));
        	
	 $this->set(compact('isverified'));		
			
if($isverified['User']['country_id']==0){
    
 echo "<script>alert('Plz Verify Account');window.location.href='/customer/myaccount';</script>";   
}

			
		$this->loadModel('Quizes');	
	$quiz = $this->Quizes->find('first', array(
			'recursive' => 0,
			'order' => array(
				'Quizes.id' => 'ASC'
			),
			'conditions' => array(
			'Quizes.slug' => $slug
		//	'Blog.active' => 1			
			),
		));
		

		
        $this->set(compact('quiz')); 
		
		
		
		
		
		$this->loadModel('Report');	
	$report = $this->Report->find('first', array(
			'recursive' => 0,
			'order' => array(
				'Report.id' => 'ASC'
			),
			'conditions' => array(
			'Report.quiz_id' => $quiz['Quizes']['id'],
			'Report.user_id' => $this->Session->read('User.id')
		//	'Blog.active' => 1			
			),
		));
		

		
        $this->set(compact('report'));


if(!empty($report)){
	
echo "<script>alert('Already Attempted');window.location.href='/quizes/index';</script>";
}
		
		$json = $quiz['Quizes']['qjson'];
		
$json_array = json_decode($json, true);
 $this->set(compact('quiz','json_array'));
 
$len=sizeof($json_array);
//$randArr = UniqueRandomNumbersWithinRange(0,$len-1,3);

  function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
$randArr = UniqueRandomNumbersWithinRange(0,$len-1,25);
 $this->set(compact('quiz','json_array','randArr'));
	}	
/**
 * admin_index method
 *
 * @return void
 */

 
 
 	public function admin_index() {

 
		$blogs = $this->Blog->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Blog.id' => 'desc'
			),
			'conditions' => array(
			),
		));
				
		$this->set(compact('blogs'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$this->set('banner', $this->Blog->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($company_id = null) {
  
		if ($this->request->is(array('post', 'put'))) {
			 
					 $filename = "";
					 
					$service_slug = $this->generateSlug($this->request->data['Blog']['name']);
					 
				$this->request->data['Blog']['slug'] = $service_slug;
				
		if(!empty($this->data['Blog']['image']['name']))
                    {
					
					  $filename = $this->process_image($this->request->data['Blog']['image'], 'img-'.$service_slug,'blogs/');
					}
					
						$this->request->data['Blog']['image'] = $filename;
 					  
					 

					
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The Blog has been saved.'));
				return $this->redirect(array('controller' => 'blogs', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Blog could not be saved. Please, try again.'));
			}
		}	

$categories = $this->Blog->Category->find('list', array(
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
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid Blog'));
		}
		
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$banner_details = $this->Blog->find('first', $options);
	
		$filename = $banner_details['Blog']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

					$service_slug = $this->generateSlug($this->request->data['Blog']['name']);
					 
				$this->request->data['Blog']['slug'] = $service_slug;
					 
			 
			 if(!empty($this->data['Blog']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Blog']['image'], 'img-'.$service_slug,'blogs/');  
					}
					
				
			$this->request->data['Blog']['image'] = $filename;
 					  
					
	 
						 
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The Blog has been saved.'));
				return $this->redirect(array('controller' => 'blogs', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Blog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Blog->find('first', $options);
		}		
		 	 
		$categories = $this->Blog->Category->find('list', array(
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
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid Blog'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Blog->delete()) {
			$this->Session->setFlash(__('The Blog has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Blog could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
