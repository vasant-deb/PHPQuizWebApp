<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 * @property PaginatorComponent $Paginator
 */
class BlogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function index() {
 				
					
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 11
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
	
	$blogs = $this->Blog->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Blog.blog_order' => 'ASC'
			),
			'conditions' => array(
		//	'Blog.active' => 1			
			),
		));
		
        $this->set(compact('blogs')); 
	}	
	
	public function view($slug=null) {
 				
	$blogs = $this->Blog->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Blog.blog_order' => 'ASC'
			),
			'conditions' => array(
		//	'Blog.active' => 1			
			),
		));
		
        $this->set(compact('blogs')); 
		
	$blog = $this->Blog->find('first', array(
			'recursive' => 0,
			'order' => array(
				'Blog.blog_order' => 'ASC'
			),
			'conditions' => array(
			'Blog.slug' => $slug
		//	'Blog.active' => 1			
			),
		));
		
		
			if(!empty($blog['Blog']['meta_title'])) {	
		$meta_title   = $blog['Blog']['meta_title'];
	}
	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $blog['Blog']['meta_keyword'];
	}
	if(!empty($blog['Sitepage']['meta_desc'])) {	
		$meta_desc   = $blog['Blog']['meta_desc'];
	}
		
		
		
		
        $this->set(compact('blog','meta_title','meta_keyword','meta_desc')); 
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


		$categories = $this->Category->generateTreeList(null, null, null, ' -- ');
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
		 	 
		$categories = $this->Category->generateTreeList(null, null, null, ' -- ');
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
