<?php
App::uses('AppController', 'Controller');
class CategoriesController extends AppController {

////////////////////////////////////////////

public function offers() {
	
	$conditions = '';
	
	if(!empty( $this->request->query['colors'])) { 
	$colors   = $this->request->query['colors'];
    }
    else {
	   $colors = "";	  
   }      
	  
	if(!empty( $this->request->query['sizes'])) { 
	$sizes   = $this->request->query['sizes'];
		
	$conditions[] = "Product.sizes in ($sizes)";
			 	 		
  }
    else {
	   $sizes = "";	  
   }
   
	if(!empty( $this->request->query['colors'])) { 
	$colors   = $this->request->query['colors'];
	
	$conditions[] = "Product.colors in ($colors)";
	
   }
    else {
	   $colors = "";	  
   }	 
   
  if(!empty( $this->request->query['orderby'])) { 
	$orderby   = $this->request->query['orderby'];
  }
    else {
	   $orderby = "name";	  
   }
   
   if(!empty( $this->request->query['pagelimit'])) { 
	$pagelimit = $this->request->query['pagelimit'];
   }
	   
     else {
	  
	   $pagelimit = '';
   }
	
	$directorypage = 'products/';
	 
	$this->set(compact('directorypage'));
		
		$conditions[] = "Product.active =  '1'";
		
			$conditions[] = "Product.discounted_price > 0";
		 
        $categories_products1 = $this->Product->find('all', [  
			'contain' => array(
				'Category',
			),			
            'conditions' => [
               // 'Product.active' => 1,
				$conditions
				//'Product.sizes in ('.$sizes.')',
				//'Product.colors in ('.$colors.')',
				//$conditions,
            ],
            'order' => [
                'Product.'.$orderby  => 'ASC'
            ],
			
			'limit' => $pagelimit,
            
        ]);
  
 		
	$this->set(compact('categories_products','orderby','pagelimit','colors','sizes'));	
	
	}
	
	
	  public function productdata()
    {
		$this->layout ="ajax";
 
        if(!$this->request->is('AJAX'))
        {
			die;
         }
		 $this->loadModel('Product');	
		 $conditions[] = "Product.active = 1";
		 
		 $category_ids = '';
		 
		 if(!empty($this->request->data['category_ids'])) { 
			 
			  $category_ids  =  @$this->request->data['category_ids'];
		
		 
		 
		 $conditions[] = "Product.category_id in ($category_ids)";
		 
		 } 
		 
     	$categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Category',
			),			
            'conditions' => [
			$conditions
              //  'Product.active' => 1,			 
			   // 'Product.category_id in ('.$category_ids.')',
				 
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			
		//	'limit' => 1
            
        ]);
  
 		
	$this->set(compact('categories_products'));
	
        echo  $this->render('/Categories/productdata');
exit;
 
    }
	
	
	  public function materialdata()
    {
		$this->layout ="ajax";
 
        if(!$this->request->is('AJAX'))
        {
			die;
         }
		 $this->loadModel('Product');	
		 $this->loadModel('Material');	
		 $conditions[] = "Product.active = 1";
		 
		 $material_ids = '';
		 
		 if(!empty($this->request->data['material_ids'])) { 
			 
			  $material_ids  =  @$this->request->data['material_ids'];
		
		 
		 
		 $conditions[] = "Product.material_id in ($material_ids)";
		 
		 } 
		// print_r($conditions);
		 
     	$categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Material',
			),			
            'conditions' => [
			$conditions
              //  'Product.active' => 1,			 
			   // 'Product.category_id in ('.$category_ids.')',
				 
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			
		//	'limit' => 1
            
        ]);
  //print_r($categories_products);
 		
	$this->set(compact('categories_products'));
	
        echo  $this->render('/Categories/materialdata');
exit;
 
    }
	
	
	  public function sizedata()
    {
		$this->layout ="ajax";
 
        if(!$this->request->is('AJAX'))
        {
			die;
         }
		 $this->loadModel('Product');	
			
		 $conditions[] = "Product.active = 1";
		 
		 $sizes = '';
		 
		 if(!empty($this->request->data['sizes'])) { 
			 
			  $sizes  =  @$this->request->data['sizes'];
		
		 
		 
		 $conditions[] = "Product.sizes in ($sizes)";
		 
		 } 
		// print_r($conditions);
		 
		 
     	$categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Material',
			),			
            'conditions' => [
			$conditions
              //  'Product.active' => 1,			 
			   // 'Product.category_id in ('.$category_ids.')',
				 
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			
		//	'limit' => 1
            
        ]);
  //print_r($categories_products);
 		
	$this->set(compact('categories_products'));
	
        echo  $this->render('/Categories/sizedata');
exit;
 
    }
	
	  public function colorsdata()
    {
		$this->layout ="ajax";
 
        if(!$this->request->is('AJAX'))
        {
			die;
         }
		 $this->loadModel('Product');	
			
		 $conditions[] = "Product.active = 1";
		 
		 $colors = '';
		 
		 if(!empty($this->request->data['colors'])) { 
			 
			  $colors  =  @$this->request->data['colors'];
		
		 
		 
		 $conditions[] = "Product.colors in ($colors)";
		 
		 } 
		// print_r($conditions);
		 
		 
     	$categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Material',
			),			
            'conditions' => [
			$conditions
              //  'Product.active' => 1,			 
			   // 'Product.category_id in ('.$category_ids.')',
				 
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			
		//	'limit' => 1
            
        ]);
  //print_r($categories_products);
 		
	$this->set(compact('categories_products'));
	
        echo  $this->render('/Categories/colorsdata');
exit;
 
    }
	
	  public function pricedata()
    {
		$this->layout ="ajax";
 
        if(!$this->request->is('AJAX'))
        {
			die;
         }
		 $this->loadModel('Product');	
			
		 $conditions[] = "Product.active = 1";
		 
		 $price = '';
		// print_r($price);
		 if(!empty($this->request->data['price'])) { 
			 
			  $price  =  @$this->request->data['price'];
		
		 
		 
		 $conditions[] = "Product.price in ($price)";
		 
		 } 
		//print_r($conditions);
		 
		 
     	$categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Material',
			),			
            'conditions' => [
			$conditions
              //  'Product.active' => 1,			 
			   // 'Product.category_id in ('.$category_ids.')',
				 
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			
		//	'limit' => 1
            
        ]);
  //print_r($categories_products);
 		
	$this->set(compact('categories_products'));
	
        echo  $this->render('/Categories/pricedata');
exit;
 
    }
	
	
	
	
	public function compareproducts() {
		
		$conditions[] = "Product.active =  '1'";
		 
        $categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Material',
			),			
            'conditions' => [
               // 'Product.active' => 1,
				$conditions
				//'Product.sizes in ('.$sizes.')',
				//'Product.colors in ('.$colors.')',
				//$conditions,
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			
            
        ]);
  
  $colors = "";
 $sizes = "";
		
	$this->set(compact('categories_products','colors','sizes'));	
	
	}
	
	 public function index() {
 		 
		  $category = $this->Category->find('all', [
            'recursive' => 0,
			'contain' => array(
			    'ChildCategory',
				'Product',
			),
            'conditions' => [
                'Category.parent_id' => 0
            ]
        ]);
		
	$this->set(compact('category'));
	
	$directorypage = "products/";
	
	$this->set(compact('directorypage'));

	if(!empty( $this->request->query['sizes'])) { 
	$sizes   = $this->request->query['sizes'];
		
	$conditions[] = "Product.sizes in ($sizes)";
			 	 		
  }
    else {
	   $sizes = "";	  
   }
   
	if(!empty( $this->request->query['colors'])) { 
	$colors   = $this->request->query['colors'];
	
	$conditions[] = "Product.colors in ($colors)";
	
   }
    else {
	   $colors = "";	  
   }	 
   
   
	if(!empty( $this->request->query['orderby'])) { 
	$orderby   = $this->request->query['orderby'];
    }
    else {
	   $orderby = "name";
	  
   }
   if(!empty( $this->request->query['pagelimit'])) { 
	$pagelimit = $this->request->query['pagelimit'];
   }
	   
     else {
	  
	   $pagelimit = '';
   }
   
		   
	 


	$this->set(compact('orderby','pagelimit','colors', 'sizes'));	
	
     
						
 	}
	
	
	public function Xindex() {
	
	$conditions = '';
	
	if(!empty( $this->request->query['colors'])) { 
	$colors   = $this->request->query['colors'];
    }
    else {
	   $colors = "";	  
   }      
	  
	if(!empty( $this->request->query['sizes'])) { 
	$sizes   = $this->request->query['sizes'];
		
	$conditions[] = "Product.sizes in ($sizes)";
			 	 		
  }
    else {
	   $sizes = "";	  
   }
   
	if(!empty( $this->request->query['colors'])) { 
	$colors   = $this->request->query['colors'];
	
	$conditions[] = "Product.colors in ($colors)";
	
   }
    else {
	   $colors = "";	  
   }	 
   
  if(!empty( $this->request->query['orderby'])) { 
	$orderby   = $this->request->query['orderby'];
  }
    else {
	   $orderby = "name";	  
   }
   
   if(!empty( $this->request->query['pagelimit'])) { 
	$pagelimit = $this->request->query['pagelimit'];
   }
	   
     else {
	  
	   $pagelimit = '';
   }
	
	$directorypage = 'products/';
	 
	$this->set(compact('directorypage'));
		
		$conditions[] = "Product.active =  '1'";
		 
        $categories_products = $this->Product->find('all', [  
			'contain' => array(
				'Category',
			),			
            'conditions' => [
               // 'Product.active' => 1,
				$conditions
				//'Product.sizes in ('.$sizes.')',
				//'Product.colors in ('.$colors.')',
				//$conditions,
            ],
            'order' => [
                'Product.'.$orderby  => 'ASC'
            ],
			
			'limit' => $pagelimit,
            
        ]);
		
		$categories1_products = $this->Product->find('all', [  
			'contain' => array(
				'Category',
			),			
            'conditions' => [
               // 'Product.active' => 1,
				$conditions1
				//'Product.sizes in ('.$sizes.')',
				//'Product.colors in ('.$colors.')',
				//$conditions,
            ],
            'order' => [
                'Product.'.$orderby  => 'ASC'
            ],
			
			'limit' => $pagelimit,
            
        ]);
  
 		
	$this->set(compact('categories_products','orderby','pagelimit','colors','sizes'));	
	
	}
	
   public function get_allchildren($id){
	return $this->Category->children($id, true); // a flat array with
   }
         
    public function categorypage($category=null) {
 		 
		  $category = $this->Category->find('first', [
            'recursive' => 0,
			'contain' => array(
			    'ChildCategory',
				'Product',
			),
            'conditions' => [
                'Category.slug' => $category
            ]
        ]);
		
		
		
		
	$this->set(compact('category'));
	
	
		$this->loadModel('Blog');	
		$blogs = $this->Blog->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Blog.blog_order' => 'ASC'
			),
			'conditions' => array(
	'Blog.category_id' => $category['Category']['id']		
			),
		));
		
        $this->set(compact('blogs')); 
	
	
	
	$directorypage = "category/".$category['Category']['slug'];
	
	$this->set(compact('directorypage'));

   
   
	if(!empty( $this->request->query['orderby'])) { 
	$orderby   = $this->request->query['orderby'];
    }
    else {
	   $orderby = "name";
	  
   }
   if(!empty( $this->request->query['pagelimit'])) { 
	$pagelimit = $this->request->query['pagelimit'];
   }
	   
     else {
	  
	   $pagelimit = '';
   }
   
		   
	$categoryIds = $this->Category->children($category['Category']['id'],false,'id');		   
	
	
	 
	


	$this->set(compact('orderby','pagelimit'));	
	
        if(empty($category)) {
			return $this->redirect('/');         
        }
		
 	
	if(!empty($category['Category']['meta_title'])) {	
		$meta_title   = $category['Category']['meta_title'];
	}
	if(!empty($category['Category']['meta_keyword'])) {	
		$meta_keyword = $category['Category']['meta_keyword'];
	}
	if(!empty($category['Category']['meta_desc'])) {	
		$meta_desc   = $category['Category']['meta_desc'];
	}
		 
	$this->set(compact('meta_title','meta_keyword','meta_desc'));
						
 	}
	
   
    public function view($categoryslug=null,$slug = null) {
 		 

		  $category = $this->Category->find('first', [
            'recursive' => 0,
			'contain' => array(
				'Blog',
				'ChildCategory',
			),
            'conditions' => [
                'Category.slug' => $slug
            ]
        ]);
		
	    $this->set(compact('category'));
		
		 $this->loadModel('Blog');	

		
		$categories2 = $this->Category->find('list', [

            'recursive' => -1,          

          

            'conditions' => [

                'Category.active' => 1,

				'Category.parent_id' => 0,

            ],

            'order' => [

                'Category.id' => 'ASC'

            ]

        ]);

	    $this->set(compact('category','categories2'));
		 
		 
		 $categorys = $this->Category->find('all', [
            'recursive' => 0,
			'contain' => array(
				'ChildCategory',
			),
            'conditions' => [
                'Category.active' => 1
            ]
        ]);
		
		$params = array(
'recursive' => -1,
//'fields' => 'Category.id, Category.name, Category.parent_id',
'contain' => [
				 'ChildCategory',  
            ], 	
            	'conditions' => array(
			'Category.active' => '1'
			),
);

$categoriesmenu = $this->Category->find('threaded',$params);


	
	    $this->set(compact('categorys','categoriesmenu'));
		
		 
		 
		 
	     $products = $this->Blog->find('all', [  
		    
            'conditions' => [
             //   'Product.active' => 1,				
            ],
            'order' => [
                'Blog.id' => 'ASC'
            ]			
        ]);
		
	
		
		
		
		
		
    $this->set(compact('products'));
		
	
	$directorypage = $categoryslug.'/category/'.$slug;
		
	 $this->set(compact('directorypage'));
	 
        if(empty($category)) {
			return $this->redirect('/');         
        }
		
 	
	if(!empty($category['Category']['meta_title'])) {	
		$meta_title   = $category['Category']['meta_title'];
	}
	if(!empty($category['Category']['meta_keyword'])) {	
		$meta_keyword = $category['Category']['meta_keyword'];
	}
	if(!empty($category['Category']['meta_desc'])) {	
		$meta_desc   = $category['Category']['meta_desc'];
	}
		 
	$this->set(compact('meta_title','meta_keyword','meta_desc'));
	
		 
   
   
	if(!empty( $this->request->query['orderby'])) { 
	$orderby   = $this->request->query['orderby'];
  }
    else {
	   $orderby = "name";
	  
   }
   if(!empty( $this->request->query['pagelimit'])) { 
	$pagelimit = $this->request->query['pagelimit'];
   }
	   
     else {
	  
	   $pagelimit = '';
   }
   

	 
$conditions[] = "Blog.category_id = ".$category['Category']['id'];
//print_r($conditions);
//exit;
	
	
    $categories_products = $this->Blog->find('all', [    
			'contain' => array(
				'Category',
			//	'Material',
			),		
            'conditions' => [
            //    'Product.active' => 1,
			//	'Product.category_id' => $category['Category']['id'],
				$conditions,
            ],
            'order' => [
              //  'Product.views' => 'ASC'
            ]
        ]);
        
	$this->set(compact('categories_products','orderby','pagelimit'));	
	
 	}
	
	  

	public function admin_index($parent_id=0) { 
		
		$categories = $this->Category->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Category.lft' => 'ASC'
			),
			'conditions' => array(
		//	'Category.parent_id' => $parent_id
			),
		));
		
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $parent_id));
		$category_details = $this->Category->find('first', $options);
		
 			 
		$this->set(compact('categories','parent_id','category_details'));
		
	}

////////////////////////////////////////////

	public function admin_view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException('Invalid category');
		}
		$category = $this->Category->find('first', array(
			'contain' => array(
				'ParentCategory',
				'ChildCategory',
			),
			'conditions' => array(
				'Category.id' => $id
			)
		));
		$this->set(compact('category'));
	}

////////////////////////////////////////////

	public function admin_add() {
		
	//	$this->request->data['Category']['parent_id'] = $parent_id;
		
		if ($this->request->is('post')) {
			
			if(empty($this->data['Category']['slug']))
            {
			$this->request->data['Category']['slug'] = $this->generateSlug($this->request->data['Category']['name']);			
			}	
			
			$filename = "";
			
				if(!empty($this->data['Category']['image']['name']))
                    {
					  $filename = $this->process_image($this->request->data['Category']['image'], 'img-'.$this->request->data['Category']['slug'],'categories/');
					}
					$this->request->data['Category']['image'] = $filename;

			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('The category has been saved');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The category could not be saved. Please, try again.');
			}
		}
	
	
		$parents = $this->Category->generateTreeList(null, null, null, ' -- ');
		$this->set(compact('parents','parent_id'));
	}

////////////////////////////////////////////

	public function admin_edit($id = null) {
		
 		  
		if (!$this->Category->exists($id)) {
			throw new NotFoundException('Invalid category');
		}
		
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$category_details = $this->Category->find('first', $options);
	
		$filename  = $category_details['Category']['image'];
		$filename1 = $category_details['Category']['cat_image'];
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(empty($this->data['Category']['slug']))
            {
			$this->request->data['Category']['slug'] = $this->generateSlug($this->request->data['Category']['name']);			
			}	
			
				if(!empty($this->data['Category']['cat_image']['name']))
                    {
					 
					  $filename1 = $this->process_image($this->request->data['Category']['cat_image'], 'img-cat-'.$this->request->data['Category']['slug'],'categories/');
					}
					$this->request->data['Category']['cat_image'] = $filename1;
					
		if(!empty($this->data['Category']['image']['name']))
                    {
					  $filename = $this->process_image($this->request->data['Category']['image'], 'img-'.$this->request->data['Category']['slug'],'categories/');
					}
					$this->request->data['Category']['image'] = $filename;
						
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('The category has been saved');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The category could not be saved. Please, try again.');
			}
		} else {
			$this->request->data = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
		}

		$parents = $this->Category->generateTreeList(null, null, null, ' -- ');
		$this->set(compact('parents'));
	}

////////////////////////////////////////////


 public function admin_change_category_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'categories', 'action'=>'index'));
        }
        
        if(!$this->Category->save(array('id'=>$this->request->data['category_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Category status updated.'));
        die;
    }
	public function admin_change_category_order()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'categories', 'action'=>'index'));
        }
        
        if(!$this->Category->save(array('id'=>$this->request->data['category_id'], 'category_order'=>$this->request->data['category_order'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update category order at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Category Order updated.'));
        die;
    }
	
	
	public function admin_delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException('Invalid category');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash('Category deleted');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Category was not deleted');
		return $this->redirect(array('action' => 'index'));
	}

////////////////////////////////////////////

}
