<?php
App::uses('AppController', 'Controller');
/**
 * Enquiries Controller
 *
 * @property Creditenquiry $Creditenquiry
 * @property PaginatorComponent $Paginator
 */
class CreditenquiriesController extends AppController {

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
 function getList() {
	 
	 return $this->Creditenquiry->find('list');
	 } 
 
	public function add() {
		 $this->layout = "ajax";
		 
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
				$email = $this->request->data['email'];					
				$business_since = $this->request->data['business_since'];	
				
				$accept_back_orders = $this->request->data['accept_back_orders'];	
				
				$name_of_owner1 = $this->request->data['name_of_owner1'];	
				$name_of_owner2 = $this->request->data['name_of_owner2'];	
				$name_of_owner3 = $this->request->data['name_of_owner3'];	
				$organization_type = $this->request->data['organization_type'];	
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
			 
			if($email) { 
			$CustomMessageText .= "<br />Email : $email <br />";
			}	
			 
			if($email) { 
			$CustomMessageText .= "<br />Email : $email <br />";
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
			Email Services by Digidiya.";
					
		$CustomMessageSubject = $company_name." - Credit Application filled by $business_name.";  
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		$to = "info@digidiya.com"; //$company_email; 
		 
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
		 
 
	public function thanks() {
		 $this->layout = "perfectautodeals";
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		$creditenquiries = $this->Creditenquiry->find('all', array(
			'recursive' => 0,
			'order' => array(				
			),
			'conditions' => array(			
			),
		));		  			 
		$this->set(compact('creditenquiries'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Creditenquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$options = array('conditions' => array('Creditenquiry.' . $this->Creditenquiry->primaryKey => $id));
		$this->set('enquiry', $this->Creditenquiry->find('first', $options));
	}

public	function pdf_create($output, $filename='', $stream=TRUE) 
{
 	
	App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));			 

// $this->layout = $this->autoRender = false;
   // $this->response->header(array('Content-type' => 'application/pdf'));

   //Code for generating pdf data similar to above

   $dompdf = new DOMPDF();
    $dompdf->set_paper = 'A4';
    $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
    $dompdf->render();
    file_put_contents(APP . 'webroot' . DS . 'pdf' . DS .'filename.pdf');
	exit;
	
}

public function htmltopdf($html= null,$id=null){
	
	$this->layout = "";
	
        App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));
        
		$html2 =
        '<html><body>'.
        '<p>Put your html here, or generate it with your favourite '.
        'templating system.</p>'.
        '</body></html>';
		
		
		
        $dompdf = new DOMPDF();
        $papersize = 'legal';
        $orientation = 'landscape';
		
        $dompdf->load_html($html);
		
        $dompdf->set_paper($papersize, $orientation);
        $dompdf->render();
         $dompdf->output();
		
        $output = $dompdf->output();
        file_put_contents(WWW_ROOT . 'pdf/'.'fmf-application-for-credit-form-'.$id.'.pdf', $output);
    }
	
	public function admin_print($id = null) {
		$this->layout = 'ajax';
	
		
		if (!$this->Creditenquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$options = array('conditions' => array('Creditenquiry.' . $this->Creditenquiry->primaryKey => $id));
		$this->set('enquiry', $this->Creditenquiry->find('first', $options));
		
		
	$html = $this->render('admin_print');
	$this->htmltopdf($html,$id);
	 		
 		 
	}
/**
 * admin_send method
 *
 * @return void
 */
	public function admin_send($id = null) {
		 
		 	if (!$this->Creditenquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$options = array('conditions' => array('Creditenquiry.' . $this->Creditenquiry->primaryKey => $id));
		$this->set('enquiry', $this->Creditenquiry->find('first', $options));
		
		if ($this->request->is('post')) {
			 
			if ($this->Creditenquiry->Emailsent($this->request->data)) {
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
			$this->Creditenquiry->create();
			if ($this->Creditenquiry->save($this->request->data)) {
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
		if (!$this->Creditenquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Creditenquiry->save($this->request->data)) {
				$this->Session->setFlash(__('The enquiry has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Creditenquiry.' . $this->Creditenquiry->primaryKey => $id));
			$this->request->data = $this->Creditenquiry->find('first', $options);
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
		$this->Creditenquiry->id = $id;
		if (!$this->Creditenquiry->exists()) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Creditenquiry->delete()) {
			$this->Session->setFlash(__('The enquiry has been deleted.'));
		} else {
			$this->Session->setFlash(__('The enquiry could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
