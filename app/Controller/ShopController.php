<?php
App::uses('AppController', 'Controller');
class ShopController extends AppController {

//////////////////////////////////////////////////

    public $components = [
        'Cart',
        'Paypal',
        'AuthorizeNet'
    ];

//////////////////////////////////////////////////

    public $uses = 'Product';

//////////////////////////////////////////////////

    public function beforeFilter() {
        parent::beforeFilter();
        $this->disableCache();
        //$this->Security->validatePost = false;
    }

//////////////////////////////////////////////////

    public function clear() {
        $this->Cart->clear();
       // $this->Flash->danger('All item(s) removed from your shopping cart');
        return $this->redirect('/');
    }

//////////////////////////////////////////////////

    public function add() {
		
        if ($this->request->is('post')) {

            $id = $this->request->data['Product']['id'];

         
            $productmodId = isset($this->request->data['mods']) ? $this->request->data['mods'] : null;
					
			
			$order_po      = @$this->request->data['Product']['order_po'];			 		
			 
            $product = $this->Cart->add($id,$productmodId,$order_po);
        }
        if(!empty($product)) {
			$this->Session->delete('Flash');
           $this->Flash->success($product['Product']['name'] . ' was added to your shopping cart.');
        } else {
            $this->Flash->danger('Unable to add this product to your shopping cart.');
        }
        $this->redirect($this->referer());
    }

//////////////////////////////////////////////////

 public function itemupdate() {

        if ($this->request->is('ajax')) {

            $id = $this->request->data['id'];

           
            if(isset($this->request->data['mods']) && ($this->request->data['mods'] > 0)) {
                $productmodId = $this->request->data['mods'];
            } else {
                $productmodId = null;
            }

			
			
			$order_po      = @$this->request->data['order_po'];
 			
          //  $product = $this->Cart->add($id, $quantity, $productmodId);

		 	$product = $this->Cart->add($id,$productmodId,$order_po);
						
        }
        $cart = $this->Session->read('Shop');
        echo json_encode($cart);  
        $this->autoRender = false;
    }
	
    public function xitemupdate() {

        if ($this->request->is('ajax')) {

            $id = $this->request->data['id'];

            $quantity = isset($this->request->data['quantity']) ? $this->request->data['quantity'] : null;

            if(isset($this->request->data['mods']) && ($this->request->data['mods'] > 0)) {
                $productmodId = $this->request->data['mods'];
            } else {
                $productmodId = null;
            }

            // echo $productmodId ;
            // die;

            $product = $this->Cart->add($id, $quantity, $productmodId);

        }
        $cart = $this->Session->read('Shop');
        echo json_encode($cart);
        $this->autoRender = false;
    }

//////////////////////////////////////////////////

    public function update() {
        $this->Cart->update($this->request->data['Product']['id'], 1);
    }

//////////////////////////////////////////////////

    public function remove($id = null) {
        $product = $this->Cart->remove($id);
        if(!empty($product)) {
          //  $this->Flash->danger($product['Product']['name'] . ' was removed from your shopping cart');
        }
        return $this->redirect(['action' => 'cart']);
    }

//////////////////////////////////////////////////

    public function cartupdate() {
        if ($this->request->is('post')) {
            foreach($this->request->data['Product'] as $key => $value) {
                $p = explode('-', $key);
                $p = explode('_', $p[1]);
                $this->Cart->add($p[0], $value, $p[1]);
            }
            // $this->Flash->success('Shopping Cart is updated.');
        }
        return $this->redirect(['action' => 'cart']);
    }

//////////////////////////////////////////////////

    public function cart() {
		
		

		
        $shop = $this->Session->read('Shop');
        $this->set(compact('shop'));
	
    }
 
   public function checkout() {
        $shop = $this->Session->read('Shop');
        $this->set(compact('shop'));
		
			
		
	    if(!empty($this->Session->read('User.id'))) {
				
			return $this->redirect('/shop/address');

			}
    }
 
 
     public function address() {
			
			$customer_data = $this->Session->read('customer_data');
			$this->set(compact('customer_data'));
 
			
			
        $shop = $this->Session->read('Shop');
        if(!$shop['Order']['total']) {
            return $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $this->loadModel('Order');
            $this->Order->set($this->request->data);
            if($this->Order->validates()) {
                $order = $this->request->data['Order'];
                $order['order_type'] = 'creditcard';
                $this->Session->write('Shop.Order', $order + $shop['Order']);
                return $this->redirect(['action' => 'review']);
            } else {
                $this->Flash->danger('The form could not be saved. Please, try again.');
            }
        }
        if(!empty($shop['Order'])) {
            $this->request->data['Order'] = $shop['Order'];
        }

    }
	

  

public function generateRandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


 public function orderpayment() {
	 
	 $this->layout = "ajax";
	 
       $shop = $this->Session->read('Shop');
	   
	   $user_id = $this->Session->read('User.id');
	   
	   $order_id = 'unknown_'.$user_id.$this->generateRandomString(6);
	   
        $this->Session->write('Shop.Order.order_id', $order_id);
		
        if(!$shop) {
            return $this->redirect('/');
        }
        $this->Session->write('Shop.Order.order_type', 'paypal');
       // $this->Paypal->step1($shop);
	 	
		
	  $shop = $this->Session->read('Shop');
      $this->set(compact('shop'));

    }
	
	  public function review() {

        $shop = $this->Session->read('Shop');

        if(empty($shop)) {
            return $this->redirect('/');
        }
		else {
			             //return $this->redirect('orderpayment');
						//   return $this->redirect('success');

		}
		
		 if ($this->request->is('post')) {
            $this->loadModel('Order');
            $this->Order->set($this->request->data);
            if($this->Order->validates()) {
              //  $order = $this->request->data['Order'];               
              //  $this->Session->write('Shop.Order', $order + $shop['Order']);
                return $this->redirect(['action' => 'success']);
            } else {
              //  $this->Flash->danger('The form could not be saved. Please, try again.');
            }
        }
		
		        $this->set(compact('shop'));

	}
	
 /*********************************************  Order Payment ****************************************/

 
 	public function payment() {
	
	$this->layout = 'ajax';
 	
	App::import('Vendor', 'ccavenue', array('file' => 'ccavenue' . DS . 'Crypto.php'));
				
	error_reporting(0);
	
	$merchant_data='';
	$working_key='9A4F315593979514B02A7DE053810539';//Shared by CCAVENUES
	$access_code='AVIB80FH07CH01BIHC';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	
	$this->set(compact('encrypted_data','working_key','access_code'));

 }
 
 
/*********************************************  Order Success ****************************************/


  public function success() {
		
	
	  $this->layout = "ajax";
	   	 
	App::import('Vendor', 'ccavenue', array('file' => 'ccavenue' . DS . 'Crypto.php'));
	
	
	$workingKey='9A4F315593979514B02A7DE053810539';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status_data ="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);	

	$all_response  = explode('&',$rcvdString);
		$response_hash = array();
		foreach ( $all_response as $r ) {
			$strdata  = explode('=',$r);
			$response_hash[ $strdata[0] ] = $strdata[1];
		}
	 	 
		 
		 	if(@$response_hash['order_status'] == 'Aborted') {	
	 
				$this->Flash->flash('Sorry, payment error  ,your Order could not processed, Please try again later .');
				 return $this->redirect('/shop/review');
				 exit;
		}
		
		else {
		
		}
		 	
	//$this->set(compact('response_hash'));
 	 
    $order_status_data   =  @$response_hash['order_status'];
    $tracking_id    =  @$response_hash['tracking_id'];
	$order_id       =  @$response_hash['order_id'];
	$status_message =  @$response_hash['order_id'];
	
	
			
		$this->loadModel('Order');
		
		$shop = $this->Session->read('Shop');

        if(empty($shop)) {
            return $this->redirect('/');
        }
		
		$order = $shop;
				
		$order['Order']['authorization'] = $order_status;
		$order['Order']['transaction']   = $tracking_id;
		$order['Order']['ip_address']    = $_SERVER['REMOTE_ADDR'];
		$order['Order']['order_id']      = $order_id;
		
		 
		
		//if($this->request->query['st'] == 'Completed') { 
		 	   
		if($order_status == 'Success') {	
	 
		$customer_data = $this->Session->read('customer_data');
		
		$user_id = $customer_data['User']['id'];
				 
		$order['Order']['user_id'] = $user_id;
		
		$order['Order']['status'] = 1;

 				$save = $this->Order->saveAll($order);
				
				
        if($save) {					

$order_id = $this->Order->id;  	

$this->pdf($order_id);
		
		$order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $order_id
            ]
]);
	
	
		$customer_data = $this->Session->read('customer_data');
		
		$to = $customer_data['User']['email'];

		$username = $customer_data['User']['first_name']. ' '.$customer_data['User']['last_name'];
  
        $company_details = $this->Session->read('company_details');
		
		$company_name  = $company_details['company_name']; 
		$company_email = $company_details['company_email']; 
	    $company_phone = $company_details['company_phone']; 
		$company_address = $company_details['company_address']; 

			$CustomMessageText = "Dear $username,
			<br /><br />
			<b>Your Order has been successfully placed.</b><br /> <br />";
			
			$CustomMessageText .= "<b> Please find attached Invoice for your reference.</b> <br /><br />";			
			 
			$CustomMessageText .= "<br /><br />
			To your success!
			<br><br />
			<b>$company_name <br /><br /></b> 
		 
			$company_address<br /><br />
 
			<b>Phone:</b> $company_phone <br /><br />
			<b>Email:</b>  $company_email <br /><br />
			<b>Website:</b> <a href='".Router::url('/', true)."' target='_blank'>".Router::url('/', true)."</a><br>";
								
		$CustomMessageSubject = $company_name." - Your Order has been successfully placed.";  
	
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		//$to = "vsntshrma@gmail.com"; 
		
	
		App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
	
  	    $mail = new PHPMailer();
        $mail->ContentType	= "text/html";
        $mail->From		= $company_email;  
        $mail->FromName		= $company_name;
        $mail->Host		= "localhost";
        $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');
		
	    $mail->AddBCC("vsntshrma@gmail.com", "");
		
		$filetype = "application/pdf";
									
		$invoice_id =  'Invoice-'.date('Y',strtotime($order['Order']['created'])).'-'.$order['Order']['id']; 

		$order_pdf = $invoice_id.'.pdf';

		$attachment = 'invoices/'.$invoice_id.'.pdf';		
		
		$mail->AddAttachment($attachment,$order_pdf,'base64',$filetype);
				
        $mail->Body	= $message;
        $mail->AddReplyTo("$company_email","$company_name");	 	 		 										
		
		if($mail->Send()){	 
        } else { 
        }
		
		
	/*************************** Admin Email *****************************************************/
		
		$customer_data = $this->Session->read('customer_data');
		
		$useremail = $customer_data['User']['email'];

		$username = $customer_data['User']['first_name']. ' '.$customer_data['User']['last_name'];
  
        $username = ucwords($username);
		
        $company_details = $this->Session->read('company_details');
		
		$company_name  = $company_details['company_name']; 
		$company_email = $company_details['company_email']; 
	    
			$CustomMessageText2 = "Dear Admin,
			<br /><br />
			New Order has been placed on $company_name <br />";
			
			$CustomMessageText2 .= "Following are Details : <br /><br />";			
			$CustomMessageText2 .= "Name : $username <br />";
			$CustomMessageText2 .= "Email : $useremail <br />";
			$CustomMessageText2 .= "<br /><br />";
			 
					
		$CustomMessageSubject2 = "A new Order has been placed on $company_name by $username";  
	
		$subject2 = $CustomMessageSubject2;
		$message2 = $CustomMessageText2;
 
		$to2 =  $company_email; 
	
		App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
	
  	    $mail = new PHPMailer();
        $mail->ContentType	= "text/html";
        $mail->From		= $company_email;  
        $mail->FromName		= $company_name;
        $mail->Host		= "localhost";
        $mail->Subject		= $subject2;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to2), '');
		
	    $mail->AddBCC("vsntshrma@gmail.com", "");
 	
		$filetype = "application/pdf";
									
		$invoice_id =  'Invoice-'.date('Y',strtotime($order['Order']['created'])).'-'.$order['Order']['id']; 

		$order_pdf = $invoice_id.'.pdf';

		$attachment = 'invoices/'.$invoice_id.'.pdf';		
		
		$mail->AddAttachment($attachment,$order_pdf,'base64',$filetype);
				
        $mail->Body	= $message2;
        $mail->AddReplyTo("$company_email","$company_name");	 	 		 										
		
		 $mail->Send();
		
	/*************************** Admin Email *****************************************************/

				}
		
		$order_id = $this->Order->id;  	

 
        $shop = $this->Session->read('Shop');
        $this->Cart->clear();
		 $shop = $this->Session->read('Shop');
		 
 
 		$this->loadModel('Order');
			
			$order_data = $this->Order->find('first', [
			'contain' => array('OrderItem.Product'),
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $order_id
            ]
        ]);
				
		 
       				$this->layout = 'default';

	    $this->set(compact('order_data'));
 
		$this->Flash->success('Thank you for your Order.',['clear' => true]);
		
        $this->set(compact('shop'));
				 
 
     }
				
				else { 
				 
				$this->Flash->flash('Sorry, payment error  ,your Order could not processed, Please try again later .');
				 return $this->redirect('/shop/review');
				            
				
				}
				
			 

    }

	
/*********************************************  Order Success ****************************************/




/*********************************************  PDF Generate  ****************************************/

public function pdf($id=null) {
 
 $this->layout = 'ajax';

App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));
  
$this->loadModel('Order');

$order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id
            ]
]);
		
$this->set(compact('order'));
  
  
  $company_details = $this->Session->read('company_details');
		
$company_name  = $company_details['company_name']; 
$company_email = $company_details['company_email']; 
$company_phone = $company_details['company_phone']; 
$company_address = $company_details['company_address']; 
    
	
	  $view = new View(null, false);
    $view->set(compact('order','company_name','company_email','company_phone','company_address'));
    $view->viewPath = 'Shop';
	$view->layout = 'ajax';
     $template = $view->render('invoice', 'ajax');
	 
$dompdf = new DOMPDF();
 
$dompdf->load_html($template);

$dompdf->set_paper('A4', 'landscape');

$dompdf->render();

  $invoice_id =  'Invoice-'.date('Y',strtotime($order['Order']['created'])).'-'.$order['Order']['id']; 
  	
  file_put_contents('invoices/'.$invoice_id.'.pdf', $dompdf->output());		   
  		  
 }

 
/*************************************************************************************/

}
