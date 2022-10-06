<?php
App::uses('AppController', 'Controller');
class CatalogsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = [
        'RequestHandler',
    ];

////////////////////////////////////////////////////////////

    public function beforeFilter() {
        parent::beforeFilter();
    }

////////////////////////////////////////////////////////////

  
    public function exporters() {
		
		
		 $directory_name = "exporters";
		    
		 $this->set(compact('directory_name'));
		 
        $catalog = $this->Catalog->find('first', [
            'conditions' => [
                'Catalog.id' => 2,
            ],            
        ]);
        $this->set(compact('catalog')); 
		
		 
		
		 $this->loadModel('Product');
         $category_tree = $this->Product->find('threaded');     
         $this->set('listmyproducts', $category_tree);
			
		$this->render('index');
     }

	  public function manufacturers() {
		
		 $directory_name = "manufacturers";
		    
		 $this->set(compact('directory_name'));
		 
		 
         $catalog = $this->Catalog->find('first', [
            'conditions' => [
                'Catalog.id' => 3,
            ],            
        ]);	
        $this->set(compact('catalog')); 
		
	  
		 $this->loadModel('Product');
         $category_tree = $this->Product->find('threaded');     
         $this->set('listmyproducts', $category_tree);
		 
		$this->render('index');
     }

	   public function suppliers() {
		
		$directory_name = "suppliers";
		    
		$this->set(compact('directory_name'));
		 
		 
          $catalog = $this->Catalog->find('first', [
            'conditions' => [
                'Catalog.id' => 4,
            ],
            
        ]);
        $this->set(compact('catalog')); 
				
	 
	
		 $this->loadModel('Product');
         $category_tree = $this->Product->find('threaded');     
         $this->set('listmyproducts', $category_tree);
		 
		$this->render('index');
     }
	 
////////////////////////////////////////////////////////////

  public function productdetails($slug = null) {
		 		  
		  $directory_name = str_replace($this->webroot,'',$this->here);
		  $directory_name = str_replace($slug,'',$directory_name);
		  $directory_name = str_replace('.html','',$directory_name);
	 		
				 $this->set(compact('directory_name'));
	
 		$country = ''; //$location;
				
 $catalog_slug = str_replace('/','',$directory_name);
				
		 if($catalog_slug == 'suppliers') {
			 	$catalog_id = 4;
		 }
		 
		  if($catalog_slug == 'manufacturers') {
			 	$catalog_id = 3;
		 }
		 
		  if($catalog_slug == 'exporters') {
			 	$catalog_id = 2;
		 }
		 
		 

 		// $this->layout = "marketplace";		  
		
		$this->loadModel('Catalog');
		 		 
		$catalog = $this->Catalog->find('first', [
            'recursive' => 0,				 		
            'conditions' =>  array(
			'Catalog.id' => $catalog_id
			)
        ]);

		 
    	$this->loadModel('Product');	 

        $product = $this->Product->find('first', [
            'recursive' => -1,
            'contain' => [
                'Gallery',    
            ],
            'conditions' => [              
                'Product.active' => 1,
                'Product.slug' => $slug
            ]
        ]);
		  
	$product_name = $product['Product']['name'];
	
	if(!empty($catalog['Catalog']['meta_title'])) {	
		$meta_title   = $catalog['Catalog']['meta_title'];
		
		$meta_title = str_replace('catname', $product_name, $meta_title );
	}
	if(!empty($catalog['Catalog']['meta_keyword'])) {	
		$meta_keyword = $catalog['Catalog']['meta_keyword'];
		
		$meta_keyword = str_replace('catname', $product_name, $meta_keyword );
	}
	if(!empty($catalog['Catalog']['meta_desc'])) {	
		$meta_desc   = $catalog['Catalog']['meta_desc'];
		
		$meta_desc = str_replace('catname', $product_name, $meta_desc );
	}
			
	$this->set(compact('meta_title','meta_keyword','meta_desc'));	
			   
		  $product_page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => '3'
			),
		));
			$this->loadModel('Product');	 
				
	 		$products = $this->Product->find('all', [            
            'conditions' => [
                'Product.active' => 1,
            ],
            'order' => [
                'Product.views' => 'ASC'
            ]
        ]);        
			
 		
 	 	
  				
    $this->set(compact('country','location','product','products','catalog'));
	
	}

////////////////////////////////////////////////////////////

    public function view($id = null) {
 
		 
        $product = $this->Catalog->find('first', [
            'recursive' => -1,
            'contain' => [
                'Category',

            ],
            'conditions' => [
                'Catalog.active' => 1,
                'Catalog.slug' => $id
            ]
        ]);
		 
		 
		  $term = $product['Catalog']['name'];
		  $product_id = $product['Catalog']['id'];
		  
                  $conditions[] = [
                //    'Catalog. LIKE' => '%' . $term . '%'// . '  and id != '. $product_id
                ];
							
        if (empty($product)) {
            return $this->redirect(['action' => 'index'], 301);
        }

        $this->Catalog->updateViews($product);
		 
        $this->set(compact('product'));
 
    }
    

	public function admin_index() { 
		
		$products = $this->Catalog->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Catalog.id' => 'DESC'
			),
			'conditions' => array(
			),
		));
		
		
		$this->set(compact('products'));
		
	}
	  
  public function XXXadmin_index( ) {
 
		$id = 1;
		
        if (!$this->Catalog->exists($id)) {
            throw new NotFoundException('Invalid product');
        }
		
		 $product = $this->Catalog->find('first', [
                'conditions' => [
                    'Catalog.id' => $id
                ]
            ]);
 			
        if ($this->request->is('post') || $this->request->is('put')) {
  
		$this->request->data['Catalog']['slug'] = $this->generateSlug($this->request->data['Catalog']['name']);
				
			$this->request->data['Catalog']['categories'] = @implode(',', $this->request->data['Catalog']['categories']);	
			
            if ($this->Catalog->save($this->request->data)) {
                $this->Flash->flash('The Catalog has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The Catalog could not be saved. Please, try again.');
            }
        } else {
            $product = $this->Catalog->find('first', [
                'conditions' => [
                    'Catalog.id' => $id
                ]
            ]);
            $this->request->data = $product;
        }

        $this->set(compact('id'));

        $this->set(compact('product'));

	 
       $categories = $this->Catalog->Category->find('all', array(
		'conditions' => array(
		'Category.parent_id' => $product['Catalog']['category_id']
		)	
		)
		);
		
		$this->set(compact('categories'));	
		
		$parentcategories = $this->Catalog->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		
		$this->set(compact('parentcategories'));

    }
 
    public function admin_add() {
 
        if ($this->request->is('post')) {
			
			$this->request->data['Catalog']['slug'] = $this->generateSlug($this->request->data['Catalog']['name']);
 			
			$this->request->data['Catalog']['categories'] = @implode(',', $this->request->data['Catalog']['categories']);	

            $this->Catalog->create();
            if ($this->Catalog->save($this->request->data)) {
                $this->Flash->flash('The Catalog has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The Catalog could not be saved. Please, try again.');
            }
        }       
		
		$categories = $this->Catalog->Category->find('all', array(
		'conditions' => array('Category.parent_id' => '1')
		)
		);
		$this->set(compact('categories'));	
		
		$parentcategories = $this->Catalog->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		$this->set(compact('parentcategories'));	

     	
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
 

        if (!$this->Catalog->exists($id)) {
            throw new NotFoundException('Invalid product');
        }
		
		 $product = $this->Catalog->find('first', [
                'conditions' => [
                    'Catalog.id' => $id
                ]
            ]);
 			
        if ($this->request->is('post') || $this->request->is('put')) {
  
		$this->request->data['Catalog']['slug'] = $this->generateSlug($this->request->data['Catalog']['name']);
				
			$this->request->data['Catalog']['categories'] = @implode(',', $this->request->data['Catalog']['categories']);	
			
            if ($this->Catalog->save($this->request->data)) {
                $this->Flash->flash('The Catalog has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The Catalog could not be saved. Please, try again.');
            }
        } else {
            $product = $this->Catalog->find('first', [
                'conditions' => [
                    'Catalog.id' => $id
                ]
            ]);
            $this->request->data = $product;
        }

        $this->set(compact('id'));

        $this->set(compact('product'));

	 
       $categories = $this->Catalog->Category->find('all', array(
		'conditions' => array(
		'Category.parent_id' => $product['Catalog']['category_id']
		)	
		)
		);
		
		$this->set(compact('categories'));	
		
		$parentcategories = $this->Catalog->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		
		$this->set(compact('parentcategories'));

    }
 
	 
	public function admin_dropdown_subcategories()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'products', 'action'=>'index'));
        }
        
		
	     $parent_category_id  =  @$this->request->data['parent_category_id'];
         	$this->loadModel('Category');	 

		    $options = [
            'recursive' => 0,
            'conditions' => [
				'Category.parent_id' => $parent_category_id,
             ]
        ];
       
		$categories =   $this->Category->find('all', $options);
?>	
 <?php foreach ($categories as $category): ?>
  
              <label class="checkbox col-sm-4"><input name="data[Catalog][categories][]" type="checkbox" value="<?php echo $category['Category']['id']; ?>">
			  <span><?php echo h($category['Category']['name']); ?></span>
			  </label> 
			  
<?php endforeach; ?>

 
<?php
		
         die;
    }
	 	
 
 public function admin_change_catalog_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'catalogs', 'action'=>'index'));
        }
        
        if(!$this->Catalog->save(array('id'=>$this->request->data['catalog_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Catalog status updated.'));
        die;
    }
	
    public function admin_delete($id = null) {
        $this->Catalog->id = $id;
        if (!$this->Catalog->exists()) {
            throw new NotFoundException('Invalid Catalog');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Catalog->delete()) {
            $this->Flash->flash('Catalog deleted');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->flash('Catalog was not deleted');
        return $this->redirect(['action' => 'index']);
    }

 
}
