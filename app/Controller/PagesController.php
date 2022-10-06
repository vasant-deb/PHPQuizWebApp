<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
  

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
 
  public function index() {
	
	  $this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 1
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
  
		
		$this->loadModel('Product');	
		
		 $product = $this->Product->find('all', [   
			'contain' => [
                'Gallery',    
				'Category',
            ],         
            'conditions' => [
                'Product.active' => 1,
				'Product.hot_product' => 1,
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			//'limit' => 6
        ]);
		$newproduct = $this->Product->find('all', [   
			'contain' => [
                'Gallery',    
				'Category',
            ],         
            'conditions' => [
                'Product.active' => 1,
				
            ],
            'order' => [
                'Product.id' => 'Desc'
            ],
			'limit' => 4
        ]);

	     $products = $this->Product->find('all', [   
			'contain' => [
                'Gallery', 
				'Category',				
						
            ],         
            'conditions' => [
                'Product.active' => 1,
				//'Product.hot_product' => 1,
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			'limit' => 6
        ]);
		
		$freeproducts = $this->Product->find('all', [   
			'contain' => [
                'Gallery', 
				'Category',				
						
            ],         
            'conditions' => [
                'Product.active' => 1,
				'Product.discounted_price' => 0,
            ],
            'order' => [
                'Product.id' => 'DESC'
            ],
			'limit' => 6
        ]);
		
		$specialproducts = $this->Product->find('all', [   
			'contain' => [
                'Gallery', 
				'Category',				
						
            ],         
            'conditions' => [
                'Product.active' => 1,
				'Product.newarrival' => 1,
            ],
            'order' => [
                'Product.id' => 'DESC'
            ],
			'limit' => 3
        ]);
        
		$this->set(compact('products','product','newproduct','freeproducts','specialproducts'));
 
 	   
		$this->loadModel('Banner');	
		
		$banners = $this->Banner->find('all', array(
			'recursive' => 0,
			
			'conditions' => array(
				'Banner.active' => 1			
			)
		));
		
        $this->set(compact('banners','products','page','meta_title','meta_keyword','meta_desc')); 
        
        
        
		  
		  $this->loadModel('Report');	
	$newreports=$this->Report->find('all', array(
    'joins' => array(
        array(
            'table' => 'users',
            'alias' => 'UserJoin',
            'type' => 'INNER',
            'conditions' => array(
                'UserJoin.id = Report.user_id'
            )
        )
    ),
    'conditions' => array(
        'Report.quiz_id' => 2
    ),
    'fields' => array('UserJoin.*', 'Report.*'),
    'order' => 'Report.total_score DESC'
));
		 $this->set(compact('newreports'));  
		  
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
    

	
	
  public function quiz() {
	
	  $this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'quiz'
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
public function tutorial() {
	  $this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'tutorials'
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
        
		$this->loadModel('Blog');	
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
        
        	$this->loadModel('Category');	
        	$categories = $this->Category->find('all', array(
			'recursive' => 0,
			'order' => array(
			//	'Category.lft' => 'ASC'
			),
			'conditions' => array(
			'Category.parent_id' => 0
			),
		));
		$this->set(compact('categories'));
}
   
	public function creditform() {
	
	$this->loadModel('Creditenquiry');
		 
		if ($this->request->is('post')) {
			
 

			$this->request->data['ip_address'] = $_SERVER['REMOTE_ADDR'];
			$this->Creditenquiry->create();
		 	if ($this->Creditenquiry->save($this->request->data)) {
				
				$this->Flash->success('Thank you for filling this Form,Our representative will get in touch with you soon.');
			
			   App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));			 
			 
				$business_name    = $this->request->data['business_name'];
				$date_of_application   = $this->request->data['date_of_application'];
				$address1  = $this->request->data['address1'];
 				$address2  = $this->request->data['address2'];
				$telephone_number = $this->request->data['telephone_number'];	
				$contact_email = $this->request->data['email'];					
				$business_since = $this->request->data['business_since'];	
				
				$accept_back_orders = $this->request->data['accept_back_orders'];	
				
				$name_of_owner1 = $this->request->data['name_of_owner1'];	
				$name_of_owner2 = $this->request->data['name_of_owner2'];	
				$name_of_owner3 = $this->request->data['name_of_owner3'];	
				$organization_type = @$this->request->data['organization_type'];	
				$bank_name = $this->request->data['bank_name'];	
				$bank_address = $this->request->data['bank_address'];	
				$bank_phone_no = $this->request->data['bank_phone_no'];	
				$bank_account_no = $this->request->data['bank_account_no'];	
				$name_of_supplier1 = $this->request->data['name_of_supplier1'];	
				$supplier_account1 = $this->request->data['supplier_account1'];	
				$supplier_telephone1 = $this->request->data['supplier_telephone1'];	
				
				$name_of_supplier2 = $this->request->data['name_of_supplier2'];	
				$supplier_account2 = $this->request->data['supplier_account2'];	
				$supplier_telephone2 = $this->request->data['supplier_telephone2'];	
				$form_completed_by_name = $this->request->data['form_completed_by_name'];	
				$form_completed_by_title = $this->request->data['form_completed_by_title'];	
				$form_completed_by_telephone = $this->request->data['form_completed_by_telephone'];	
				$form_completed_by_email = $this->request->data['form_completed_by_email'];	
				 
				
		        $company_details = $this->Session->read('company_details');
		        $company_name    = $company_details['company_name']; 
		        $company_email   = $company_details['company_email']; 
				
			$CustomMessageText = "Dear $company_name,
			<br /><br />
			 Credit Application filled by $business_name.
			<br><br>
			 Following are details : 
			 
			<br><br /> Date of Application  : $date_of_application <br />
			<br><br />Business Name  : $business_name <br />
			<br />Email Address : $contact_email <br />"; 
			if($address1) { 
			$CustomMessageText .= "<br />Address1 : $address1 <br />";
			}	
			
			if($address2) { 
			$CustomMessageText .= "<br />Address2 : $address2 <br />";
			}			
			
			if($telephone_number) { 
			$CustomMessageText .= "<br />Telephone Number : $telephone_number <br />";
			}	
			 
			 
			
			if($business_since) { 
			$CustomMessageText .= "<br />How Long Has Business Been in Operation? : $business_since <br />";
			}	
		 
			if($accept_back_orders) { 
			$CustomMessageText .= "<br />Will Company Accept Back Orders? : $accept_back_orders <br />";
			}	
			
			if($name_of_owner1) { 
			$CustomMessageText .= "<br />Name of Owner (or Officers if corporated) : $name_of_owner1 <br />";
			}	
			
			if($name_of_owner2) { 
			$CustomMessageText .= "<br />Name of Owner (or Officers if corporated) : $name_of_owner2 <br />";
			}
			
			if($name_of_owner3) { 
			$CustomMessageText .= "<br />Name of Owner (or Officers if corporated) : $name_of_owner3 <br />";
			}
			
			if($organization_type) { 
			$CustomMessageText .= "<br /> Organization Type : $organization_type <br />";
			}
			
			if($bank_name) { 
			$CustomMessageText .= "<br /> Bank Name : $bank_name <br />";
			}
			
			if($bank_address) { 
			$CustomMessageText .= "<br /> Bank Address : $bank_address <br />";
			}
			
			if($bank_phone_no) { 
			$CustomMessageText .= "<br /> Bank Phone No : $bank_phone_no <br />";
			}
 
			if($bank_account_no) { 
			$CustomMessageText .= "<br /> Bank Account No : $bank_account_no <br />";
			}
 
 
			if($name_of_supplier1) { 
			$CustomMessageText .= "<br /> Name and Account Numbers of Current Suppliers <br />";
			}
			
			if($name_of_supplier1) { 
			$CustomMessageText .= "<br /> 1.Name of Supplier : $name_of_supplier1 <br />";
			}
			
			if($supplier_account1) { 
			$CustomMessageText .= "<br /> Account : $supplier_account1 <br />";
			}
			
			if($supplier_telephone1) { 
			$CustomMessageText .= "<br /> Telephone : $supplier_telephone1 <br />";
			}
			
			 
			
			if($name_of_supplier2) { 
			$CustomMessageText .= "<br /> 1.Name of Supplier : $name_of_supplier2 <br />";
			}
			
			if($supplier_account2) { 
			$CustomMessageText .= "<br /> Account : $supplier_account2 <br />";
			}
			
			if($supplier_telephone2) { 
			$CustomMessageText .= "<br /> Telephone : $supplier_telephone2 <br />";
			}
			 
 
			if($form_completed_by_name) { 
			$CustomMessageText .= "<br /> Form Completed By : $form_completed_by_name <br />";
			}
			
			if($form_completed_by_title) { 
			$CustomMessageText .= "<br /> Title : $form_completed_by_title <br />";
			}
			 
			if($form_completed_by_telephone) { 
			$CustomMessageText .= "<br /> Telephone : $form_completed_by_telephone <br />";
			}
			  
			if($form_completed_by_email) {
			$CustomMessageText .= "<br /> Email : $form_completed_by_email <br />";
			}
 
			
			$CustomMessageText .= "<br /><br />
			To your success!
			<br>
			Email Services by Asterisk Serve.";
					
		$CustomMessageSubject = $company_name." - Credit Application filled by $business_name.";  
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		$to = "vsntshrma@gmail.com"; //$company_email; 
		 
  	    $mail = new PHPMailer();
        $mail->ContentType	= "text/html";
        $mail->From		= $company_email;
        $mail->FromName		= $company_name;
        $mail->Host		= "localhost";
        $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');
		
        $mail->Body	= $message;
        $mail->AddReplyTo("$company_email");
  		
		if($mail->Send()){	 
        } else { 
        }
 		 
				 
	  	} 
		else {
			die;
			 
		}
		 
		}
		
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 8
			),
		));
	 
 	$this->set(compact('page'));
	
	}
		
		
			public function Xcreditform() {		$this->loadModel('Creditenquiries');		 		if ($this->request->is('post')) {			 			$this->request->data['ip_address'] = $_SERVER['REMOTE_ADDR'];			$this->Creditenquiries->create();		 	if ($this->Creditenquiries->save($this->request->data)) {								$this->Flash->success('Thank you for filling this Form,Our representative will get in touch with you soon.');							 }	  		 }	 			$this->loadModel('Sitepage');	       $page = $this->Sitepage->find('first', array(			'recursive' => 0,			'order' => array(							),			'conditions' => array(			'Sitepage.id' => 8			),		));	  	$this->set(compact('page'));		 		
	 }
	
	public function terms() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'terms-and-conditions'
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
	}
		
	public function rules() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'tournament-rules'
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
	}
		public function refund() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'refund-and-cancellation'
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
	}
	public function FreeWebsite() {
	$this->layout = false;

	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'free-website-for-your-business'
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
 	
	}
	public function shipping() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 7
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
	}
	
	 public function policy() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 6
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
	}
	
	public function warranty() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 4
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
	}
	
	
public function newarrival() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 13
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
	}
	
	
	public function feature() {
	
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 14
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
	}
	
	
	public function faq() {
	
	$this->loadModel('Sitepage');	
	
	 $this->loadModel('Faq');	

	     $faqs = $this->Faq->find('all', [   
			
            'conditions' => [
               // 'Faq.active' => 1,
				
            ]
        ]);
		
       
		$this->set(compact('faqs'));		
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 15
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
	}
	
	public function EcommerceWebDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 4
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
	}
		public function SearchEngineMarketing() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'search-engine-marketing'
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
	}
	
		public function LogoDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'logo-designing'
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
	}
	
		public function BrochureDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'brochure-designing'
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
	}
	
	public function ResumesDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'resumes-and-cv-designing'
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
	}
		public function BusinessCardDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'business-card-designing'
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
	}
	
		public function FlyersDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'flyers-and-poster-designing'
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
	}
	
		public function PostDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'post-designing-for-social-media'
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
	}
	
	public function ResponsiveWebDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 7
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
	}
		public function ContentWriting() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'content-writing'
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
	}
	
		public function career() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'career'
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
	}
	
		public function service() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'service'
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
	}
	public function CompanyProfile() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'company-profile'
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
	}
	
		public function OurTeam() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'our-team'
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
	}
	
	public function DigitalMarketingPricing() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'digital-marketing-pricing'
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
	}
	
	
	public function WebsitePricing() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'website-pricing'
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
	}
	
		public function StaticWebDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 9
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
	}
	
	public function CorporateWebsiteDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 12
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
	}

	public function CustomWebDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 13
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
	}
		public function LandingPageDesigning() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'landing-page-designing'
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
	}

	public function MagentoWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 14
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
	}
	
	public function WordpressWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 16
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
	}
	
		public function PhpWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 18
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
	}
	
		public function CodeigniterWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'codeigniter-web-development'
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
	}
	public function DrupalWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 19
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
	}
	
		public function JoomlaWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 20
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
	}
	
	public function CmsWebDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 21
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
	}
	
	
	public function PortalDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 22
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
	}
	
	public function B2bB2cPortalDevelopment() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 23
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
	}
	public function TravelPortal() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 24
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
	}
	public function RealEstatePortal() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 25
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
	}
	public function JobPortal() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 26
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
	}
	public function EducationPortal() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 27
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
	}
	public function DigitalMarketing() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 28
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
	}
	public function InternetMarketing() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 29
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
	}
	public function SeoServices() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 30
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
	}
	public function SmoServices() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 31
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
	}
	public function GoogleAdword() {
	
	$this->loadModel('Sitepage');	
   
		
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 32
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
	}
	
	public function sitemap() {
		$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 10
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
	
    $this->loadModel('Product');	

	     $products = $this->Product->find('all', [  
		    'contain' => [
				
            ],
            'conditions' => [
                'Product.active' => 1,				
            ],
            'order' => [
                'Product.id' => 'ASC'
            ]			
        ]);

    $this->set(compact('products'));
     
	}
	 
	public function about() {
	$this->layout = false;
	
	
	}
	
	
		
	public function contact() {
		
			$this->loadModel('Sitepage');	
			
			$page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'contact-us'
			),
		));		 

		//  $this->viewVars['meta_title'];
	
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
	}
	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
	}
		 
	$this->set(compact('meta_title','meta_keyword','meta_desc'));
			 
	$this->set(compact('page'));
	
	}
	
	public function howtoshop() {
		
			$this->loadModel('Sitepage');	
			
			$page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => 17
			),
		));		 

		//  $this->viewVars['meta_title'];
	
	if(!empty($page['Sitepage']['meta_title'])) {	
		$meta_title   = $page['Sitepage']['meta_title'];
	}
	if(!empty($page['Sitepage']['meta_keyword'])) {	
		$meta_keyword = $page['Sitepage']['meta_keyword'];
	}
	if(!empty($page['Sitepage']['meta_desc'])) {	
		$meta_desc   = $page['Sitepage']['meta_desc'];
	}
		 
	$this->set(compact('meta_title','meta_keyword','meta_desc'));
			 
	$this->set(compact('page'));
	
	}
	
	
	public function admin_index() { 
		
		$pages = $this->Page->find('all', array(
			'recursive' => 0,
			'order' => array(				
			),
			'conditions' => array(			
			),
		));		  			 
		$this->set(compact('pages'));		
	}
 	  
	public function admin_view($id = null) {
		if (!$this->Page->exists($id)) {
			throw new NotFoundException('Invalid page');
		}
		$page = $this->Page->find('first', array(			
			'conditions' => array(
				'Page.id' => $id
			)
		));
		$this->set(compact('page'));
	}

////////////////////////////////////////////

	public function admin_add() {		
		
		if ($this->request->is('post')) {
			
			if(empty($this->data['Page']['slug']))
            {
			$this->request->data['Page']['slug'] = $this->generateSlug($this->request->data['Page']['name']);			
			}	
			
			$filename = "";
			
				if(!empty($this->data['Page']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Page']['image'], $this->request->data['Page']['slug'],'pages/');
					}
					$this->request->data['Page']['image'] = $filename;

			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash('The page has been saved');
				return $this->redirect(array('action' => 'index',$parent_id));
			} else {
				$this->Session->setFlash('The page could not be saved. Please, try again.');
			}
		}
	
	}

////////////////////////////////////////////

	public function admin_edit($id = null) {
		if (!$this->Page->exists($id)) {
			throw new NotFoundException('Invalid page');
		}
		
		$options = array('conditions' => array('Page.' . $this->Page->primaryKey => $id));
		$page_details = $this->Page->find('first', $options);
	
		$filename = $page_details['Page']['image'];
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(empty($this->data['Page']['slug']))
            {
			$this->request->data['Page']['slug'] = $this->generateSlug($this->request->data['Page']['name']);			
			}	
		
			if(!empty($this->data['Page']['image']['name']))
                    {
						$filename = $this->process_image($this->request->data['Page']['image'], $this->request->data['Page']['slug'],'pages/');
					}
					
					$this->request->data['Page']['image'] = $filename;
						
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash('The page has been saved');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The page could not be saved. Please, try again.');
			}
		} else {
			$this->request->data = $this->Page->find('first', array('conditions' => array('Page.id' => $id)));
		}

	}

////////////////////////////////////////////


 public function admin_change_page_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'categories', 'action'=>'index'));
        }
        
        if(!$this->Page->save(array('id'=>$this->request->data['page_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Page status updated.'));
        die;
    }
	public function admin_change_page_order()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'categories', 'action'=>'index'));
        }
        
        if(!$this->Page->save(array('id'=>$this->request->data['page_id'], 'page_order'=>$this->request->data['page_order'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update page order at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Page Order updated.'));
        die;
    }
	
	
	public function admin_delete($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException('Invalid page');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Page->delete()) {
			$this->Session->setFlash('Page deleted');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Page was not deleted');
		return $this->redirect(array('action' => 'index'));
	}

}
