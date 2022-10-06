<?php
App::uses('AppController', 'Controller');
/**
 * Banners Controller
 *
 * @property Banner $Banner
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
 
 	public function admin_index() {
		
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '0');
		/*$this->Banner->recursive = 0;
		$this->set('banners', $this->Paginator->paginate());*/
		
	//$this->Banner->query('ALTER TABLE `banners` ADD `showon_catalog` TINYINT(4) NULL AFTER `showon_home`;');
 
		$banners = $this->Banner->find('all', array(
		 	'recursive' => 0,
		//	'limit' => 50, 
			'order' => array(
				'Banner.id' => 'desc'
			),
			'conditions' => array(
			),
		));
		
		
		$this->set(compact('banners'));
	}


public function add() {
	
 if(@$this->Session->read('User.id') == '') {
				
				        return $this->redirect('/customer/register');
			}	
	

	   $quiz_id=$this->request->data['quiz_id'];
	
	if(empty($quiz_id)){
	
echo "<script>alert('Cant Access this Page directly');window.location.href='/quizes/index';</script>";
}
	
	
	$report = $this->Report->find('first', array(
			'recursive' => 0,
			'order' => array(
				'Report.id' => 'ASC'
			),
			'conditions' => array(
			'Report.quiz_id' => $quiz_id,
			'Report.user_id' => $this->Session->read('User.id')
		//	'Blog.active' => 1			
			),
		));
		

		
        $this->set(compact('report'));


if(!empty($report)){
	
echo "<script>alert('Already Attempted');window.location.href='/quizes/index';</script>";
}
	
	
	
	$this->loadModel('Quizes');	
	$quiz = $this->Quizes->find('first', array(
			'recursive' => 0,
			'order' => array(
				'Quizes.id' => 'ASC'
			),
			'conditions' => array(
			'Quizes.id' => $quiz_id
		//	'Blog.active' => 1			
			),
		));
		

		
        $this->set(compact('quiz')); 
        $this->request->data['Report']['user_ip']=$this->request->data['user_ip'];
		$this->request->data['Report']['response']=$this->request->data['response'];
		$randArr=unserialize($this->request->data['response']);
		
		$json = $quiz['Quizes']['qjson'];
	$score=0;	
$json_array = json_decode($json, true);
 $this->set(compact('quiz','json_array'));
 $i=0;
 $correctqid[]="";
 $unattempted[]="";
 $incorrectqid[]="";
	foreach($randArr as $elem)  {
	
if(array_key_exists($i, $this->request->data['answerRes'])){
		 $check_answer=implode(",",$this->request->data['answerRes'][$i]);
		
		
		if($check_answer==$json_array[$elem]['answer']){
			$correctqid[$i]=$json_array[$elem]['id'];
			 $score=$score+4;
		}
		elseif($check_answer==""){
			$unattempted[$i]=$json_array[$elem]['id'];
			$score=$score+0;
		}
		else{
			$incorrectqid[$i]=$json_array[$elem]['id'];
			$score=$score+0;
		}
}	
	$i++;}
	
$data=json_encode($this->request->data['answerRes']);
$user_id=$this->request->data['user_id'];
$this->request->data['Report']['marks']=$score;
$this->request->data['Report']['incorrect']=implode(",",$incorrectqid);
$this->request->data['Report']['correct']=implode(",",$correctqid);
$this->request->data['Report']['unattempted']=implode(",",$unattempted);
$this->request->data['Report']['answerRes']=$data;
$this->request->data['Report']['user_id']=$this->request->data['user_id'];
$this->request->data['Report']['quiz_id']=$this->request->data['quiz_id'];
$this->request->data['Report']['quiz_title']=$this->request->data['quiz_title'];

$time1=$this->request->data['time'];

                $time2=new DateTime('00:15:00');
			$time1=new DateTime($time1);
				
			$dteDiff  = $time1->diff($time2);
				$timex=$dteDiff->format("%H:%I:%S");
	$this->request->data['Report']['time']=$timex;

     $timetkaen=date($this->request->data['time']);

    $timeArr = explode(':', $timetkaen);
    $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);


$this->request->data['Report']['total_score']=$decTime+$score;
$this->request->data['Report']['addedtime']=$decTime;

         $name = strtoupper($this->request->data['fullname']);
	   $desc=$this->request->data['quiz_title'];
        $name_len = strlen($name);
        $occupation = "for participating in ".strtoupper($desc);
        $certidate=date("d/m/y");
        if ($occupation) {
          $font_size_occupation = 16;
        }
         $font_size_date=14;
        if ($name == "" || $occupation == "") {
          echo 
          "
          <div class='alert alert-danger col-sm-6' role='alert'>
              Ensure you fill all the fields!
          </div>
          ";
        }else{
          echo 
          "
          <div class='alert alert-success col-sm-6' role='alert'>
              Congratulations! $name on your excellent success.
          </div>
          ";

          //designed certificate picture
          $image = "certi.png";

          $createimage = imagecreatefrompng($image);

          //this is going to be created once the generate button is clicked
          $output = "certificates/".$quiz_id."-".$user_id."-"."certificate.png";

          //then we make use of the imagecolorallocate inbuilt php function which i used to set color to the text we are displaying on the image in RGB format
          $white = imagecolorallocate($createimage, 205, 245, 255);
          $black = imagecolorallocate($createimage, 0, 0, 0);

          //Then we make use of the angle since we will also make use of it when calling the imagettftext function below
          $rotation = 0;

          //we then set the x and y axis to fix the position of our text name
          $origin_x = 200;
          $origin_y=260;

          //we then set the x and y axis to fix the position of our text occupation
          $origin1_x = 150;
          $origin1_y=320;
          
          
          $origin2_x = 150;
          $origin2_y=375;

          //we then set the differnet size range based on the lenght of the text which we have declared when we called values from the form
          if($name_len<=7){
            $font_size = 25;
            $origin_x = 190;
          }
          elseif($name_len<=12){
            $font_size = 30;
          }
          elseif($name_len<=15){
            $font_size = 26;
          }
          elseif($name_len<=20){
             $font_size = 18;
          }
          elseif($name_len<=22){
            $font_size = 15;
          }
          elseif($name_len<=33){
            $font_size=11;
          }
          else {
            $font_size =10;
          }

          $certificate_text = $name;
          putenv('GDFONTPATH=' . realpath('.'));


           $drFont = "fonts/developer";

          // font directory for occupation name
          $drFont1 = "fonts/Poppins-Regular";
          
      

          //function to display name on certificate picture
          $text1 = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black,$drFont1, $certificate_text);

          //function to display occupation name on certificate picture
          $text2 = imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x+2, $origin1_y, $black, $drFont1, $occupation);
          
           $text3 = imagettftext($createimage, $font_size_date, $rotation, $origin2_x+3, $origin2_y, $black, $drFont, $certidate);

          imagepng($createimage,$output,3);

$this->request->data['Report']['certi']=$output;
 
        }


            $this->Report->create();
			if ($this->Report->save($this->request->data)) {
				$this->Session->setFlash(__('The Report has been saved.'));
				return $this->redirect(array('controller' => 'quizes', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The Report could not be saved. Please, try again.'));
			}

}

	public function report() {
	
	}


/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
		$this->set('banner', $this->Banner->find('first', $options));
	}

		 
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($company_id = null) {
  
		if ($this->request->is(array('post', 'put'))) {
			 
					 $filename = "";
					 
					$service_slug = $this->Banner->generateSlug($this->request->data['Banner']['name']);
					 
									
		if(!empty($this->data['Banner']['image']['name']))
                    {
					
					  $filename = $this->process_image($this->request->data['Banner']['image'], 'img-'.$service_slug,'banners/');
					}
					
						$this->request->data['Banner']['image'] = $filename;
 					  
					 

					
			$this->Banner->create();
			if ($this->Banner->save($this->request->data)) {
				$this->Session->setFlash(__('The banner has been saved.'));
				return $this->redirect(array('controller' => 'banners', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
			}
		}	

$categories = $this->Banner->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		$this->set(compact('categories'));		
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		
		$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
		$banner_details = $this->Banner->find('first', $options);
	
		$filename = $banner_details['Banner']['image'];
		
		if ($this->request->is(array('post', 'put'))) {
 		
		 

					$service_slug = $this->generateSlug($this->request->data['Banner']['name']);
					 
			 
			 if(!empty($this->data['Banner']['image']['name']))
                    {
					
					    $filename = $this->process_image($this->request->data['Banner']['image'], 'img-'.$service_slug,'banners/');  
					}
					
				
			$this->request->data['Banner']['image'] = $filename;
 					  
					
	 
						 
			if ($this->Banner->save($this->request->data)) {
				$this->Session->setFlash(__('The banner has been saved.'));
				return $this->redirect(array('controller' => 'banners', 'action' => 'index' ));
			} else {
				$this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
			$this->request->data = $this->Banner->find('first', $options);
		}		
		 	 
		$categories = $this->Banner->Category->find('list', array(
		'conditions' => array('Category.parent_id' => '0')
		)
		);
		$this->set(compact('categories'));
		}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Banner->id = $id;
		if (!$this->Banner->exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Banner->delete()) {
			$this->Session->setFlash(__('The banner has been deleted.'));
		} else {
			$this->Session->setFlash(__('The banner could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

 public function admin_change_banner_status()
    {
        if(!$this->request->is('AJAX'))
        {
            return $this->redirect(array('controller'=>'banners', 'action'=>'index'));
        }
        
        if(!$this->Banner->save(array('id'=>$this->request->data['banner_id'], 'active'=>$this->request->data['status'])))
        {
            echo json_encode(array('status'=>'failure', 'message'=>'Unable to update status at the moment.'));
            die;
        }
        
        echo json_encode(array('status'=>'success', 'message'=>'Banner status updated.'));
        die;
    }
}
