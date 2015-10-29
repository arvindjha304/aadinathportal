<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Session\Container;
use Zend\Authentication\AuthenticationService;

use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

 class Index extends AbstractTableGateway implements ServiceLocatorAwareInterface {

	protected $serviceLocator;
	protected $tableGateway;
	public  $dbAdapterConfig;
	
	public function getAdapter() {
     return $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
	}
     public function __construct(AbstractTableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
	 
	 public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	 }

	public function getServiceLocator() {
     return $this->serviceLocator;
	}
    
    public function updateanywhere($mytable, array $data, $where) {
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$table = new TableGateway($mytable, $db);
		$results = $table->update($data, $where);
		return 1;
	}

	public function deleteanywhere($mytable, $where) {
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$table = new TableGateway($mytable, $db);
		$table->delete($where); 
	}

	public function insertanywhere($mytable, array $data) {
		$db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$table = new TableGateway($mytable, $db);
		$results = $table->insert($data);
	}
	
	public function getAboutUs(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select * from about_us";
		$result =$db->query($sql)->execute()->current();
		return $result;
	}
//	function sendMail($htmlBody, $textBody, $subject, $from, $to)
//    {
//        $to = 'arvindjha304@gmail.com';
//        $from = 'noreply@idi.com';
//        $subject = 'Website Change Reqest';
//
//        $headers = "From: noreply@idi.com\r\n";
//        $headers .= "Reply-To: noreply@idi.com\r\n";
//        $headers .= "CC: susan@example.com\r\n";
//        $headers .= "MIME-Version: 1.0\r\n";
//
//        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//
//
//        $message = '<html><body>';
//        $message .= '<h1>Hello, World!</h1>';
//        $message .= '</body></html>';
//
//
////        mail($to, $subject, $message, $headers);
//        if(mail($to, $subject, $message, $headers)){
//            echo 'Your mail has been sent successfully.';
//        } else{
//            echo 'Unable to send email. Please try again.';
//        }
//
//
//        return 1;
//    }
    public function sendNewsLetter($data){
        $project_id = $data['project_id'];
        $user_email = $data['email'];
        $projectDetail = $this->getProjectDetail($project_id);
        $min_floor_plan = $this->min_floor_plan_price($project_id);   
//        echo '<pre>';print_r($projectDetail);exit;
        
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>'.$projectDetail['project_title'].'</title>
        </head>

        <body style="margin:0; padding:0;">
        <table width="640" border="0" cellpadding="0" cellspacing="0"  bgcolor="#fff" style="margin:auto; border:3px solid #02753e;">
          <tr>
            <td colspan="2" align="center" style="padding-top:20px; padding-bottom:10px;"><img width="252" height="61" src="http://aadinathindia.com/public/uploadfiles/'.$projectDetail['builder_image'].'" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:60px;font-weight:bold;color:#b7291d">'.$projectDetail['project_title'].'</td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold;padding-top:5px;padding-bottom:20px;">'.$projectDetail['location_name'].', '.$projectDetail['city_name'].'</td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold;padding:10px;color:#fff;background-color:#02753e;">For Booking, Call us on +91-9650 797 111</td>
          </tr>
          <tr>    
            <td align="right" style="padding-right:20px;padding-top:20px;font-size:16px;color:#b7291d;text-shadow:1px 1px #999;line-height:22px;font-weight:bold;font-family:\'Times New Roman\', Times, serif;"><span style="font-size:24px;">Price</span><br /> '.$min_floor_plan.' Onwards</td>
          </tr>
          <tr>
            <td colspan="2" align="justify" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;padding:10px 20px 10px 20px;color:#333;line-height:20px;font-weight:600">    
            <p>'.$projectDetail['project_desc'].'</p>
            </td>
          </tr>  
          <tr>
            <td colspan="2"><img width="634" height="250" src="http://aadinathindia.com/public/uploadfiles/'.$projectDetail['project_image'].'" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="padding:10px;"><a href="http://aadinathindia.com/projects-in-'.$projectDetail['citySlug'].'/'.$projectDetail['projectSlug'].'" style="text-decoration:none;"><div style="width:220px;background-color:#b7291d;border-radius: 35px 35px 35px 35px;-moz-border-radius: 35px 35px 35px 35px;-webkit-border-radius: 35px 35px 35px 35px;border:0px solid #000000;color:#fff;font-size:14px;font-weight:bold;font-family:Arial, Helvetica, sans-serif;padding:7px;text-align:center;">Click here to view details</div></a></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#333;line-height:16px;">For further information on projects, you can get in touch with us<br />
        through email, phone or visit us online </td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;padding:10px;color:#333;line-height:16px;font-weight:600;">Phone: +91-9650 797 111 &nbsp;|&nbsp; Email: <a>crm@aadinathindia.com</a> &nbsp;|&nbsp; Website: <a href="http://aadinathindia.com/">aadinathindia.com</a></td>           </tr>
        </table>
        </body>
        </html>'; 
       $subject = $projectDetail['project_title']. ' Newsletter';
       
    //   $user_email = 'arvindjha304@gmail.com';
       
       $this->sendmailHTML($user_email,'',$subject,$html);
       
       $subjectCallBack = 'CallBack Request';
        
       $bodyCallBack = "<p>Hi </p>
        <p>User Requested Callback for ".$projectDetail['project_title'].". Following are the details:-</p>
        <table>
        <tr><td>Email : </td><td>".$data['email']."</td></tr>     
        <tr><td>Mobile : </td><td>".$data['mobile']."</td></tr>  
        </table>";
        
        $this->sendmailHTML('crm@aadinathindia.com','',$subjectCallBack,$bodyCallBack);
       
       
       
    }
          
    public function sendmail($to_email,$to_name,$subject,$body){
        $message = new \Zend\Mail\Message();
        $message->addTo($to_email, $to_name)
                ->setFrom('no-reply@aadinathindia.com', 'Aadinath India')
                ->setSubject($subject)
                ->setBody($body);
        
        if($_SERVER['HTTP_HOST']=='localhost'){
           
            $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
            $smtpOptions->setHost('smtp.gmail.com')
            ->setConnectionClass('login')
            ->setName('smtp.gmail.com')
            ->setConnectionConfig(array(
                    'username' => 'mail.discoverysolutions@gmail.com',
                    'password' => 'Discovery@123',
//                    'username' => 'test00455@gmail.com',
//                    'password' => 'Test@1423',
                    'ssl' => 'tls',
                )
            ); 
            $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
            $transport->send($message);
        }else{
            $transport = new \Zend\Mail\Transport\Sendmail();
            $transport->send($message);
        }
        return 1;
    }
    public function sendmailHTML($to_email,$to_name,$subject,$htmltext){
        $message = new \Zend\Mail\Message();
        $message->addTo($to_email, $to_name)
                ->setFrom('no-reply@aadinathindia.com', 'Aadinath India')
                ->setSubject($subject);
       // $htmltext = '<b>heii, <i>sorry</i>, i\'m going late</b>';
        
        if($_SERVER['HTTP_HOST']=='localhost'){
            $transport = new \Zend\Mail\Transport\Smtp();
            $options   = new \Zend\Mail\Transport\SmtpOptions(array(
                'host'              => 'smtp.gmail.com',
                'connection_class'  => 'login',
                'connection_config' => array(
                    'ssl'       => 'tls',
                    'username' => 'mail.discoverysolutions@gmail.com',
                    'password' => 'Discovery@123'
//                      'username' => 'test00455@gmail.com',
//                      'password' => 'Test@1423', 
                ),
                'port' => 587,
            ));
            $html = new \Zend\Mime\Part($htmltext);
            $html->type = "text/html";
            $body = new \Zend\Mime\Message();
            $body->addPart($html);
            $message->setBody($body);
            $transport->setOptions($options);
            $transport->send($message);
        }else{
            $bodyPart = new \Zend\Mime\Message();
            $bodyMessage = new \Zend\Mime\Part($htmltext);
            $bodyMessage->type = 'text/html';
            $bodyPart->setParts(array($bodyMessage));
            $message->setBody($bodyPart);
            $message->setEncoding('UTF-8');
            $transport = new \Zend\Mail\Transport\Sendmail();
            $transport->send($message); 
        }
        return 1;
    }
    
    
    public function searchProjects($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr,$builderId=''){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $possession     = (isset($refineSearchArr['possession'])) ? $refineSearchArr['possession'] : '';
        $propertyType   = (isset($refineSearchArr['propertyType'])) ? $refineSearchArr['propertyType'] : '';
        $budget         = (isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '';
        $bedroom        = (isset($refineSearchArr['bedroom'])) ? $refineSearchArr['bedroom'] : '';
        
        $where = '';
        if($city_id!='')
            $where .= " and prj.city=$city_id ";
        if($propcategory_id!='')
            $where .= "  and pt.property_category_id=$propcategory_id ";
        
        if($possession!=''){
            $possessionArr = explode(',',$possession);
//            echo '<pre>';print_r($possessionArr);exit;
            $currntDate = date('Y-m-d');
            $maxPossessionDate = '';
            if(in_array('upto9month', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+9 months", strtotime($currntDate))); 
            elseif(in_array('upto6month', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+6 months", strtotime($currntDate)));
            elseif(in_array('upto3month', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+3 months", strtotime($currntDate)));
            elseif(in_array('readyToMoveIn', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+2 months", strtotime($currntDate)));
            if($maxPossessionDate!='')
            $where .= "  and prj.possession between '$currntDate' and '$maxPossessionDate' ";
        }
        if($propertyType!=''){
            $where .= " and prj.property_type_id in ($propertyType) ";
        }
        if($budget!=''){
            $budgetArr = explode(',',$budget);
            $maxprice = max($budgetArr);
        }
        $bedroomFilterStr = '';
        if($bedroom!=''){
            $bedroomArr = explode(',',$bedroom);
            $tempStr = '';
            if(in_array(1, $bedroomArr))
                $tempStr   .= ($tempStr=='') ? ' prj.has_1BHK=1' : ' or prj.has_1BHK=1';
            if(in_array(2, $bedroomArr))
                $tempStr   .= ($tempStr=='') ? ' prj.has_2BHK=1' : ' or prj.has_2BHK=1';
            if(in_array(3, $bedroomArr))
                $tempStr   .= ($tempStr=='') ? ' prj.has_3BHK=1' : ' or prj.has_3BHK=1';
            if(in_array(4, $bedroomArr))
                $tempStr   .= ($tempStr=='') ? ' prj.has_4BHK=1' : ' or prj.has_4BHK=1';
            if(in_array(5, $bedroomArr))
                $tempStr   .= ($tempStr=='') ? ' prj.has_5BHK=1' : ' or prj.has_5BHK=1';
            $bedroomFilterStr = ' and ('.$tempStr.')';
        }
        if($minprice!='' && $maxprice!=''){
            $where .= "  AND prj.search_max_price between $minprice and $maxprice ";
        }
        if($builderId!=''){
            $where .= "  AND prj.builder= $builderId";
        }
        
		$sql="select prj.*,ct.*,st.*,pt.*,pc.*,bld.*,prj.id as project_id from projects prj
        join locations lt on lt.id=prj.location and lt.is_active=1 and lt.is_delete=0 
        join cities ct on ct.id=prj.city and ct.is_active=1 
        join states st on st.id=ct.state_id and st.is_active=1 and st.is_delete=0  
        join property_type pt on pt.id=prj.property_type_id and pt.is_active=1 and pt.is_delete=0 
        join property_category pc on pc.id=pt.property_category_id and pc.is_active=1
        join builders bld on prj.builder=bld.id and bld.is_active=1 and bld.is_delete=0
        where prj.is_active=1 and prj.is_delete=0 $where $bedroomFilterStr";
        
//    echo $sql;exit;
		$result =$db->query($sql)->execute();
		return $result;
    }
    
    public function getProjectDetail($id){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select prj.*,lt.*,ct.*,pt.*,pc.*,bld.*,prj.id as project_id,bld.id as bldId,prj.last_updated as prj_last_updated
        from projects prj
        join locations lt on lt.id=prj.location and lt.is_active=1 and lt.is_delete=0 
        join cities ct on ct.id=prj.city and ct.is_active=1
        join property_type pt on pt.id=prj.property_type_id and pt.is_active=1
        join property_category pc on pc.id=pt.property_category_id and pc.is_active=1
        join builders bld on prj.builder=bld.id and bld.is_active=1
        where prj.is_active=1 and prj.is_delete=0 and prj.id=$id";
//      echo $sql;exit;
		$result =$db->query($sql)->execute()->current();
		return $result;
        
    }
    
    public function searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr,$builderId=''){
        $searchResult = $this->searchProjects($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr,$builderId);
        $searchResultArr = array();
        $count = 0;
        $budget         = (isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '';
        if($budget!=''){
            $budgetArr = explode(',',$budget);
            $maxprice = max($budgetArr);
        }
        foreach($searchResult as $search){
            $project_id = $search['project_id'];
            $floor_plans = $this->getProjectFloorPlan($project_id,$minprice,$maxprice);
            if(count($floor_plans)){
                $search['max_floor_plan_price'] = $this->max_floor_plan_price($project_id,$minprice,$maxprice);
                $search['min_floor_plan_price'] = $this->min_floor_plan_price($project_id,$minprice,$maxprice);
//              echo '<pre>';print_r($floorPlanMainArr);exit; 
                $search['floor_plans'] = $floor_plans;
                $maxMinFloorSize = $this->maxMinFloorSize($project_id,$minprice,$maxprice);
                $search['max_floor_plan_size']   = $maxMinFloorSize['maxFloorSize'];
                $search['min_floor_plan_size']   = $maxMinFloorSize['minFloorSize'];
                $searchResultArr[$count] = $search;
//              echo '<pre>';print_r($searchResultArr);exit; 
                $count++;
            }
        }
        
//        	echo '<pre>';print_r($searchResultArr);exit;
        return $searchResultArr;
    }
    
    public function getCityName($city_id){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $table = new TableGateway('cities',$db);
        $data= $table->select(array('id'=>$city_id))->toArray();
        
        $cityName = (count($data)) ? $data[0]['city_name']:'';
		return $cityName;
	}
    public function maxMinFloorSize($project_id,$minprice='',$maxprice='',$bhk_type=''){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $between='';
        if($minprice!='' && $maxprice!='')
           $between .= ' and pfp.search_price  between '.$minprice.' and '.$maxprice.' ';
        if($bhk_type!='')
            $between .= ' and pfp.bhk_type='.$bhk_type.' ';    
        $sql="select concat(max(pfp.size)) as maxFloorSize,concat(min(pfp.size)) as minFloorSize,pfp.unit from project_floor_plan pfp where pfp.project_id=$project_id $between ";
        //        echo $sql;exit;
        $result =$db->query($sql)->execute()->current();
        return array('maxFloorSize'=>$result['maxFloorSize'],'minFloorSize'=>$result['minFloorSize'],'unit'=>$result['unit']);
    }
    
    public function max_floor_plan_price($project_id,$minprice='',$maxprice='',$bhk_type=''){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $between='';
        if($minprice!='' && $maxprice!='')
           $between .= ' and pfp.search_price  between '.$minprice.' and '.$maxprice.' ';
        if($bhk_type!='')
            $between .= ' and pfp.bhk_type='.$bhk_type.' ';    
		$sql="select concat(pfp.price,' ',pfp.price_unit) as maxPrice from project_floor_plan pfp where pfp.is_active=1 and pfp.is_delete=0 and pfp.project_id=$project_id $between order by pfp.search_price desc limit 1";
        
//        echo $sql;exit;
		$result =$db->query($sql)->execute()->current();
		return $result['maxPrice'];
	}
    public function min_floor_plan_price($project_id,$minprice='',$maxprice='',$bhk_type=''){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $between='';
        if($minprice!='' && $maxprice!='')
           $between .= ' between '.$minprice.' and '.$maxprice.' ';
        if($bhk_type!='')
           $between .= ' and pfp.bhk_type='.$bhk_type.' ';    
		$sql="select concat(pfp.price,' ',pfp.price_unit) as minPrice from project_floor_plan pfp where pfp.is_active=1 and pfp.is_delete=0 and pfp.project_id=$project_id and pfp.search_price $between order by pfp.search_price limit 1";
		$result =$db->query($sql)->execute()->current();
		return $result['minPrice'];
	}
    
    public function getAllFloorPlan($project_id,$minprice,$maxprice){
        $table = new TableGateway('project_floor_plan',$this->getAdapter());
        $floor_plans = $table->select(function($select) use ($project_id,$minprice,$maxprice){
            $select->where->equalTo('project_id',$project_id);
            $select->where(array('is_active'=>1,'is_delete'=>0));
            if($minprice!='' && $maxprice!='')
            $select->where->between('search_price',$minprice,$maxprice);
            $select->order(array('bhk_type ASC', 'size ASC'));
        })->toArray();
        return $floor_plans;
    }   
     
    
    public function getProjectFloorPlan($project_id,$minprice='',$maxprice=''){
        $floor_plans = $this->getAllFloorPlan($project_id,$minprice,$maxprice);
//        echo '<pre>';print_r($floor_plans);exit;  
        
        $bhkListArr = [];
        $floorPlanMainArr = [];
        $floorPlanTempArr = [];
        $kk =0;
        if(count($floor_plans)){
            foreach ($floor_plans as $floor_plan){
                $kk++;
                if(!in_array($floor_plan['bhk_type'],$bhkListArr)){
                    if(count($floorPlanTempArr))
                        $floorPlanMainArr[] = $floorPlanTempArr;
                    $floorPlanTempArr = [];
                    $floorPlanTempArr['BHK']                = $floor_plan['bhk_type'];
                    $maxMinFloorSize = $this->maxMinFloorSize($project_id,$minprice,$maxprice,$floor_plan['bhk_type']);
                    $floorPlanTempArr['max_size']           = $maxMinFloorSize['maxFloorSize'];
                    $floorPlanTempArr['min_size']           = $maxMinFloorSize['minFloorSize'];
                    $floorPlanTempArr['size_unit']          = $maxMinFloorSize['unit'];
                    $floorPlanTempArr['max_price']          = $this->max_floor_plan_price($project_id,$minprice,$maxprice,$floor_plan['bhk_type']);
                    $floorPlanTempArr['min_price']          = $this->min_floor_plan_price($project_id,$minprice,$maxprice,$floor_plan['bhk_type']);
                }

                $tempArr = [];
                $tempArr['id']                  = $floor_plan['id'];
                $tempArr['plan_type']           = $floor_plan['plan_type'];
                $tempArr['size']                = $floor_plan['size'];
                $tempArr['unit']                = $floor_plan['unit'];
                $tempArr['price']               = $floor_plan['price'];
                $tempArr['floor_plan_image']    = $floor_plan['floor_plan_image'];
                $tempArr['price_unit']          = $floor_plan['price_unit'];

                $floorPlanTempArr['floor_plan_list'][]   = $tempArr;
                if(count($floor_plans)==$kk){
                    $floorPlanMainArr[] = $floorPlanTempArr;
                }
                $bhkListArr[]   =   $floor_plan['bhk_type'];
            }
        }    
        
//        echo '<pre>';print_r($floor_plans);exit;  
        return $floorPlanMainArr;
    }
    public function getProjectAmenities($amenities){
        $amenitiesArr = explode(',',$amenities);
        $table = new TableGateway('amenities',$this->getAdapter());
        $resultArr = $table->select(function($select) use ($amenitiesArr){
            $select->order('amenity_name ASC');
            $select->where->in('id',$amenitiesArr);
        })->toArray();
        return $resultArr;
    }

    public function countProjects($builderId){
        $projectTable = new TableGateway('projects',$this->getAdapter());
        $totalProject   = $projectTable->select(array('is_active'=>1,'is_delete'=>0,'builder'=>$builderId))->count();
        $ongoingProject = $projectTable->select(array('is_active'=>1,'is_delete'=>0,'builder'=>$builderId,'project_status'=>1))->count();
        return array('totalProject'=>$totalProject,'ongoingProject'=>$ongoingProject);
    }
    
    public function homepagebanners(){
        $table = new TableGateway('homepagebanners',$this->getAdapter());
        $bannerArr = $table->select()->toArray();
        $homeBannerArr = array();
        if(count($bannerArr)){
            foreach ($bannerArr[0] as $key=>$banner){
               if($key!='id' && $banner!='')
                   $homeBannerArr[$key] = $banner;
            }
        }
        return $homeBannerArr;
    }
     
    public function projectBanner($banner_type){
        
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
        ->columns(array('banner_image','project_id'))
        ->from(array('bnl'=>'bannerlist'))
        ->join(array('prj'=>'projects'), 'prj.id = bnl.project_id', array('project_title','projectSlug'))
        ->join(array('ct'=>'cities'), 'ct.id=prj.city',['city_name'])
        ->join(array('lt'=>'locations'), 'lt.id=prj.location',[])
        ->join(array('st'=>'states'), 'st.id=ct.state_id',[])
        ->join(array('bld'=>'builders'), 'prj.builder=bld.id',[])
        ->join(array('pptId'=>'property_type'), 'pptId.id=prj.property_type_id')
        ->join(array('pptCatId'=>'property_category'), 'pptCatId.id=pptId.property_category_id')   
        ->where(array('banner_type'=>$banner_type,'bnl.is_active'=>1,'bnl.is_delete'=>0,'prj.is_delete'=> '0','prj.is_active'=> '1','pptId.is_active'=>1,
        'pptId.is_delete'=>0,'lt.is_active'=>1,'lt.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,'bld.is_active'=>1,'bld.is_delete'=>0));
        $result = $sql->prepareStatementForSqlObject($select)->execute();
        $projectArr = array();
        foreach($result as $res) $projectArr[] = $res;  
        shuffle($projectArr);
        
        
//        echo '<pre>';print_r($projectArr);exit;
        
        return $projectArr;
    }
    
    public function getBuilderList(){
        $table = new TableGateway('builders',$this->getAdapter());
        $selectData = $table->select(function($select){
        $select->columns(array('id','builder_footer_image','builderSlug'))
            ->where(array('is_active'=>1,'is_delete'=>0));
        })->toArray();
        shuffle($selectData);
//         echo '<pre>';print_r($selectData);exit;
        
        return $selectData;
    }
    public function getCityList(){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
//		$sql = new Sql($db);
//		$select = $sql->select()
//        ->columns(array(new \Zend\Db\Sql\Expression('DISTINCT(city_name) as city'),'id as cityId'))
//		->from(array('ct'=>'cities'))
//        ->join(array('st'=>'states'),'st.id=ct.state_id')
//        ->where(array('ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0))
//        ->limit(7);
//            
//		$result = $sql->prepareStatementForSqlObject($select)->execute();
        
        
        
        $sql = new Sql($db);
        $where = new Where();
        $select= $sql->select()
        ->columns([])
		->from(['prj'=>'projects'])
        ->join(['ct'=>'cities'],'ct.id=prj.city',['id','city_name','citySlug'])
        ->join(['st'=>'states'],'st.id=ct.state_id',[])
        ->join(['pptId'=>'property_type'], 'pptId.id=prj.property_type_id',[])
        ->join(['pptCatId'=>'property_category'], 'pptCatId.id=pptId.property_category_id',[])
        ->join(['bld'=>'builders'],'prj.builder=bld.id',[])        
        ->where(['prj.is_active'=>1,'prj.is_delete'=>0,'ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,'pptId.is_active'=>1,
        'pptId.is_delete'=>0,'pptCatId.is_active'=>1,'bld.is_active'=>1,'bld.is_delete'=>0])
//        $where->like('ct.city_name',$searchStr.'%');
        ->group('ct.id')->limit(7);
        $ctyList = $sql->prepareStatementForSqlObject($select)->execute();
		return $ctyList;
    }
    public function projectByCategory($property_type){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
        ->columns(array('id as prjId','project_title','projectSlug'))
		->from(array('prj'=>'projects'))
        ->join(array('ct'=>'cities'), 'ct.id=prj.city',['city_name'])
        ->join(array('lt'=>'locations'), 'lt.id=prj.location',[])
        ->join(array('st'=>'states'), 'st.id=ct.state_id',[])
        ->join(array('bld'=>'builders'), 'prj.builder=bld.id',[])
        ->join(array('pptId'=>'property_type'), 'pptId.id=prj.property_type_id')
        ->join(array('pptCatId'=>'property_category'), 'pptCatId.id=pptId.property_category_id')
        ->where(array('prj.is_active'=>1,'prj.is_delete'=>0,'pptId.is_active'=>1,'pptId.is_delete'=>0,
        'lt.is_active'=>1,'lt.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,'bld.is_active'=>1,'bld.is_delete'=>0,
        'pptId.property_category_id'=>$property_type))
//        ->where->notEqualTo('prj.order', 0);
        ->where('prj.order!=0')
        ->order('prj.order')
        ->limit(9);            
		$result = $sql->prepareStatementForSqlObject($select)->execute();
        
//        foreach($result as $res){
//            echo '<pre>';print_r($res);
//        }        
//        exit;
		return $result;
    }
    
    public function projectSearchData($searchStr){
        $db = $this->getAdapter(); 
        $where = new Where();
        $sql = new Sql($db);
        $select= $sql->select()
        ->columns(['id as prjId','project_title','projectSlug'])
		->from(['prj'=>'projects'])
        ->join(['ct'=>'cities'],'ct.id=prj.city',[])
        ->join(['st'=>'states'],'st.id=ct.state_id',[])
        ->join(['pptId'=>'property_type'], 'pptId.id=prj.property_type_id',[])
        ->join(['pptCatId'=>'property_category'], 'pptCatId.id=pptId.property_category_id',[])
        ->join(['bld'=>'builders'],'prj.builder=bld.id',[]); 
        $where->like('prj.project_title','%'.$searchStr.'%');
        $select->where($where);
        $select->where(array('prj.is_active'=>1,'prj.is_delete'=>0,'ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,'pptId.is_active'=>1,'pptId.is_delete'=>0,'pptCatId.is_active'=>1,'bld.is_active'=>1,'bld.is_delete'=>0));
        $prjList = $sql->prepareStatementForSqlObject($select)->execute();
        
//        $prjList = $sql->prepareStatementForSqlObject($select)->getSql();
//        
//        echo $prjList;exit;
        
        $projectArr = [];
        foreach($prjList as $res){
            if(count($res))
                $projectArr[] = ['prj_id'=>$res['prjId'],'projectSlug'=>$res['projectSlug'],'project_title'=>trim($res['project_title'])];
        }    
        
        $sql = new Sql($db);
        $where = new Where();
        $select= $sql->select()
        ->columns([])
		->from(['prj'=>'projects'])
        ->join(['ct'=>'cities'],'ct.id=prj.city',[])
        ->join(['st'=>'states'],'st.id=ct.state_id',[])
        ->join(['pptId'=>'property_type'], 'pptId.id=prj.property_type_id',[])
        ->join(['pptCatId'=>'property_category'], 'pptCatId.id=pptId.property_category_id',[])
        ->join(['bld'=>'builders'],'prj.builder=bld.id',['id','builder_name','builderSlug']);
        $where->like('bld.builder_name','%'.$searchStr.'%');
        $select->where($where);
        $select->where(['prj.is_active'=>1,'prj.is_delete'=>0,'ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,
        'pptId.is_active'=>1,'pptId.is_delete'=>0,'pptCatId.is_active'=>1,'bld.is_active'=>1,'bld.is_delete'=>0])->group('bld.id');
        $bldList = $sql->prepareStatementForSqlObject($select)->execute();
        $builderArr = [];
        foreach($bldList as $res){
            if(count($res))
                $builderArr[] = ['bld_id'=>$res['id'],'builderSlug'=>$res['builderSlug'],'builder_name'=>$res['builder_name']];
        } 
        
        $sql = new Sql($db);
        $where = new Where();
        $select= $sql->select()
        ->columns([])
		->from(['prj'=>'projects'])
        ->join(['ct'=>'cities'],'ct.id=prj.city',['id','city_name','citySlug'])
        ->join(['st'=>'states'],'st.id=ct.state_id',[])
        ->join(['pptId'=>'property_type'], 'pptId.id=prj.property_type_id',[])
        ->join(['pptCatId'=>'property_category'], 'pptCatId.id=pptId.property_category_id',[])
        ->join(['bld'=>'builders'],'prj.builder=bld.id',[]);
        $where->like('ct.city_name','%'.$searchStr.'%');
        $select->where($where);
        $select->where(['prj.is_active'=>1,'prj.is_delete'=>0,'ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,
        'pptId.is_active'=>1,'pptId.is_delete'=>0,'pptCatId.is_active'=>1,'bld.is_active'=>1,'bld.is_delete'=>0])->group('ct.id');
        $ctyList = $sql->prepareStatementForSqlObject($select)->execute();
        
        $cityArr = [];
        foreach($ctyList as $res){
            if(count($res))
                $cityArr[] = ['city_id'=>$res['id'],'citySlug'=>$res['citySlug'],'city_name'=>$res['city_name']];
        } 
		return ['projectarr'=>$projectArr,'builderarr'=>$builderArr,'cityarr'=>$cityArr];
    }
    
	public function allTestimonials(){
		$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$artistTable = new TableGateway('testimonial', $adapter);
        $select = $artistTable->select(function($select){
            $select->where(array('is_delete'=>'0','is_active'=>'1'));
            $select->order('name ASC');
        })->toArray();
        shuffle($select);
		return $select;
	}
    
    function getIdFromSlug($table,$field,$slug){
		$artistTable = new TableGateway($table, $this->getAdapter());
        $select = $artistTable->select(function($select) use ($field,$slug){
            $select->where(array($field=>$slug));
        })->toArray();
		return $select[0]['id'];
    }
    function getProjectFromId($prjId){
        $table = new TableGateway('projects',$this->getAdapter());
        $select = $table->select(function($select) use($prjId){
            $select->where(array('id'=>$prjId));    
        })->toArray();
        return $select;
    }
	function getProjectToCompare(){
        
        $container       = new Container('compareProjects');
        $toCompareProjects = $container->allCompareProjects;
        $select = [];
        if(count($toCompareProjects)){
            $table = new TableGateway('projects',$this->getAdapter());
            $select = $table->select(function($select) use($toCompareProjects){
                $select->columns(['id','project_title','projectSlug']);
                $select->where->in('id',$toCompareProjects);   
            })->toArray();
        }
//        echo '<pre>';print_r($select);exit;
        return $select;
    }
    
	function recently_viewed($project_id){
        $auth = new AuthenticationService();
        $recentlyViewed = [];
        $recentlyViewed['project_id']       =   $project_id;
        $recentlyViewed['is_active']        =   1;
        $recentlyViewed['is_delete']        =   0;
        $recentlyViewed['date_created']     =   date('Y-m-d H:i:s'); 
        $table = new TableGateway('recently_viewed_project',$this->getAdapter());
        if($auth->hasIdentity()){
            $identity = $auth->getIdentity();
            $recentlyViewed['user_id']      =   $identity->id;
            $recentlyViewed['ip_address']   =   '';
            $select = $table->select(['user_id'=>$identity->id,'project_id'=>$project_id])->toArray();
            if(count($select)==0)
                $this->insertanywhere('recently_viewed_project', $recentlyViewed);
        }else{
            $recentlyViewed['user_id']      =   '';
            $recentlyViewed['ip_address']   =   $_SERVER['REMOTE_ADDR'];
            $select = $table->select(['ip_address'=>$_SERVER['REMOTE_ADDR'],'project_id'=>$project_id])->toArray();
            if(count($select)==0)
                $this->insertanywhere('recently_viewed_project', $recentlyViewed);
        }
        return 1;
    }
    
	
	function enquired_properties($project_id){
        $auth = new AuthenticationService();
        $table = new TableGateway('enquired_projects',$this->getAdapter());
        if($auth->hasIdentity()){
            $identity = $auth->getIdentity();
            $enquired_projects = [];
            $enquired_projects['project_id']       =   $project_id;
            $enquired_projects['is_active']        =   1;
            $enquired_projects['is_delete']        =   0;
            $enquired_projects['date_created']     =   date('Y-m-d H:i:s'); 
            $enquired_projects['user_id']      =   $identity->id;
            $select = $table->select(['user_id'=>$identity->id,'project_id'=>$project_id])->toArray();
            if(count($select)==0)
                $this->insertanywhere('enquired_projects', $enquired_projects);
        }
        return 1;
    }
    
}