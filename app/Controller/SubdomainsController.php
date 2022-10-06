<?php
App::uses('AppController', 'Controller');
class SubdomainsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = [
        'RequestHandler',
    ];

////////////////////////////////////////////////////////////

    public function beforeFilter() {
        parent::beforeFilter();
    }

////////////////////////////////////////////////////////////

    public function index() {
        $products = $this->Subdomain->find('all', [
            'recursive' => -1,
            'contain' => [
                'Brand'
            ],
            'limit' => 8,
            'conditions' => [
                'Subdomain.active' => 1,
            ],
            'order' => [
                'Subdomain.views' => 'ASC'
            ]
        ]);
        $this->set(compact('products'));
 

         $this->Subdomain->updateViews($products);

        $this->set('title_for_layout', Configure::read('Settings.SHOP_TITLE'));
    }

////////////////////////////////////////////////////////////

    public function products() {

        $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = [
            'Subdomain' => [
                'recursive' => -1,
                'contain' => [
                ],
                'limit' => 20,
                'conditions' => [
                    'Subdomain.active' => 1,
                ],
                'order' => [
                    'Subdomain.name' => 'ASC'
                ],
                'paramType' => 'querystring',
            ]
        ];
        $products = $this->Paginator->paginate();
        $this->set(compact('products'));

        $this->set('title_for_layout', 'All Products - ' . Configure::read('Settings.SHOP_TITLE'));

    }

////////////////////////////////////////////////////////////

    public function view($id = null) {
 
		 
        $product = $this->Subdomain->find('first', [
            'recursive' => -1,
            'contain' => [
                'Category',

            ],
            'conditions' => [
                'Subdomain.active' => 1,
                'Subdomain.slug' => $id
            ]
        ]);
		 
		 
		  $term = $product['Subdomain']['name'];
		  $product_id = $product['Subdomain']['id'];
		  
                  $conditions[] = [
                //    'Subdomain. LIKE' => '%' . $term . '%'// . '  and id != '. $product_id
                ];
				
				 
			 
			
        if (empty($product)) {
            return $this->redirect(['action' => 'index'], 301);
        }

        $this->Subdomain->updateViews($product);

		 
        $this->set(compact('product'));
 

        $this->set('title_for_layout', $product['Subdomain']['name'] . ' ' . Configure::read('Settings.SHOP_TITLE'));

  

    }

////////////////////////////////////////////////////////////

    public function search() {
 
        $search = null;
        if(!empty($this->request->query['search']) || !empty($this->request->data['name'])) {
            $search = empty($this->request->query['search']) ? $this->request->data['name'] : $this->request->query['search'];
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
            $terms = explode(' ', trim($search));
            $terms = array_diff($terms, array(''));
            $conditions = [
               // 'Brand.active' => 1,
              //  'Product.active' => 1,
            ];
            foreach($terms as $term) {
                $terms1[] = preg_replace('/[^a-zA-Z0-9]/', '', $term);
                $conditions[] = [
                    'Product.name LIKE' => '%' . $term . '%'
                ];
            }
            $products = $this->Subdomain->find('all', [
                'recursive' => -1,
                'contain' => [
                    'Brand'
                ],
                'conditions' => $conditions,
                'limit' => 200,
            ]);
            if(count($products) == 1) {
                return $this->redirect(['controller' => 'products', 'action' => 'view', 'slug' => $products[0]['Subdomain']['slug']]);
            }
            $terms1 = array_diff($terms1, array(''));
            $this->set(compact('products', 'terms1'));
        }
        $this->set(compact('search'));

        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->set('ajax', 1);
        } else {
            $this->set('ajax', 0);
        }

        $this->set('title_for_layout', 'Search');

        $description = 'Search';
        $this->set(compact('description'));

        $keywords = 'search';
        $this->set(compact('keywords'));
    }

////////////////////////////////////////////////////////////

    public function searchjson() {

        $term = null;
        if(!empty($this->request->query['term'])) {
            $term = $this->request->query['term'];
            $terms = explode(' ', trim($term));
            $terms = array_diff($terms, array(''));
            $conditions = [
                // 'Brand.active' => 1,
                'Product.active' => 1
            ];
            foreach($terms as $term) {
                $conditions[] = [
                    'Product.name LIKE' => '%' . $term . '%'
                ];
            }
            $products = $this->Subdomain->find('all', [
                'recursive' => -1,
                'contain' => [
                    // 'Brand'
                ],
                'fields' => [
                    'Product.id',
                    'Product.name',
                    'Product.image'
                ],
                'conditions' => $conditions,
                'limit' => 20,
            ]);
        }
        // $products = Hash::extract($products, '{n}.Product.name');
        echo json_encode($products);
        $this->autoRender = false;

    }

////////////////////////////////////////////////////////////

    public function sitemap() {
        $products = $this->Subdomain->find('all', [
            'recursive' => -1,
            'contain' => [
                'Brand'
            ],
            'fields' => [
                'Product.slug'
            ],
            'conditions' => [
                'Brand.active' => 1,
                'Product.active' => 1
            ],
            'order' => [
                'Product.created' => 'DESC'
            ],
        ]);
        $this->set(compact('products'));

        $website = Configure::read('Settings.WEBSITE');
        $this->set(compact('website'));

        $this->layout = 'xml';
        $this->response->type('xml');
    }

////////////////////////////////////////////////////////////

    public function admin_reset() {
        $this->Session->delete('Product');
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////

	public function admin_index() { 
		
		$products = $this->Subdomain->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Subdomain.id' => 'DESC'
			),
			'conditions' => array(
			),
		));
		
		
		$this->set(compact('products'));
		
	}
	 

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {

        if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data['Subdomain']['image']['name'])) {

            $this->Img = $this->Components->load('Img');

            $newName = $this->request->data['Subdomain']['slug'];

            $ext = $this->Img->ext($this->request->data['Subdomain']['image']['name']);

            $origFile = $newName . '.' . $ext;
            $dst = $newName . '.jpg';

            $targetdir = WWW_ROOT . 'images/original';

            $upload = $this->Img->upload($this->request->data['Subdomain']['image']['tmp_name'], $targetdir, $origFile);

            if($upload == 'Success') {
                $this->Img->resampleGD($targetdir . DS . $origFile, WWW_ROOT . 'images/large/', $dst, 800, 800, 1, 0);
                $this->Img->resampleGD($targetdir . DS . $origFile, WWW_ROOT . 'images/small/', $dst, 180, 180, 1, 0);
                $this->request->data['Subdomain']['image'] = $dst;
            } else {
                $this->request->data['Subdomain']['image'] = '';
            }

            if ($this->Subdomain->save($this->request->data)) {
                $this->Flash->flash($upload);
                return $this->redirect($this->referer());
            } else {
                $this->Flash->flash('The Product could not be saved. Please, try again.');
            }
        }

        if (!$this->Subdomain->exists($id)) {
            throw new NotFoundException('Invalid product');
        }
        $product = $this->Subdomain->find('first', [
            'recursive' => -1,
            'contain' => [
                'Category',
                'Brand',
            ],
            'conditions' => [
                'Product.id' => $id
            ]
        ]);
        $this->set(compact('product'));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
		
		 $_SESSION['KCFINDER'] = [
            'disabled' => false,
            'uploadURL' => '../images/products',
            'uploadDir' => '',
            'dirPerms' => 0777,
            'filePerms' => 0777
        ];
		
        if ($this->request->is('post')) {
			
			$this->request->data['Subdomain']['slug'] = $this->generateSlug($this->request->data['Subdomain']['name']);
 			
			$this->request->data['Subdomain']['categories'] = @implode(',', $this->request->data['Subdomain']['categories']);	

            $this->Subdomain->create();
            if ($this->Subdomain->save($this->request->data)) {
                $this->Flash->flash('The Subdomain has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The Subdomain could not be saved. Please, try again.');
            }
        }       
		
		$categories = $this->Subdomain->Category->find('all', array(
		'conditions' => array('Category.parent_id' => '1')
		)
		);
		$this->set(compact('categories'));	
		
		$parentcategories = $this->Subdomain->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		$this->set(compact('parentcategories'));	

     	
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {

        $_SESSION['KCFINDER'] = [
            'disabled' => false,
            'uploadURL' => '../images/products',
            'uploadDir' => '',
            'dirPerms' => 0777,
            'filePerms' => 0777
        ];

        if (!$this->Subdomain->exists($id)) {
            throw new NotFoundException('Invalid product');
        }
		
		 $product = $this->Subdomain->find('first', [
                'conditions' => [
                    'Subdomain.id' => $id
                ]
            ]);
 			
        if ($this->request->is('post') || $this->request->is('put')) {
  
		$this->request->data['Subdomain']['slug'] = $this->generateSlug($this->request->data['Subdomain']['name']);
				
			$this->request->data['Subdomain']['categories'] = @implode(',', $this->request->data['Subdomain']['categories']);	
			
            if ($this->Subdomain->save($this->request->data)) {
                $this->Flash->flash('The Subdomain has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The Subdomain could not be saved. Please, try again.');
            }
        } else {
            $product = $this->Subdomain->find('first', [
                'conditions' => [
                    'Subdomain.id' => $id
                ]
            ]);
            $this->request->data = $product;
        }

        $this->set(compact('id'));

        $this->set(compact('product'));

	 
       $categories = $this->Subdomain->Category->find('all', array(
		'conditions' => array(
		'Category.parent_id' => $product['Subdomain']['category_id']
		)	
		)
		);
		
		$this->set(compact('categories'));	
		
		$parentcategories = $this->Subdomain->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		
		$this->set(compact('parentcategories'));

    }

////////////////////////////////////////////////////////////

    public function admin_tags($id = null) {

        $tags = ClassRegistry::init('Tag')->find('all', [
            'recursive' => -1,
            'fields' => [
                'Tag.name'
            ],
            'order' => [
                'Tag.name' => 'ASC'
            ],
        ]);
        $tags = Hash::combine($tags, '{n}.Tag.name', '{n}.Tag.name');
        $this->set(compact('tags'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $tagstring = '';

            foreach($this->request->data['Subdomain']['tags'] as $tag) {
                $tagstring .= $tag . ', ';
            }

            $tagstring = trim($tagstring);
            $tagstring = rtrim($tagstring, ',');

            $this->request->data['Subdomain']['tags'] = $tagstring;

            $this->Subdomain->save($this->request->data, false);

            return $this->redirect(['action' => 'tags', $this->request->data['Subdomain']['id']]);

        }

        $product = $this->Subdomain->find('first', [
            'conditions' => [
                'Product.id' => $id
            ]
        ]);
        if (empty($product)) {
            throw new NotFoundException('Invalid product');
        }
        $this->set(compact('product'));

        $selectedTags = explode(',', $product['Subdomain']['tags']);
        $selectedTags = array_map('trim', $selectedTags);
        $this->set(compact('selectedTags'));

        $neighbors = $this->Subdomain->find('neighbors', ['field' => 'id', 'value' => $id]);
        $this->set(compact('neighbors'));

    }

////////////////////////////////////////////////////////////

    public function admin_csv() {
        $products = $this->Subdomain->find('all', [
            'recursive' => -1,
        ]);
        $this->set(compact('products'));
        $this->layout = false;
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
  
              <label class="checkbox col-sm-4"><input name="data[Subdomain][categories][]" type="checkbox" value="<?php echo $category['Category']['id']; ?>">
			  <span><?php echo h($category['Category']['name']); ?></span>
			  </label> 
			  
<?php endforeach; ?>

 
<?php
		
         die;
    }
	 	
 
 public function admin_change_subdomain_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'subdomains', 'action'=>'index'));
        }
        
        if(!$this->Subdomain->save(array('id'=>$this->request->data['subdomain_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Subdomain status updated.'));
        die;
    }
	
    public function admin_delete($id = null) {
        $this->Subdomain->id = $id;
        if (!$this->Subdomain->exists()) {
            throw new NotFoundException('Invalid product');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Subdomain->delete()) {
            $this->Flash->flash('Product deleted');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->flash('Product was not deleted');
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////

}
