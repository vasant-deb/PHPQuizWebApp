<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 */
class LocationsController extends AppController {

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
  
	public function index() {
 			 

	$locations = $this->Location->find('all', array(
'recursive' => 0,	
'contain' => array(
'ChildLocation',
),	
'order' => array(
'Location.location_order' => 'ASC'
),
'conditions' => array(
'Location.active' => 1,
'Location.parent_id' => 0
),
));

$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'our-presence'
			),
		));
	
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('countryname', 'India', $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('countryname', 'India', $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('countryname', 'India', $meta_desc );
	}
			
	$this->set(compact('meta_title','meta_keyword','meta_desc'));	 

       $this->set(compact('locations')); 
	}	
	
	
	public function ourproducts($slug = null) {	 
		
	$this->loadModel('Catalog');
		 		 
		$catalog = $this->Catalog->find('first', [
            'recursive' => 0,				 		
            'conditions' =>  array(
			'Catalog.id' => 1
			)
        ]);
			
     $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
			  		  
	$this->loadModel('Sitepage');	

	$product_page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => '3'
			),
		));
	
	$this->set(compact('product_page'));			
			
	$this->loadModel('Product');	 
				
	$products = $this->Product->find('all', [            
            'conditions' => [
                'Product.active' => 1,
				'Product.parent_id' => 0,
            ],
            'order' => [
                'Product.id' => 'ASC'
            ]
        ]);
 		
	$location_name = $location['Location']['name'];
	
    $this->set(compact('location_name')); 	

	$product_name  = $product_page['Sitepage']['name'];
	
	if(!empty($catalog['Catalog']['meta_title'])) {	
		$meta_title   = $catalog['Catalog']['meta_title'];
		
 		$meta_title = str_replace('countryname', $location_name, $meta_title );
		$meta_title = str_replace('catname', $product_name, $meta_title );
	}
	if(!empty($catalog['Catalog']['meta_keyword'])) {	
		$meta_keyword = $catalog['Catalog']['meta_keyword'];
		
 		$meta_keyword = str_replace('countryname', $location_name, $meta_keyword );
		$meta_keyword = str_replace('catname', $product_name, $meta_keyword );
	}
	if(!empty($catalog['Catalog']['meta_desc'])) {	
		$meta_desc   = $catalog['Catalog']['meta_desc'];
		
 		$meta_desc = str_replace('countryname', $location_name, $meta_desc );
		$meta_desc = str_replace('catname', $product_name, $meta_desc );
	}
			
	$this->set(compact('meta_title','meta_keyword','meta_desc'));			
  			

    $directory_name = $slug.'/';
			
    $this->set(compact('directory_name','location','product','products','catalog'));


    }
 	public function EcommerceWebDesigning($slug = null) {
	$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 4
			),
		));
	$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
 
	}
	
		public function SearchEngineMarketing($slug = null) {
			$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'search-engine-marketing'
			),
		));
	$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function LogoDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'logo-designing'
			),
		));
		 
	$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function BrochureDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'brochure-designing'
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	public function ResumesDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'resumes-and-cv-designing'
			),
		));
		 
	$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
		public function BusinessCardDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'business-card-designing'
			),
		));
		 
	$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function FlyersDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'flyers-and-poster-designing'
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function PostDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'post-designing-for-social-media'
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	public function ResponsiveWebDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 7
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
		public function ContentWriting($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'content-writing'
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function StaticWebDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 9
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	public function CorporateWebsiteDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 12
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}

	public function CustomWebDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 13
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
		public function LandingPageDesigning($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'landing-page-designing'
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}

	public function MagentoWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 14
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	public function WordpressWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 16
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function PhpWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 18
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function CodeigniterWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'codeigniter-web-development'
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function DrupalWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 19
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
		public function JoomlaWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 20
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	public function CmsWebDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 21
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	
	public function PortalDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 22
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	public function B2bB2cPortalDevelopment($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 23
			),
		));
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function TravelPortal($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 24
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function RealEstatePortal($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 25
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function JobPortal($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 26
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function EducationPortal($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 27
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function DigitalMarketing($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 28
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function InternetMarketing($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 29
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function SeoServices($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 30
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function SmoServices($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 31
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	public function GoogleAdword($slug = null) {
		$this->layout = 'location';
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 32
			),
		));
		 
$this->set(compact('page')); 	 
	 $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
        
        	$location_name = $location['Location']['name'];  
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('India', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('India', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('India', $location_name, $meta_desc );
	}
    $this->set(compact('slug'));			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));
 
	}
	
	
    public function view($slug = null) {
 		
		//SELECT concat('<a href=\"\">',name,'</a>') as name FROM `products` where 'yellow-mustard-oil-in-delhi ' LIKE concat(slug,'%')
$this->layout = 'location';
$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'our-presence'
			),
		));
	 $this->set(compact('page')); 	 
			$this->loadModel('Sitepage');	
   
    $about = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 2
			),
		));
		
		$this->set(compact('about')); 
 			$this->loadModel('Blog');	

		$blogs = $this->Blog->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Blog.blog_order' => 'ASC'
			),
			'conditions' => array(
		//	'Blog.active' => 1			
			),
			'limit' => 6
		));
		
        $this->set(compact('blogs')); 
		  $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
				
        if(empty($location)) {
			return $this->redirect('/');
        }		
  
		$country = $slug;
		
		$directory_name = $country.'/';
		
        $this->set(compact('directory_name','country','location','slug'));
		
    	$location_name = $location['Location']['name'];  
	
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
		
 		$meta_title = str_replace('countryname', $location_name, $meta_title );
	}

	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
		
 		$meta_keyword = str_replace('countryname', $location_name, $meta_keyword );
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
		
 		$meta_desc = str_replace('countryname', $location_name, $meta_desc );
	}
			
	$this->set(compact('meta_title','meta_keyword','meta_desc','location_name'));	
	
		$home_description = $page['Sitepage']['description'];
	
		  $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $slug
            ]
        ]);
			 
		$header_text_title = $page['Sitepage']['name'];
		
		$header_text = $page['Sitepage']['description'];

		$header_text_title = str_replace('countryname', $location_name, $header_text_title);

		$header_text = str_replace('countryname', $location_name, $header_text);

		
			
		$this->set(compact('header_text_title','header_text'));			
				
 		
	}
	
	 public function get_allchildren($id){
		
		$this->loadModel('Category');
		
	return $this->Category->children($id, true); 
   }
      
	public function productdetails($location=null,$slug = null) {
		 
		 
 		$country = $location;
		 
 		
		$this->loadModel('Catalog');
		 		 
		$catalog = $this->Catalog->find('first', [
            'recursive' => 0,				 		
            'conditions' =>  array(
			'Catalog.id' => 1
			)
        ]);
			
     $location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $location
            ]
        ]);
				
    	$this->loadModel('Product');	
       
      	$this->loadModel('Product');	
       
        $product = $this->Product->find('first', [
            'recursive' => -1,
            'contain' => [
                'Gallery',
				'ParentProduct',				
            ],
            'conditions' => [              
                'Product.active' => 1,
                'Product.slug' => $slug
            ]
        ]);
		  
		if (empty($product)) {
            return $this->redirect(['action' => 'index'], 301);
        }
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
            'recursive' => -1,          
          
            'conditions' => [
                'Product.active' => 1,
				'Product.parent_id' => $product['Product']['id'],
            ],
            'order' => [
                'Product.id' => 'ASC'
            ]
        ]);
 		
	$location_name = $location['Location']['name'];
	
    $this->set(compact('location_name')); 	

	$product_name  = $product['Product']['name'];
	
	if(!empty($catalog['Catalog']['meta_title'])) {	
		$meta_title   = $catalog['Catalog']['meta_title'];
		
 		$meta_title = str_replace('countryname', $location_name, $meta_title );
		$meta_title = str_replace('catname', $product_name, $meta_title );
	}
	if(!empty($catalog['Catalog']['meta_keyword'])) {	
		$meta_keyword = $catalog['Catalog']['meta_keyword'];
		
 		$meta_keyword = str_replace('countryname', $location_name, $meta_keyword );
		$meta_keyword = str_replace('catname', $product_name, $meta_keyword );
	}
	if(!empty($catalog['Catalog']['meta_desc'])) {	
		$meta_desc   = $catalog['Catalog']['meta_desc'];
		
 		$meta_desc = str_replace('countryname', $location_name, $meta_desc );
		$meta_desc = str_replace('catname', $product_name, $meta_desc );
	}
			
	$this->set(compact('meta_title','meta_keyword','meta_desc'));			
  		
    $directory_name = $country.'/';
			
    $this->set(compact('directory_name','country','location','product','products','catalog'));
	
	if(($product['Product']['parent_id']) == 0) {
	 
		$this->render('mainproduct');
	}
	
	}
	
    public function product($location=null) {
		 
 		    $country = $location;
		 
 		 $this->layout = "marketplace";		  
		
		$this->loadModel('Catalog');
		 		 
		$catalog = $this->Catalog->find('first', [
            'recursive' => 0,				 		
            'conditions' =>  array(
			'Catalog.id' => 1
			)
        ]);
			
			 $this->loadModel('Sitepage');	
   
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
  				
        $this->set(compact('country','product_page','products','catalog'));
		
		
		$location = $this->Location->find('first', [
            'recursive' => 0,			
            'conditions' => [
                'Location.slug' => $location
            ]
        ]);

	$location_name = $location['Location']['name'];
		
	  $this->set(compact('location_name')); 	
	  
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 8
			),
		));
		
		$product_name = $product_page['Sitepage']['name'];
		
	
	if(!empty($catalog['Catalog']['meta_title'])) {	
		$meta_title   = $catalog['Catalog']['meta_title'];
		
 		$meta_title = str_replace('countryname', $location_name, $meta_title );
				$meta_title = str_replace('catname', $product_name, $meta_title );

	}
	if(!empty($catalog['Catalog']['meta_keyword'])) {	
		$meta_keyword = $catalog['Catalog']['meta_keyword'];
		
 		$meta_keyword = str_replace('countryname', $location_name, $meta_keyword );
		 		$meta_keyword = str_replace('catname', $product_name, $meta_keyword );

	}
	if(!empty($catalog['Catalog']['meta_desc'])) {	
		$meta_desc   = $catalog['Catalog']['meta_desc'];
		
 		$meta_desc = str_replace('countryname', $location_name, $meta_desc );
		 		$meta_desc = str_replace('catname', $product_name, $meta_desc );

	}
			
	$this->set(compact('meta_title','meta_keyword','meta_desc'));	
	 
		
	}
		
	public function admin_index($parent_id=0) { 
	
		$locations = $this->Location->find('all', array(
			'recursive' => 0,
			'order' => array(
				//'Location.id' => 'ASC'
			),
			'conditions' => array(
			'Location.parent_id' => $parent_id
			),
		));
		
		$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $parent_id));
		$location_details = $this->Location->find('first', $options);
		
 			 
		$this->set(compact('locations','parent_id','location_details'));
		
	}
		 
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Location->exists($id)) {
			throw new NotFoundException(__('Invalid location'));
		}
		$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
		$this->set('location', $this->Location->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($parent_id=0) {
		if ($this->request->is('post')) {
			$this->Location->create();
			
			
			if(empty($this->data['Location']['slug']))
            {
			$this->request->data['Location']['slug'] = $this->generateSlug($this->request->data['Location']['name']);			
			}	
			
			 $filename = "";
				if(!empty($this->data['Location']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Location']['image'], 'img-'.$this->request->data['Location']['slug'],'locations/');
				}
				
		 
					$this->request->data['Location']['image'] = $filename;
					
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
				$this->set(compact('parent_id'));

	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Location->exists($id)) {
			throw new NotFoundException(__('Invalid location'));
		}
		
		$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
		$category_details = $this->Location->find('first', $options);
	
		$filename = $category_details['Location']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
			
			if(empty($this->data['Location']['slug']))
            {
			$this->request->data['Location']['slug'] = $this->generateSlug($this->request->data['Location']['name']);			
			}	
		if(!empty($this->data['Location']['image']['name']))
                {
					  $filename = $this->process_image($this->request->data['Location']['image'], 'img-'.$this->request->data['Location']['slug'],'locations/');
				}
				
					$this->request->data['Location']['image'] = $filename;
						
						
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
			$this->request->data = $this->Location->find('first', $options);
		}
	}	

 public function admin_change_location_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'locations', 'action'=>'index'));
        }
        
        if(!$this->Location->save(array('id'=>$this->request->data['location_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Location status updated.'));
        die;
    }
	public function admin_change_location_order()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'locations', 'action'=>'index'));
        }
        
        if(!$this->Location->save(array('id'=>$this->request->data['location_id'], 'location_order'=>$this->request->data['location_order'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update Location order at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Location Order updated.'));
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
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Location->delete()) {
			$this->Session->setFlash(__('The location has been deleted.'));
		} else {
			$this->Session->setFlash(__('The location could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
?>