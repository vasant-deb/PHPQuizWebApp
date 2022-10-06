<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {

var $components = array('Email');


////////////////////////////////////////////////////////////

    public function beforeFilter() {
        
        parent::beforeFilter();
        $this->Auth->allow(
		'login',
		'customer_login',
		'customer_forgot_password',
		'customer_register',
		'customer_myaccount',
		'customer_changepassword',
		'customer_orderhistory',
		'customer_orderdetails',
		'customer_logout');
    }

////////////////////////////////////////////////////////////


function __sendPasswordEmail($user, $password) {
   if ($user === false) {
     debug(__METHOD__." failed to retrieve User data for user.id: {$user['User']['id']}");
     return false;
  }
  $this->set('user', $user['User']);
  $this->set('password', $password);
  $to = $user['User']['email'];
  
  $username = $user['User']['first_name']. ' '.$user['User']['last_name'];
  
        $company_details = $this->Session->read('company_details');
		
		$company_name  = $company_details['company_name']; 
		$company_email = $company_details['company_email']; 
	    
			$CustomMessageText = "Dear $username,
			<br /><br/>
			Your new password is  $password  <br />";
			 
			 
			$CustomMessageText .= "<br /><br />
			Note: You can change your password later in your dashboard.
			<br>
			$company_name.";
					
		$CustomMessageSubject = $company_name." - Your new password";  
	
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		//$to = "vsntshrma@gmail.com"; 
	
	
       
      
      
		
		
App::import('Vendor', 'phpmailersecure', array('file' => 'phpmailersecure' . DS . 'PHPMailerAutoload.php'));
$mail = new PHPMailer;
$mail->ContentType	= "text/html";
//$mail->SMTPDebug = 3;                               // Enable verbose debug output


$mail->isSMTP();                                     // Set mailer to use SMTP
$mail->Host = 'mail.engagegeeks.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@engagegeeks.com';                 // SMTP username
$mail->Password = 'd.Fpdn6B%6Yt';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;   
 $mail->From		= "info@engagegeeks.com";  
        $mail->FromName		= "Engage Geeks";		
	    $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');
        $mail->Body	= $message;
        $mail->AddReplyTo("$company_email","$company_name");
		$mail->Send();	
        $this->Session->setFlash('A new password has been sent to your email address.');

  return true;
}

    public function login() {

        // echo AuthComponent::password('admin');
			$this->layout = "login";

        if ($this->request->is('post')) {
            if($this->Auth->login()) {

                $this->User->id = $this->Auth->user('id');
                $this->User->saveField('logins', $this->Auth->user('logins') + 1);
                $this->User->saveField('last_login', date('Y-m-d H:i:s'));

                if ($this->Auth->user('role') == 'customer') {
                    return $this->redirect([
                        'controller' => 'users',
                        'action' => 'dashboard',
                        'customer' => true,
                        'admin' => false
                    ]);
                } elseif ($this->Auth->user('role') == 'admin') {
                    return $this->redirect([
                        'controller' => 'users',
                        'action' => 'dashboard',
                        'manager' => false,
                        'admin' => true
                    ]);
                } else {
                    $this->Flash->danger('Login is incorrect');
                }
            } else {
                $this->Flash->danger('Login is incorrect');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function logout() {
        $this->Flash->flash('Good-Bye');
        $_SESSION['KCEDITOR']['disabled'] = true;
        unset($_SESSION['KCEDITOR']);
        return $this->redirect($this->Auth->logout());
    }

////////////////////////////////////////////////////////////

function createTempPassword($len) {
   $pass = '';
   $lchar = 0;
   $char = 0;
   for($i = 0; $i < $len; $i++) {
     while($char == $lchar) {
       $char = rand(48, 109);
       if($char > 57) $char += 7;
       if($char > 90) $char += 6;
     }

     $pass .= chr($char);
     $lchar = $char;
   }

   return $pass;
}

public function customer_forgot_password() {
	 			$this->layout = "default";
				
	  if ($this->request->is('post') && $this->request->data['mode'] == 'forgot') {
	 	
     $this->User->contain();
     $user = $this->User->findByEmail($this->data['email']);
 	
     if($user) {
       $user['User']['tmp_password'] = $this->createTempPassword(7);
       $user['User']['password'] = $user['User']['tmp_password'];
       $user['User']['user_password']= $user['User']['tmp_password'];
       if($this->User->save($user, false)) {
		
		$this->Session->delete('Flash');

         $this->__sendPasswordEmail($user, $user['User']['tmp_password']);
           $this->Flash->success('An email has been sent with your new password.');
         //$this->redirect($this->referer());
       }
     } else {
		
		$this->Session->delete('Flash');

         $this->Flash->danger('No user was found with the submitted email address.');
     }
   }
 	}

	
	
	public function registeremail($user) {
				 
	
		App::import('Vendor', 'phpmailersecure', array('file' => 'phpmailersecure' . DS . 'PHPMailerAutoload.php'));
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                     // Set mailer to use SMTP
$mail->Host = 'mail.engagegeeks.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@engagegeeks.com';                 // SMTP username
$mail->Password = 'd.Fpdn6B%6Yt';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;   

		$otpcode=$user['User']['address2'];	
		  $to = $user['User']['email'];
			
		//$login_username1 = $user['User']['username'];		
		$login_username = $user['User']['email'];
		$login_password = $user['User']['password'];
  
        $username = $user['User']['first_name']. ' '.$user['User']['last_name'];
 // $lid=$id = $this->Users->find()->select(['id'])->last();
//$l_username=$user['User']['first_name'].$lid;

        $company_details = $this->Session->read('company_details');
	//	$l_username=$user['User']['first_name'].$lid;
        $l_username=$user['User']['username'];;
		$company_name  = $company_details['company_name']; 
		$company_email = $company_details['company_email']; 
	    
			$CustomMessageText = "Dear $username,
			<br /><br />
			Thank you for registering with $company_name <br /><br />";
			
			$CustomMessageText .= "Your Login Details are as follows :<br />";
			 			
			$CustomMessageText .= "User Name : $l_username <br />";
			
			$CustomMessageText .= "Email : $login_username <br />";
			$CustomMessageText .= "Password  : $login_password <br />";
			$CustomMessageText .= "OTP  : $otpcode <br /><br />";
						
			$CustomMessageText .= "<br /><br />
			To your success!
			<br>
			$company_name.";
					
		$CustomMessageSubject = $company_name." - Thank you for registering with ".$company_name;  
	
		$subject = $CustomMessageSubject;
		 $message = $CustomMessageText;
		
        $mail->ContentType	= "text/html";
          $mail->From		= "info@engagegeeks.com";
        $mail->FromName		= "Engage Geeks";
       
        $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');
         $mail->AddBCC("khanmohan1@gmail.com","info@engagegeeks.com");
         $mail->Body	= $message;
        $mail->AddReplyTo("info@engagegeeks.com","Engage Geeks");
	 	 		
		$mail->Send();
		 
		 
		 
		

		
	/*************************** Admin Email *****************************************************/
	
		 return true;
		
	}
	
	
 public function customer_register() {
	 
	 			$this->layout = "default";

				        $shop = $this->Session->read('Shop');

	  if ($this->request->is('post') && $this->request->data['mode'] == 'register') {
		  
		  
		    $lid=$this->User->find('count', array(
    'fields' => 'DISTINCT id'
));
$lid=$lid+1;

$firstname2=strtolower($this->request->data['User']['first_name']);
          $l_username=$string = str_replace(' ', '',$firstname2).$lid;
		  
		 
		  $this->request->data['User']['role']   = 'customer';
		  $this->request->data['User']['active'] = '1';
		  $this->request->data['User']['user_password'] = $this->request->data['User']['password'];
		   $this->request->data['User']['address2'] = mt_rand(1000,9999);
		   $this->request->data['User']['username']=$l_username;
            $this->User->create();
            if ($this->User->save($this->request->data)) {
				
				$this->registeremail($this->request->data);

                $this->Flash->flash('You have successfully registered.');
				$customer_data = $this->User->find('first', array('order' => 'User.id DESC', 'conditions' => array('email' => $this->request->data['User']['email'])));

 
			  
		if ($customer_data['User']['password'] == Security::hash($this->request->data['User']['password'], 'sha1', true)) {

					  
		$this->Session->write('customer_data', $customer_data);

		$this->Session->write('User.id', $customer_data['User']['id']);
		$this->Session->write('User.name', $customer_data['User']['name']);
		
		}
			 
		if(@$this->Session->read('custom_purl') != '') {	
		 
		 return $this->redirect($this->Session->read('custom_purl'));
		 
		}	 
 			 
					 if($this->Session->read('Shop')) {

				return 	$this->redirect('/shop/address');
			}
			else {
				 $this->Flash->success('Thank you for registring with us.');
				return 	$this->redirect('/customer/myaccount');
			}



            } else {
                $this->Flash->flash('The user could not be saved. Please, try again.');
            }
        }
	 
    }

 public function customer_login() {
	  clearCache($params = array('customer/login'), $type = 'views', $ext = '');
clearCache(); 
	     if(@$this->Session->read('User.id') != '') {			
			return 	$this->redirect('/customer/myaccount');
		 }
	 
	  
	 			$this->layout = "default";

				        $shop = $this->Session->read('Shop');

	   
	
	  if ($this->request->is('post') && $this->request->data['mode'] == 'login') {

 	  
		App::uses('Sanitize', 'Utility');
		$clean = new Sanitize();
		$clean->clean($_POST);

		$customer_data = $this->User->find('first', array('order' => 'User.id DESC', 'conditions' => array('email' => $this->request->data['email'])));

 if(!empty($customer_data)){
			  
		if ($customer_data['User']['password'] == Security::hash($this->request->data['password'], 'sha1', true)) {

					  
		$this->Session->write('customer_data', $customer_data);

		$this->Session->write('User.id', $customer_data['User']['id']);
		$this->Session->write('User.name', $customer_data['User']['name']);
		$this->Session->write('User.email', $customer_data['User']['email']);
		$this->Session->write('User.phone', $customer_data['User']['phone']);
		 
		 
		  
		if(@$this->Session->read('custom_purl') != '') {	
		 
		 return $this->redirect($this->Session->read('custom_purl'));
		 
		}	 
		
		 if($this->Session->read('Shop')) {
		 				return 	$this->redirect('/shop/cart');
		 }
else {
	return 	$this->redirect('/customer/myaccount');
}
		
		} else {
	
    	$this->Session->delete('Flash');

		$this->Flash->danger('Login error. Check your email and/or password!');

		}
 }

	  }
    }

	
	 public function customer_changepassword() {

    	 $this->layout = "default";

		 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}			
		
	
        if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['id'] = $this->Session->read('User.id');

			
            if ($this->User->save($this->request->data)) {
                $this->Flash->flash('Your Password has been updated successfully.');
						$this->Session->write('customer_data', $this->User->read(null, $this->Session->read('User.id')));

             		//  return $this->redirect('/customer/myaccount');

            } else {
                $this->Flash->flash('The Profile could not be updated. Please, try again.');
            }
        } 
		
		 $customer_data = $this->Session->read('customer_data');
         $this->set(compact('customer_data'));

 
    }
	
	
	  public function customer_myaccount() {

    	 $this->layout = "default";

		 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}		
			
		$this->request->data['id'] = $this->Session->read('User.id');
		$id=$this->Session->read('User.id');
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user_details = $this->User->find('first', $options);
	
		$filename = $user_details['User']['image'];
		
		
	
	    $service_slug= $user_details['User']['first_name'];
		
        if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['id'] = $this->Session->read('User.id');
			
				
			 if(!empty($this->data['User']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['User']['image'], 'img-'.$service_slug,'profiles/');  
					}
					
				
			$this->request->data['User']['image'] = $filename;
			 if(empty($this->data['User']['country']))
                    {
						$country=$user_details['User']['country'];
						$this->request->data['User']['country'] = $country;
					}
					if(empty($this->data['User']['state']))
                    {
							$state=$user_details['User']['state'];
						$this->request->data['User']['state'] = $state;
					}
			if(empty($this->data['User']['city']))
                    {
							$city=$user_details['User']['city'];
						$this->request->data['User']['city'] = $city;
					}
			
			
            if ($this->User->save($this->request->data)) {
                $this->Flash->flash('Your Profile has been updated successfully.');
						$this->Session->write('customer_data', $this->User->read(null, $this->Session->read('User.id')));

             		  return $this->redirect('/customer/myaccount');

            } else {
                $this->Flash->flash('The Profile could not be updated. Please, try again.');
            }
        } 
		
		 $customer_data = $this->Session->read('customer_data');
         $this->set(compact('customer_data'));

    }
	
	
	
	
	 public function customer_logout() {
		 header('pragma: no-cache'); 
    header('Cache-Control: no-cache, must-revalidate');
    $this->response->disableCache();
		$this->layout = "default";

		$this->Session->write('customer_data', '');

		$this->Session->write('User.id', '');
		$this->Session->write('User.name', '');
        $this->Session->write('Shop','');
      $this->Session->delete('customer_data');
    $this->Session->delete('Auth.User');
    $this->Session->delete('User');

		return 	$this->redirect('/');

    }
	
 	
 public function customer_orderdetails($id) {
	 
	 	 	$this->layout = "default";
					
			$this->loadModel('Order');
			
			$order_data = $this->Order->find('first', [
			'contain' => array('Product'),
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id
            ]
        ]);
				
		if (empty($order_data)) {
            return $this->redirect('/customer/myaccount');
        }
       		
	    $this->set(compact('order_data'));

	}

    public function customer_orderhistory() {
		
			 			$this->layout = "default";

		
		 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');

			}
		
		    $this->loadModel('Order');
			
			$order_data = $this->Order->find('all',
			array(			
 			'conditions' => array(
				'Order.user_id' => $this->Session->read('User.id'),
			),
			'order' => array(
                    'Order.created' => 'desc'
                ),
		));
		
 		
	        $this->set(compact('order_data'));

					
    }



    public function customer_dashboard() {
    }

 

    public function admin_dashboard() {
		
		$this->loadModel('Order');
		
		$orders = $this->Order->find('all', [   
		'recursive' => 1,
			'contain' => [
                'Product',    
				
            ],         
           
            
			'order' => array(
                    'Order.created' => 'desc'
                ),
			//'limit' => 6
        ]); 
		$this->set(compact('orders'));

		$total_orders = $this->Order->find('count');
		
		$this->loadModel('Enquiry');					 
		$total_enquiries = $this->Enquiry->find('count');
		
		$this->loadModel('Product');					 
		$total_products = $this->Product->find('count');
		
		$this->loadModel('User');					 
		$total_users = $this->User->find('count');
		
		$this->set(compact('total_orders','total_enquiries','total_products','total_users'));
    }

 
 
	 public function Xadmin_index() { 	
   
	   $id = 1;		
	   $this->User->id = $id;	
	   
	   if (!$this->User->exists()) {		
			throw new NotFoundException('Invalid user');		
	   }	
	   if ($this->request->is('post') || $this->request->is('put')) {	
	   if ($this->User->save($this->request->data)) {			
			$this->Session->setFlash('Password changed success!');			
			$this->redirect(array('action' => 'index'));			
	   } else {		
			$this->Session->setFlash('The Password could not be saved. Please, try again.');		
	   }	
	   } 
	   else {	
	   $this->request->data = $this->User->read(null, $id);	
	   }
	}
	

  

    public function admin_index() {
  	
		$users = $this->User->find('all', array(
		 	'recursive' => 0,	
			'order' => array(
				'User.id' => 'desc'
			),
			'conditions' => array(
			'User.id != 1',
			),
		));
				
		$this->set(compact('users'));
    }
	
	 public function X2admin_index() { 	
   
	   $id = 1;		
	   $this->User->id = $id;	
	   
	   if (!$this->User->exists()) {		
			throw new NotFoundException('Invalid user');		
	   }	
	   if ($this->request->is('post') || $this->request->is('put')) {	
	   if ($this->User->save($this->request->data)) {			
			$this->Session->setFlash('Password changed success!');			
			$this->redirect(array('action' => 'index'));			
	   } else {		
			$this->Session->setFlash('The Password could not be saved. Please, try again.');		
	   }	
	   } 
	   else {	
	   $this->request->data = $this->User->read(null, $id);	
	   }
	}
	
////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        $this->set('user', $this->User->read(null, $id));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->flash('The user has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The user could not be saved. Please, try again.');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->flash('The user has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The user could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_password($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['User']['user_password'] = $this->request->data['User']['password'];

            if ($this->User->save($this->request->data)) {
                $this->Flash->flash('The user has been saved');
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The user could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->User->delete()) {
            $this->Flash->flash('User deleted');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->flash('User was not deleted');
        return $this->redirect(['action' => 'index']);
    }
    
    
    
    
    	public function verify() {
    	    
		 $this->layout = "ajax";
		 
		    if ($this->request->is('ajax')) {
			   
			   $this->request->data['formrequest']  = 'ajax';
		   }
		   else {
			   
			   $this->request->data['formrequest']  = 'post';
		   }
		   
		if ($this->request->is('post')) {
			
	$id=$this->request->data['vid'];
	$vcode=	$this->request->data['vcode'];
		$userscount = $this->User->find('count', array(
		 	'recursive' => 0,	
			'order' => array(
				'User.id' => 'desc'
			),
			'conditions' => array(
			'User.id' => $id,
			'User.address2' =>$vcode
			),
		));
		$user=	$this->User->find('first', array(
		 	'recursive' => 0,	
			'order' => array(
				'User.id' => 'desc'
			),
			'conditions' => array(
			'User.id' => $id
			),
		));	
		$this->set(compact('userscount','user'));
		if($userscount=="1"){
		    $this->request->data['User']['country_id']=1;
	        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            
            	$this->loadModel('Reward');
            $this->request->data['Reward']['user_id']=$id;
             $this->request->data['Reward']['code']=$user['User']['username'];
            
            $this->Reward->save($this->request->data);
            
            
            
            if ($this->User->save($this->request->data)) {
               echo "Verified (Plz Refresh the page)";
               
                die;
            } else {
                $this->Flash->flash('The user could not be saved. Please, try again.');
                die;
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            die;
        }	

		}
		else{
		    
		    echo "OTP Mismatched";
		    die;
		}
		}
	}

////////////////////////////////////////////////////////////

}
