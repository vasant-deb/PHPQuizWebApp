<?php
App::uses('AppController', 'Controller');
class OrdersController extends AppController {

////////////////////////////////////////////////////////////

    public function admin_index() {

        $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = [
            'Order' => [
                'recursive' => -1,
                'contain' => [
				'Product', 
                ],
                'conditions' => [
                ],
                'order' => [
                    'Order.created' => 'DESC'
                ],
                'limit' => 20,
                'paramType' => 'querystring',
            ]
        ];
        $orders = $this->Paginator->paginate();

        $this->set(compact('orders'));
    }

////////////////////////////////////////////////////////////

public function freewebsitepackage() {
    clearCache($params = array('freewebsitepackage'), $type = 'views', $ext = '.html');
clearCache(); 

  if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}	
			
			$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'free-website-package'
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
    public function airplanewebsitepackage() {
 
          if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
				$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'airplane-website-package'
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
      public function thankyou() {
 
        
				$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'thank-you'
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
    
    

    
    
 public function jetwebsitepackage() {

        if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
				$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'jet-website-package'
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
     public function rocketwebsitepackage() {

        if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
				$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'rocket-website-package'
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
     public function ufowebsitepackage() {
	$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'ufo-website-package'
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
      public function ecommercewebsitepackage() {
 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
				$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'ecommerce-website-package'
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

public function pdf($id=null) {
 
$this->layout = "ajax";

App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));
  
//require_once(“pdf-template/template.php”);

$order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id
            ]
]);
		
$this->set(compact('order'));
  
  $template = $this->render('admin_invoice'); 
 

$dompdf = new DOMPDF();
 
$dompdf->load_html($template);

$dompdf->set_paper('A4', 'landscape');

$dompdf->render();

//$dompdf->stream('invoice.pdf');

$invoice_id =  'asterisk-serve-'.date('Y',strtotime($order['Order']['created'])).'-'.$order['Order']['id']; 
  $output = $dompdf->output();
    //    file_put_contents('pdf/'.$invoice_id.'.pdf', $output);
		
		   file_put_contents('pdf/'.$invoice_id.'.pdf', $output);
		   
		   $dompdf->stream($invoice_id.'.pdf');
		   
exit;


	 $html =
        '<html><body>'.
        '<p>Put your html here, or generate it with your favourite '.
        'templating system.</p>'.
        '</body></html>';
		
		 $order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id
            ]
        ]);
	     $html = $this->render('admin_invoice');
	 
        $dompdf = new DOMPDF();
        $papersize = 'A4';
        $orientation =  'landscape';
        $dompdf->load_html($html);
        $dompdf->set_paper($papersize, $orientation);
        $dompdf->render();
         $dompdf->output();
        $output = $dompdf->output();
     
	    file_put_contents(APP . 'webroot' . DS . 'invoice' . DS .'asterisk-serve-invoice-'.$id.'.pdf',$output);
	
		return true;
		  
 }

 
 
	  public function admin_invoice($id = null) {
		  $this->layout = "ajax";
		  
        $order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id
            ]
        ]);
		
        if (empty($order)) {
            return $this->redirect(['action' => 'index']);
        }
		
        $this->set(compact('order'));
		
		$this->pdf($id);	
		
	 	//return $this->redirect($this->referer());
		 
		
    }
	
    public function admin_view($id = null) {
        $order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id,
            ]
        ]);
	
		$order_item = $this->Order->find('all', [   
'recursive' => 1,
			'contain' => [
                'Product',    
				
            ],         
            'conditions' => [
                'Order.product_id' => $order['Order']['product_id'],
				
            ],
            
			'limit' => 1
        ]); 
				
		
        if (empty($order)) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('order','order_item'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException('Invalid order');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Order->save($this->request->data)) {
                $this->Flash->flash('The order has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The order could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Order->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException('Invalid order');
        }
        if ($this->Order->delete()) {
            $this->Flash->flash('Order deleted');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->flash('Order was not deleted');
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////

public function buynow()

{
          if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
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
			
if($isverified['User']['country_id']==0){
    
 echo "<script>alert('Plz Verify Account');window.location.href='/customer/myaccount';</script>";   
}

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included

App::import('Vendor', 'config_paytm', array('file' => 'PaytmKit/lib/config_paytm.php'));
App::import('Vendor', 'encdec_paytm', array('file' => 'PaytmKit/lib/encdec_paytm.php'));

$checkSum = "";
$paramList = array();


$ORDER_ID = $this->request->data['Order']['ORDER_ID'];
$CUST_ID = $this->request->data['Order']['CUST_ID'];
$INDUSTRY_TYPE_ID = $this->request->data['Order']['INDUSTRY_TYPE_ID'];
$CHANNEL_ID =  $this->request->data['Order']['CHANNEL_ID'];
$TXN_AMOUNT = $this->request->data['Order']['subtotal'];





	  $YOUR_CALLBACK_URL="https://www.engagegeeks.com/order-success.html"; 
			
			
			
			
// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = $YOUR_CALLBACK_URL;




/*$paramList["MSISDN"] = $this->request->data['Order']['mobile'];//Mobile number of customer
$paramList["EMAIL"] = $this->request->data['Order']['email']; //Email ID of customer
/*$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //
  $payu['surl'] = Router::url('/bookings/status/pass/'.$bookingId, true);   // Success Url
  $payu['furl'] = Router::url('/bookings/status/fail/'.$bookingId, true);   // Fail Url
  $payu['curl'] = Router::url('/bookings/status/cancel/'.$bookingId, true); // Cancel Url

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

if ($this->request->is('post')) {
    	
			
	
	$order_json = array ( 
      
    // Every array will be converted 
    // to an object 
    array( 
        "first_name" => $this->request->data['Order']['first_name'], 
        "subtotal" => $this->request->data['Order']['subtotal'],
        "title" => $this->request->data['Order']['title'], 
        "email" => $this->request->data['Order']['email'],
        "user_id" => $this->request->data['Order']['user_id'], 
        "product_id" => $this->request->data['Order']['product_id'],
        "order_id" => $ORDER_ID
    )
); 
  
// Function to convert array into JSON 
$order_json= json_encode($order_json);
		
    	}
$this->set(compact('paramList'));
$this->set(compact('checkSum'));
 $this->set(compact('ORDER_ID'));
 App::Import("Session");
$session = new CakeSession(); 
$session->write('checkSum', $checkSum);
$session->write('paramList', $paramList);
$session->write('orderjson', $order_json);
}
  
    public function failed() {
          if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
        
    
   
        
    }
  
      public function OrderSuccess() {
           if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/login');
			}
App::Import("Session");
$session = new CakeSession();       
$checkSum= $session->read('checkSum');
$paramList=$session->read('paramList');
$orderjson=$session->read('orderjson'); 
			 if(empty($paramList || $checkSum || $orderjson)) {
				
				        return $this->redirect('/customer/login');
			}





				$this->loadModel('Sitepage');	
   
    $page = $this->Sitepage->find('first', array(
			'recursive' => 0,
			'order' => array(
				
			),
			'conditions' => array(
			'Sitepage.slug' => 'order-success'
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
      
      
      
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included

App::import('Vendor', 'config_paytm', array('file' => 'PaytmKit/lib/config_paytm.php'));
App::import('Vendor', 'encdec_paytm', array('file' => 'PaytmKit/lib/encdec_paytm.php'));
      
  $paramList["CHECKSUMHASH"] = urlencode($checkSum);

 $post_data = json_encode($paramList, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw.paytm.in/order/status";

/* for Production */
// $url = "https://securegw.paytm.in/order/status";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  
$response = curl_exec($ch);
curl_close($ch);
// print_r($response);
$response=json_decode($response, true);

 $trans_status=  $response["STATUS"];
 $trans_id=  $response['TXNID'];



  
      
     if($trans_status=="TXN_SUCCESS"){
         
         //	App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
	App::import('Vendor', 'phpmailersecure', array('file' => 'phpmailersecure' . DS . 'PHPMailerAutoload.php'));
		
		    $this->request->data['Order']['status']=$trans_status;
            $this->request->data['Order']['transaction']=$trans_id;
           
	     $orderjson=json_decode($orderjson, true);
	    
$this->request->data['Order']['bank_txn_id']=$response['BANKTXNID'];
if(array_key_exists('BANKNAME', $response)){
$this->request->data['Order']['bank_name']=$response['BANKNAME'];
}
$this->request->data['Order']['payment_mode']=$response['PAYMENTMODE'];
$this->request->data['Order']['txn_date']=$response['TXNDATE'];

$this->request->data['Order']['user_id']=$orderjson[0]['user_id'];
$this->request->data['Order']['product_id']=$orderjson[0]['product_id'];
$this->request->data['Order']['first_name']=$orderjson[0]["first_name"];
$this->request->data['Order']['subtotal']=$orderjson[0]['subtotal'];
$this->request->data['Order']['email']=$orderjson[0]['email'];
$this->request->data['Order']['order_id']=$orderjson[0]['order_id'];

 
		 	$first_name = $orderjson[0]["first_name"];
	
			$subtotal    = $orderjson[0]['subtotal'];
			$title    = $orderjson[0]['title'];
			$email = $orderjson[0]['email'];
		 						
			$user_id = $orderjson[0]['user_id'];
			$product_id = $orderjson[0]['product_id'];

            $this->request->data['Order']['total']= $orderjson[0]['subtotal']; 				
	
			$CustomMessageSubject = "Enrolled in ".$title;  

						
		$subject = $CustomMessageSubject;
		$CustomMessageText="<h3>Thanks for enrolling in $title</h3>
		<table>
		<tr><td>NAME</td><td>$first_name</td>
		</tr><tr><td>EMAIL</td><td>$email</td>
		</tr><tr><td>Quiz Name</td><td>$title</td>
		</tr><tr><td>SUBTOTAL</td><td>$subtotal</td>
		</tr><tr><td>Quiz ID</td><td>$product_id</td>
		</tr>
		</table>";
		$message = $CustomMessageText;

		$to =  	$email; //$company_email; 
		 
//		App::import('Vendor', 'phpmailersecure', array('file' => 'PHPMailerAutoload.php'));
		
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                     // Set mailer to use SMTP
$mail->Host = 'mail.engagegeeks.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@engagegeeks.com';                 // SMTP username
$mail->Password = 'd.Fpdn6B%6Yt';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
		
		
		
		$mail->Priority = 1;
        $mail->ContentType	= "text/html";
        $mail->From		= "info@engagegeeks.com";
        $mail->FromName		= "Engage Geeks";
       
        $mail->Subject  = $subject;
        $mail->AltBody		= "";
				
        $mail->AddAddress(trim($to), '');
	   
	    $mail->AddBCC("khanmohan1@gmail.com");
			

        $mail->Body	= $message;
       
	 	$mail->addReplyTo('info@engagegeeks.com', 'Engage Geeks');
        		
		$mail->Send();
        	
		$this->Order->create();
        $this->Order->save($this->request->data);  
        
     } 
      
     else{
         $session->delete('checkSum');
    $session->delete('paramList');
    $session->delete('orderjson');
          return $this->redirect(['controller'=>'orders','action' => 'failed']); 
         
         
     } 
      
      
      
      
      $session->delete('checkSum');
    $session->delete('paramList');
    $session->delete('orderjson');
      
      
      
      
        			
		
    }
  
  
    
}
   				 
	
	
    
    
    
	


