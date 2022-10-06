<?php

App::uses('AppController', 'Controller');

/**
 * Enquiries Controller
 *
 * @property Enquiry $Enquiry
 * @property PaginatorComponent $Paginator
 */
 
class EnquiriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	
	/**
 * enquiry_add method
 *
 * @return void
 */
  
	public function add() {
		 $this->layout = "ajax";
		 
		    if ($this->request->is('ajax')) {
			   
			   $this->request->data['formrequest']  = 'ajax';
		   }
		   else {
			   
			   $this->request->data['formrequest']  = 'post';
		   }
		   
		if ($this->request->is('post')) {
			
			$this->request->data['ip_address'] = $_SERVER['REMOTE_ADDR'];
			$this->Enquiry->create();
			
			if ($this->Enquiry->save($this->request->data)) {
				
					if($this->request->data['formrequest'] == 'post') { die; }

							
		
			$enquiry_for     = @$this->request->data['enquiry_for'];
			$contact_name    = @$this->request->data['name'];
			
			$contact_last_name = @$this->request->data['last_name'];
		 						
			$contact_email   = @$this->request->data['email'];
			$contact_phone   = @$this->request->data['phone'];
			$contact_mobile  = @$this->request->data['mobile'];
			$contact_company = @$this->request->data['company'];	
			$contact_address = @$this->request->data['address'];			
			$contact_message = @$this->request->data['message'];		
			$services        = @$this->request->data['services'];		
			$company_details = @$this->Session->read('company_details');
			$company_name    = $this->request->data['name']; 
			$company_email   = @$company_details['company_email']; 	   

			if(empty($contact_name)) { die; }
			
			$page_url        = @$this->request->data['page_url']; 
				
			$CustomMessageText = "<br><br />Name : $contact_name <br />";
			
			if($contact_last_name) { 
			$CustomMessageText = "<br />Name : $contact_name $contact_last_name <br />";	
			}
			
			$CustomMessageText .= "<br />Email Address : $contact_email <br />"; 					
				
				 
			if($contact_phone) { 
			$CustomMessageText .= "<br />Phone : $contact_phone <br />";	
			}
			
			if($contact_mobile) { 
			$CustomMessageText .= "<br />Phone : $contact_mobile <br />";	
			}	
			
			if($services) { 
			$CustomMessageText .= "<br />Services : $services <br />";	
			}					
			
			if($contact_company) { 
			$CustomMessageText .= "<br />Company : $contact_company <br />";
			}	
			if($contact_address) { 
			$CustomMessageText .= "<br />Address : $contact_address <br />";
			}	
			if($contact_message) { 
			$CustomMessageText .= "<br />Message : $contact_message <br />";
			}		
			
			$CustomMessageText .= "<br />Page Url : $page_url <br /> <br /> <br />";	
			
			$CustomMessageSubject = "Enquiry from www.engagegeeks.com";  

						
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		$to =  "info@engagegeeks.com"; //$company_email; 
		 
		$company_email = "info@engagegeeks.com";	
		 
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
      
        $mail->From		= $company_email;
        $mail->FromName		= $company_name;
      
        $mail->Subject  = $enquiry_for;
        $mail->AltBody		= "";
				
        $mail->AddAddress(trim($to), '');
	   
	    $mail->AddBCC("khanmohan1@gmail.com");
			 		

        $mail->Body	= $message;
        $mail->AddReplyTo("$company_email","$company_name");
	 	 		
		$mail->Send();
		
		die;
				 
		} 
		else {
			die;
			 
		}
		}
	}
		 
		 
 
	public function thanks() {
		
	}

/**
 * admin_index method
 *
 * @return void
 */
	
	public function admin_index() {
	 	 
		
 		
		$enquiries = $this->Enquiry->find('all', array(
		'order' => array(
				'Enquiry.id' => 'DESC'
			),
			 			 
		));
		
		$this->set(compact('enquiries'));

		}
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
		$this->set('enquiry', $this->Enquiry->find('first', $options));
	}

	
	
/**
 * admin_send method
 *
 * @return void
 */
	public function admin_send($id = null) {
		 
		 	if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
		$this->set('enquiry', $this->Enquiry->find('first', $options));
		
		if ($this->request->is('post')) {
			 
			if ($this->Enquiry->Emailsent($this->request->data)) {
				$this->Session->setFlash(__('The enquiry responded successully.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enquiry could not be responded. Please, try again.'));
			}
		}
	}
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		 
		if ($this->request->is('post')) {
			$this->Enquiry->create();
			if ($this->Enquiry->save($this->request->data)) {
				$this->Session->setFlash(__('The enquiry has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Enquiry->save($this->request->data)) {
				$this->Session->setFlash(__('The enquiry has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
			$this->request->data = $this->Enquiry->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Enquiry->id = $id;
		if (!$this->Enquiry->exists()) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Enquiry->delete()) {
			$this->Session->setFlash(__('The enquiry has been deleted.'));
		} else {
			$this->Session->setFlash(__('The enquiry could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}