<?php
class EmailComponent extends Component {

//////////////////////////////////////////////////

    public $components = array('Session','Flash');

//////////////////////////////////////////////////

    public $controller;

//////////////////////////////////////////////////

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array)$settings));
    }


    public function send_email($booking_details=null,$booking_items=null,$company_details) {
      
		$company_name    = $company_details['company_name'];
		$company_address = $company_details['company_address'];
		$company_email   = $company_details['company_email'];
		$company_phone   = $company_details['company_phone'];
		$facebook_url    = $company_details['facebook_url'];
		$googleplus_url  = $company_details['googleplus_url'];
		$twitter_url     = $company_details['twitter_url'];  
		$linkedin_url    = $company_details['linkedin_url'];  
		$sitelogo        = $company_details['sitelogo'];  		
		$siteurl         =  Router::url('/', true);  
		
	    App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
	    	    
	    $customer_name = $booking_details['Booking']['first_name'].' '.$booking_details['Booking']['last_name'];
	    
	    $customer_email = $booking_details['Booking']['email'];
	    		
		$CustomMessageSubject = 'Your Report';
        $message = '<p>Dear ' . $customer_name. ', '
                . '<br>'
                . '<p>'
                . ' Please find your report as attachment. '
                . '</p>'
                . '<br>'
                . '<br>'
                . 'Thanks & Regards,'
                . '<br><br>'
                . $company_name
				 . '<br>'
				 . $company_address
				 . '<br>'
				 . $company_email
				 . '<br>'
				 . $company_phone
				 . '<br>'
                . '</p>';

        // Get full html:
        $CustomMessageText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
                    <title>' . html_entity_decode($CustomMessageSubject) . '</title>
                    <style type="text/css">
                        body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                        }
                    </style>
                </head>
                <body>
				<a href="'.$siteurl.'" target="_blank"><img src="'.$siteurl.'img/upload_images/'.$sitelogo.'" alt="'.$company_name.'" title="'.$company_name.'"></a>
                ' . $message . '
                </body>
                </html>';
				

		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		$to = $customer_email;
		 
  	    $mail = new PHPMailer();
        $mail->ContentType	= "text/html";
        $mail->From		= $company_email;
        $mail->FromName		= $company_name;
        $mail->Host		= "localhost";
        $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');
		
		 foreach ($booking_items as $booking_item):  
		 
		if($booking_item['BookingItem']['report_file']) {  
 				  
			$attachment =  $this->baseurl . 'img/upload_images/' . $booking_item['BookingItem']['report_file'];
						
			if(!empty($attachment)) {
					
					$filetype = mime_content_type($attachment);
					
					$mail->AddAttachment($attachment,$booking_item['Pathologytest']['name'],'base64',$filetype);
					
					//    $mail->AddAttachment('path_to_pdf', $name = 'Name_for_pdf',  $encoding = 'base64', $type = 'application/pdf');

			}
			//$mail->addStringAttachment(file_get_contents($attachment), 'myfile.pdf');
		 } 	
				 
		endforeach;
				
        $mail->Body	= $message;       
        $mail->AddReplyTo($company_email,$company_name);	 
		 
		
		if($mail->Send()){			
			 $this->Flash->success(__('Report has been sent Successfully.'));
             return true;
        } else {
			$this->Flash->danger('Report has not been sent,please try again later.');	  
			return true;
        }
    }

	  public function booking_email($booking_details=null,$booking_items=null,$company_details) {
      
		$company_name    = $company_details['company_name'];
		$company_address = $company_details['company_address'];
		$company_email   = $company_details['company_email'];
		$company_phone   = $company_details['company_phone'];
		$facebook_url    = $company_details['facebook_url'];
		$googleplus_url  = $company_details['googleplus_url'];
		$twitter_url     = $company_details['twitter_url'];  
		$linkedin_url    = $company_details['linkedin_url'];  
		$sitelogo        = $company_details['sitelogo'];  		
		$siteurl         =  Router::url('/', true);  
		
	    App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
	    	    
	    $customer_name = $booking_details['Booking']['first_name'].' '.$booking_details['Booking']['last_name'];
	    
	    $customer_email = $booking_details['Booking']['email'];
	    		
		$CustomMessageSubject = 'Your Booking';
        $message = '<p>Dear ' . $customer_name. ', '
                . '<br>'
                . '<p>'
                . ' Your Booking Details are as follows :'
                . '</p>';
				
				$b = 0;
				foreach ($booking_items as $booking_item):  
				$b++;
					$message .= '</p> '.
								$b.'. '. $booking_item['Pathologytest']['name']
								.'<p>';
				 
				endforeach;
				
		$message .= ' <p>'
                . ' <strong> Login Details to Check Your Report : </strong>'
                . '</p>'
				. '<p>'
                . ' <a href="'.$siteurl.'customer/login" target="_blank">Click Here</a> to Login  : ' 
                . '</p>'
				. '<p>'
                . ' User Name : '. $booking_details['Booking']['username']
                . '</p>'
				. '<p>'
                . ' Password : '. $booking_details['Booking']['password']
                . '</p>'
                . '<br>';
				
        $message .= '<br>'
                . 'Thanks & Regards,'
                . '<br><br>'
                . $company_name
				 . '<br>'
				 . $company_address
				 . '<br>'
				 . $company_email
				 . '<br>'
				 . $company_phone
				 . '<br>'
                . '</p>';

         
        $CustomMessageText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
                    <title>' . html_entity_decode($CustomMessageSubject) . '</title>
                    <style type="text/css">
                        body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                        }
                    </style>
                </head>
                <body>
				<a href="'.$siteurl.'" target="_blank"><img src="'.$siteurl.'img/upload_images/'.$sitelogo.'" alt="'.$company_name.'" title="'.$company_name.'"></a>
                ' . $message . '
                </body>
                </html>';
				 
					
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;

		
		$to = $customer_email;
		 
  	    $mail = new PHPMailer();
        $mail->ContentType	= "text/html";
        $mail->From		= $company_email;
        $mail->FromName		= $company_name;
        $mail->Host		= "localhost";
        $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');
		
		
				
        $mail->Body	= $message;
        $mail->AddReplyTo($company_email,$company_name);	 
		
		if($mail->Send()){			
			 $this->Flash->success(__('Booking Email has been sent Successfully.'));
             return true;
        } else {
			$this->Flash->danger('Booking Email has not been sent,please try again later.');	  
			return true;
        }
    }
		
	 public function booking_appointment_email($enquiry_details=null,$company_details) {
      
		$company_name    = $company_details['company_name'];
		$company_address = $company_details['company_address'];
		$company_email   = $company_details['company_email'];
		$company_phone   = $company_details['company_phone'];
		$facebook_url    = $company_details['facebook_url'];
		$googleplus_url  = $company_details['googleplus_url'];
		$twitter_url     = $company_details['twitter_url'];  
		$linkedin_url    = $company_details['linkedin_url'];  
		$sitelogo        = $company_details['sitelogo'];  		
		$siteurl         =  Router::url('/', true);  
		
	    App::import('Vendor', 'phpmailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
	    	     	    
	    $customer_email = $company_email;
	    		
		$CustomMessageSubject = 'A Booking Appointment requested from Website.';
        $message =  '<p>Dear Admin,  </p>';					 
		$message .=  ' <p> A Booking Appointment requested from Website. <br> <br> Following are the details : </p>';				 
		$message .= '</p> Name : '.$enquiry_details['Enquiry']['name'].'</p>';
		$message .= '</p> Email : '.$enquiry_details['Enquiry']['email'].'</p>';	 
		$message .= '</p> Phone : '.$enquiry_details['Enquiry']['phone'].'</p>';	 
		$message .= '</p> Appointment Date : '.$enquiry_details['Enquiry']['appointment_date'].'</p>';	 		 				
        $message .= '<br><br>';	
        $message .= 'Thanks & Regards,';	
        $message .=  '<br><br>';	
        $message .=  $company_name . '<br>';				 
		$message .=  $company_address . '<br>';				 
		$message .=  $company_email . '<br>';				 
		$message .=  $company_phone . '<br>';				
         
        $CustomMessageText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
                    <title>' . html_entity_decode($CustomMessageSubject) . '</title>
                    <style type="text/css">
                        body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                        }
                    </style>
                </head>
                <body>
				<a href="'.$siteurl.'" target="_blank"><img src="'.$siteurl.'img/upload_images/'.$sitelogo.'" alt="'.$company_name.'" title="'.$company_name.'"></a>
                ' . $message . '
                </body>
                </html>';			 
						
		$subject = $CustomMessageSubject;
		$message = $CustomMessageText;		
		$to      = $customer_email;
		 
  	    $mail = new PHPMailer();
        $mail->ContentType	= "text/html";
        $mail->From		= $company_email;
        $mail->FromName		= $company_name;
        $mail->Host		= "localhost";
        $mail->Subject		= $subject;
        $mail->AltBody		= "";
        $mail->AddAddress(trim($to), '');				
				
        $mail->Body	= $message;
        $mail->AddReplyTo($company_email,$company_name);	 
		
		if($mail->Send()){			
		//	 $this->Flash->success(__('Booking Appointment has been sent Successfully.'));
             return true;
        } else {
		//	$this->Flash->danger('Booking Appointment has not been sent,please try again later.');	  
			return true;
        }
    } 
}
