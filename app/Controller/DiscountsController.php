<?php
App::uses('AppController', 'Controller');
class DiscountsController extends AppController {
	
   
	public function delete($id = null) {
		
		$this->Discount->id = $id;
		if (!$this->Discount->exists()) {
			throw new NotFoundException(__('Invalid Discount'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Discount->delete()) {
			$this->Session->setFlash(__('The Discount code has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Discount code could not be deleted. Please, try again.'));
		}
	
		return $this->redirect(array("action" => "viewpromo" ));
	}
	/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	 
	/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
public function viewpromo() {
	
        //fetch products resultset from databse
        $promos = $this->Discount->find('all',array('fields'=>array('Discount.id','Discount.product_id','Discount.category_id','Discount.discount_rate','Discount.discount_value','Discount.date_created','Discount.valid_until','Discount.coupon_code','Discount.max_discount_amount','Discount.minimum_order_value','is_redeem_allowed')));

        //set products data and pass to the view 
        $this->set('promos',$promos);
    }
			
		public function addpromo() {
		if ($this->request->is('post')) {
			
			
			$this->Discount->create();
			if ($this->Discount->save($this->request->data)) {
				
				$this->Session->setFlash(__('The Discount Code has been saved.'));
				return $this->redirect(array('controller' => 'discounts', 'action' => 'viewpromo'));
			}
			
				
			 else {
				$this->Session->setFlash(__('The promo could not be saved. Please, try again.'));
			}
		}
	}
	
	
	
	
	public function check() {
	//promo 


	
//end promo
    }
		


		
	

	
		


		
			
	
     
?>
			
			
			
			