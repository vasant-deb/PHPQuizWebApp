<?php
App::uses('AppController', 'Controller');
class RewardsController extends AppController {

////////////////////////////////////////////

	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
 public function index() {
	  
			
 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}
		

	     $rewards = $this->Reward->find('all', [   
			
            'conditions' => [
              'Reward.user_id' => $this->Session->read('User.id'),
				
            ],
            'order' => [
                'Reward.id' => 'ASC'
            ],
			'limit' => 4
        ]);
		
     $this->set(compact('rewards')); 
     
     
     
      $selfrewardscountcheck = $this->Reward->find('first', [   
			
            'conditions' => [
              'Reward.user_id' => $this->Session->read('User.id'),
          //    'Reward.check_redeemed' => 1
				
            ],
            'order' => [
                'Reward.id' => 'ASC'
            ],
		//	'limit' => 4
        ]);
		
     $this->set(compact('selfrewardscountcheck')); 
     
	
    }
    
    
     public function refer() {
	  
			
 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}
		

	     $rewards = $this->Reward->find('first', [   
			
            'conditions' => [
              'Reward.code' => $this->request->data['code']
				
            ],
            'order' => [
                'Reward.id' => 'ASC'
            ],
		//	'limit' => 4
        ]);
		
     $this->set(compact('rewards')); 
     
     
      $selfrewards = $this->Reward->find('first', [   
			
            'conditions' => [
              'Reward.user_id' => $this->Session->read('User.id')
				
            ],
            'order' => [
                'Reward.id' => 'ASC'
            ],
		//	'limit' => 4
        ]);
		
     $this->set(compact('selfrewards')); 
     
     
     	$this->loadModel('Report');
     	$reportcount = $this->Report->find('count', [   
			
            'conditions' => [
              'Report.user_id' => $rewards['Reward']['user_id']
				
            ],
            'order' => [
                'Reward.id' => 'ASC'
            ],
		//	'limit' => 4
        ]);
		
     $this->set(compact('reportcount')); 
     
     
     	$this->loadModel('Report');
     	$reportcount2 = $this->Report->find('count', [   
			
            'conditions' => [
              'Report.user_id' => $this->Session->read('User.id')
				
            ],
            'order' => [
                'Reward.id' => 'ASC'
            ],
		//	'limit' => 4
        ]);
		
     $this->set(compact('reportcount2')); 
     
     
     
     if($selfrewards['Reward']['check_redeemed']==0){
     
           $sqlvalue=$rewards['Reward']['redeemed_by'];
        
$HiddenProducts = explode(',',$sqlvalue);
if (in_array($this->Session->read('User.id'), $HiddenProducts)) {
     
     
echo "Already used referrer code";

    die;  
     	}
	else {
	    
	    
	         	if($reportcount>="1" && $reportcount2>="1"){
	         	    
	         	    
	         	     $this->Reward->id = $selfrewards['Reward']['id'];
	         	     $this->request->data['Reward']['check_redeemed']=1;
	         	         if ($this->request->is('post') || $this->request->is('put')) {
         
         
         
         
         
         
      
       $this->Reward->save($this->request->data) ;
         
     }
	         	    
	         	    
	         	    
	         	    
	         	    
	         	    
	         	    
     	      $this->Reward->id = $rewards['Reward']['id'];
     $this->request->data['Reward']['points']=100.00;
       $this->request->data['Reward']['check_redeemed']=0;
     if(empty($rewards['Reward']['redeemed_by'])){
         $this->request->data['Reward']['redeemed_by']=$this->Session->read('User.id'); 
     }
     else{
       $this->request->data['Reward']['redeemed_by']=$rewards['Reward']['redeemed_by'].",".$this->Session->read('User.id');   
     }
     
       $this->request->data['Reward']['redeemed_by']=$this->Session->read('User.id');
       
       

 

       
     if ($this->request->is('post') || $this->request->is('put')) {
         
         
         
         
         
         
      
        if ($this->Reward->save($this->request->data)) {
               echo "100 Points Redeemed (Plz Refresh the page)";
               
                die;
            } else {
                $this->Flash->flash('The user could not be saved. Please, try again.');
                die;
            }
      
         
     }
     	} 	else {
  echo "You or your referal partner must attempt atleast one Quiz First";
   die;
}  
	    
	    
	    
	    
  
}

	} 	else {
  echo "Already used this feature";
   die;
}  
    }
    
  public function redeem() {
	  			
 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}
			
			
			
/*
 App::import('Vendor', 'config_paytm', array('file' => 'PaytmKit/lib/config_paytm.php'));		
 App::import('Vendor', 'PaytmChecksum.php', array('file' => 'PaytmKit/lib/PaytmChecksum.php.php'));
App::import('Vendor', 'encdec_paytm', array('file' => 'PaytmKit/lib/encdec_paytm.php'));

$checkSum = "";
$paytmParams = array();

$paytmParams["subwalletGuid"]      = "28054249-XXXX-XXXX-af8f-fa163e429e83";
$paytmParams["orderId"]            = $this->request->data['order_id'];
$paytmParams["beneficiaryPhoneNo"] = $this->request->data['phone'];
$paytmParams["amount"]             = $this->request->data['amount'];

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/*
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 

$checkSum = getChecksumFromArray($post_data,PAYTM_MERCHANT_KEY);

$x_mid      = PAYTM_MERCHANT_MID;
$x_checksum = $checksum;

/* for Staging */
//$url = "https://staging-dashboard.paytm.com/bpay/api/v1/disburse/order/wallet/loyalty";

/* for Production */
// $url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/wallet/{solution}";

//$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
//$response = curl_exec($ch);
//print_r($response);


  }
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
	
/**
 * admin_add method
 *
 * @return void
 */
	
	

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
		
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Faq->delete()) {
			$this->Session->setFlash(__('The banner has been deleted.'));
		} else {
			$this->Session->setFlash(__('The banner could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
