<?php
/**
* Application level Controller
*
* This file is application-wide controller file. You can put all
* application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
* Application Controller
*
* Add your application-wide methods in the class below, your controllers
* will inherit them.
*
* @package       app.Controller
* @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
*/
class AppController extends Controller {


    public $components = [
        'Session',
        'Auth',
        'Flash',
       // 'DebugKit.Toolbar',
        // 'Security',
    ];
public function generateSlug($title){	

	$title = trim($title);
	return $this->slugit($title);
	}
	public function slugit($str, $replace=array(), $delimiter='-') { 
	if ( !empty($replace) ) {   
	$str = str_replace((array)$replace, ' ', $str);	
	}
	//$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);	
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);	
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);	
	return $clean;
	
	}

public function process_image($image_file = null,$service_slug = null,$folderpath = '') {
		
		$final_image = "";
		
		if($service_slug == null) {
			
			$service_slug = time();
		}
		
		
		 $ext = substr(strtolower(strrchr($image_file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
						
							$newName = $service_slug.".".$ext;
							  
							move_uploaded_file($image_file['tmp_name'], WWW_ROOT . 'images/'.$folderpath . $newName);	
							  
                            $final_image = $newName;  
                        }
						return $final_image;
	}
	
    public function beforeFilter() {
   
//	$this->response->disableCache();
			
		 $customer_data = $this->Session->read('customer_data');
         $this->set(compact('customer_data'));

		 
    $shop = $this->Session->read('Shop');
		
	$this->set(compact('shop'));
	 
	$directory_name = "";
	$this->set(compact('directory_name'));
      
  	$this->loadModel('Homepage');	
  
		$homepages1 = $this->Homepage->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Homepage.id' => 'asc'
			),
			'conditions' => [
				'Homepage.id' => 1,
               
            ],
		));
			
$homepages2 = $this->Homepage->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Homepage.id' => 'asc'
			),
			'conditions' => [
				'Homepage.id' => 2,
               
            ],
		));

$homepages3 = $this->Homepage->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Homepage.id' => 'asc'
			),
			'conditions' => [
				'Homepage.id' => 3,
               
            ],
		));

$homepages4 = $this->Homepage->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Homepage.id' => 'asc'
			),
			'conditions' => [
				'Homepage.id' => 4,
               
            ],
		));

$homepages5 = $this->Homepage->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'Homepage.id' => 'asc'
			),
			'conditions' => [
				'Homepage.id' => 5,
               
            ],
		));		
		$this->set(compact('homepages1','homepages2','homepages3','homepages4','homepages5'));
		
  	
		$this->loadModel('Product');	
		
		
 
	     $homeproduct = $this->Product->find('all', [   
			'contain' => [
                'Gallery',
                'Category',				
            ],         
            'conditions' => [
				
                'Product.active' => 1,
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			'limit' => 8
        ]);
		
		 $homeproduct1 = $this->Product->find('all', [   
			'contain' => [
                'Gallery',
				'Category',	
            ],         
            'conditions' => [
				
                'Product.active' => 1,
            ],
            'order' => [
                'Product.id' => 'ASC'
            ],
			'limit' => 2
        ]);
        
		$this->set(compact('homeproduct1'));
		

	    
        
		$this->set(compact('homeproduct'));
 
 
		$compare_ids = $this->Session->read('Compareids');

		$compare_products = "";

			
		
 	    $this->loadModel('Testimonial');	

	     $testimonials = $this->Testimonial->find('all', [ 
            'conditions' => [
                'Testimonial.active' => 1,
            ],
           
			//'limit' => 2
        ]);
		
	$this->set(compact('testimonials'));
	
	  $this->loadModel('Blog');	
					
	$ourblogs = $this->Blog->find('all', array(
			'recursive' => 0,
			'order' => array(
				'Blog.blog_order' => 'ASC'
			),
			'conditions' => array(
		//	'Blog.active' => 1			
			),
			'limit' => '3'
		));
		
		
        $this->set(compact('ourblogs')); 
		
	
	
		
    $this->loadModel('Sitepage');	
   
    $home_page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.id' => '1'
			),
		));
		 
	$meta_title     = $home_page['Sitepage']['meta_title'];
	$meta_keyword   = $home_page['Sitepage']['meta_keyword'];
	$meta_desc      = $home_page['Sitepage']['meta_desc'];
 
 	$this->set(compact('home_page','meta_title','meta_keyword','meta_desc'));

	
	$this->loadModel('Banner');	 
	$homebanners = $this->Banner->find('all', array(
	'order' => array(
				'Banner.id' => 'DESC'
			),
	'conditions' => array( 	
	)		
	));		
	$this->set('homebanners', $homebanners);
		
	$this->loadModel('Category');
		
	$categories2 = $this->Category->find('threaded', array(
			'contain' => [
                'ChildCategory',
				'Product',	
            ],  
			
			'order' => array(
				'Category.id' => 'ASC'
			),
			'conditions' => array('Category.parent_id' => '0',
			'Category.active' => '1'
			),
		));
		
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

$categories = $this->Category->find('threaded',$params);

  
  $params1 = array(
'recursive' => -1,
//'fields' => 'Category.id, Category.name, Category.parent_id',
'contain' => [
				 'ChildCategory',  
            ], 			
);

$categories1 = $this->Category->find('threaded',$params1);
  
  
   $this->loadModel('Banner');	

	    $banners = $this->Banner->find('all', array(
		 	'recursive' => 0,
		//	'limit' => 50, 
			'order' => array(
				'Banner.id' => 'desc'
			),
			'conditions' => array(
			),
		));
		
 		
		$footercategories = $this->Category->find('all', array(
			'contain' => [
                'ChildCategory',    
            ],  
			
			'order' => array(
				'Category.id' => 'ASC'
			),
			'conditions' => array('Category.parent_id' => '0',
			//'Category.active' => '1'
			'Category.id' => '1'
			),
		));
		
		$footercategories1 = $this->Category->find('all', array(
			'contain' => [
                'ChildCategory',    
            ],  
			
			'order' => array(
				'Category.id' => 'ASC'
			),
			'conditions' => array('Category.parent_id' => '0',
			//'Category.active' => '1'
			'Category.id' => '2'
			),
		));
		
				function getUserIP()
{
		 if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
	}
$user_ip = getUserIP();

 $this->set(compact('user_ip'));	
  
  $home_categories = $this->Category->find('all', array(
			//'recursive' => 0,
			
			'order' => array(
				'Category.id' => 'ASC'
			),
			'conditions' => array('Category.parent_id' => '0',
			'Category.active' => '1'
			),
			'limit' => '2'
		));
   
   
		$categories_list = $categories;
		
		
		$proto = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$pageurl = $proto . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
		
		
		
		$this->set(compact('pageurl','categories','home_categories','footercategories','footercategories1','banners'));
	
				$this->loadModel('Quizes');	
	$quizescount = $this->Quizes->find('count', array(
			'recursive' => 0,
			'order' => array(
				'Quizes.id' => 'ASC'
			),
			'conditions' => array(
			'Quizes.active' => 1
					
			),
		));
		$this->loadModel('Report');	
    $quizesattempted = $this->Report->find('count', array(
			'recursive' => 0,
			'order' => array(
				'Report.id' => 'ASC'
			),
			'conditions' => array(
			'Report.user_id' =>  $this->Session->read('User.id')
					
			),
		));
        	$this->loadModel('Report');	
	$quizeswon = $this->Report->find('count', array(
			'recursive' => 0,
			'order' => array(
				'Report.id' => 'ASC'
			),
			'conditions' => array(
			'Report.user_id' =>  $this->Session->read('User.id'),
			'Report.won' => 1		
			),
		));
		
	$this->loadModel('Reward');	
    $referalcodenoti = $this->Reward->find('first', array(
			'recursive' => 0,
			'order' => array(
				'Reward.id' => 'ASC'
			),
			'conditions' => array(
			'Reward.user_id' =>  $this->Session->read('User.id')
					
			),
		));
		
        $this->set(compact('referalcodenoti','quizeswon','quizescount','quizesattempted'));	
		
		
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
		
		
	$this->loadModel('Country');

	$countries = $this->Country->find('all', array(
 			'conditions' => array(
				'Country.active' => '1'
			)
		));
	 
	 $this->set(compact('countries'));
	
	$this->loadModel('Setting');

	$setting = $this->Setting->find('first', array(
 			'conditions' => array(
				'Setting.id' => '1'
			)
		));
	 
	 
 $company_address = array(
						$setting['Setting']['address1'],
						$setting['Setting']['address2'],
						$setting['Setting']['address3']
						);					
$company_address = implode('<br>',array_filter($company_address));
$company_email   = $setting['Setting']['email'];
$company_phone   = $setting['Setting']['contact_number'];
$company_email2   = $setting['Setting']['email_contact'];
$company_phone2   = $setting['Setting']['contact_number2'];
$facebook_url    = $setting['Setting']['facebook_url'];
$twitter_url     = $setting['Setting']['twitter_url'];
$googleplus_url  = $setting['Setting']['googleplus_url'];
$linkedin_url    = $setting['Setting']['linkedin_url'];
$pinterest_url   = $setting['Setting']['pinterest_url'];
$instagram_url   = $setting['Setting']['instagram_url'];
$header_text_title = $setting['Setting']['header_text_title'];
$header_text = $setting['Setting']['header_text'];
$footer_text_title = $setting['Setting']['footer_text_title'];
$footer_text = $setting['Setting']['footer_text'];
$skype_url = $setting['Setting']['skype_url'];
$google_analytics = $setting['Setting']['google_analytics'];
$additional_css    = $setting['Setting']['additional_css'];
$company_name    = $setting['Setting']['name'];
$sitelogo        = $setting['Setting']['sitelogo'];
$extra_js    = $setting['Setting']['extra_js'];
$mobilelogo        = $setting['Setting']['mobilelogo'];
 

		$company_details = array(
								'company_name'    =>	$company_name,
								'company_address' =>	$company_address,
								'company_email'   =>	$company_email,
								'company_email2'   =>	$company_email2,
								'company_phone'   =>	$company_phone,
								'company_phone2'   =>	$company_phone2,
								'facebook_url'    =>	$facebook_url,
								'twitter_url'     =>	$twitter_url,
								'googleplus_url'  =>	$googleplus_url,
								'linkedin_url' 	  =>	$linkedin_url,
								'pinterest_url'   => 	$pinterest_url,
								'instagram_url'   =>    $instagram_url,
								'skype_url'   =>    $skype_url,
								'sitelogo'        =>	$sitelogo,
'mobilelogo'        =>	$mobilelogo
		);
		
		$this->Session->write('company_details',$company_details);
		
		$this->set(compact('company_name','company_address','company_email','company_phone2','company_phone','additional_css','extra_js','company_email2','facebook_url','twitter_url','googleplus_url','linkedin_url','pinterest_url','instagram_url','sitelogo','mobilelogo','header_text_title','header_text','footer_text_title','footer_text','skype_url','google_analytics'));

		
        $this->Auth->loginAction = ['controller' => 'users', 'action' => 'login', 'admin' => false];
        $this->Auth->loginRedirect = ['controller' => 'pages', 'action' => 'index', 'admin' => true];
        $this->Auth->logoutRedirect = ['controller' => 'pages', 'action' => 'index', 'admin' => false];
        $this->Auth->authorize = ['Controller'];

        $this->Auth->authenticate = [
            'Form' => [
                'userModel' => 'User',
                'fields' => [
                    'username' => 'username',
                    'password' => 'password'
                ],
                'scope' => [
                    'User.active' => 1,
                ]
            ]
        ];

        if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
            if($this->Session->check('Auth.User')) {
                $this->set('authUser', $this->Auth->user());
                $loggedin = $this->Session->read('Auth.User');
                $this->set(compact('loggedin'));
                $this->layout = 'admin';
            }
        } elseif(isset($this->request->params['customer']) && ($this->request->params['prefix'] == 'customer')) {
            if($this->Session->check('Auth.User')) {
                $this->set('authUser', $this->Auth->user());
                $loggedin = $this->Session->read('Auth.User');
                $this->set(compact('loggedin'));
                $this->layout = 'customer';
            }
        } else {
            $this->Auth->allow();
        }

    }

    public function isAuthorized($user) {
        if (($this->params['prefix'] === 'admin') && ($user['role'] != 'admin')) {
            echo '<a href="/users/logout">Logout</a><br />';
            die('Invalid request for '. $user['role'] . ' user.');
        }
        if (($this->params['prefix'] === 'customer') && ($user['role'] != 'customer')) {
            echo '<a href="/users/logout">Logout</a><br />';
            die('Invalid request for '. $user['role'] . ' user.');
        }
        return true;
    }


    public function admin_switch($field = null, $id = null) {
        $this->autoRender = false;
        $model = $this->modelClass;
        if ($this->$model && $field && $id) {
            $field = $this->$model->escapeField($field);
            return $this->$model->updateAll([$field => '1 -' . $field], [$this->$model->escapeField() => $id]);
        }
        if(!$this->RequestHandler->isAjax()) {
            return $this->redirect($this->referer());
        }
    }

    public function admin_editable() {

        $model = $this->modelClass;

        $id = trim($this->request->data['pk']);
        $field = trim($this->request->data['name']);
        $value = trim($this->request->data['value']);

        $data[$model]['id'] = $id;
        $data[$model][$field] = $value;
        $this->$model->save($data, false);

        $this->autoRender = false;

    }

}
