<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
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

	public function getAboutUs(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select * from about_us";
		$result =$db->query($sql)->execute()->current();
		return $result;
	}
	
    public function sendNewsLetter($data){
        
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Express Zenith Newsletter</title>
        </head>

        <body style="margin:0; padding:0;">
        <table width="640" border="0" cellpadding="0" cellspacing="0"  bgcolor="#fff" style="margin:auto; border:3px solid #02753e;">
          <tr>
            <td colspan="2" align="center" style="padding-top:20px; padding-bottom:10px;"><img width="252" height="61" src="http://aadinathindia.com/public/images/builders/sikka.png" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:60px;font-weight:bold;color:#b7291d">Express Zenith</td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold;padding-top:5px;padding-bottom:20px;">SECTOR - 77, NOIDA</td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold;padding:10px;color:#fff;background-color:#02753e;">For Booking, Call us on +91-8882 770 770</td>
          </tr>
          <tr>    
            <td align="left" style="padding-left:20px;padding-top:20px;"><a href="#"><img width="98" height="50" src="img/logo.jpg" /></a></td>
            <td align="right" style="padding-right:20px;padding-top:20px;font-size:16px;color:#b7291d;text-shadow:1px 1px #999;line-height:22px;font-weight:bold;font-family:"Times New Roman", Times, serif;"><span style="font-size:24px;">Price</span><br /> 0000 /- Sq Ft Onwards</td>
          </tr>
          <tr>
            <td colspan="2" align="justify" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;padding:10px 20px 10px 20px;color:#333;line-height:20px;font-weight:600">    
            <p>Express Zenith, an iconic project unleashed by the Express Group is located in Noida Sector 77. It offers posh 2/3 bhk residential apartments with an exclusive limited edition of 700 units. Being constructed across a prime land of 5.5 acres, this beautiful township constitutes of 6 towers and 19 floors. This project has been conceptualized thoughtfully with a provision of spaciously designed apartment size ranging from 1075-1765 sqft.</p>
            </td>
          </tr>  
          <tr>
            <td colspan="2"><img width="634" height="250" src="img/slider.jpg" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="padding:10px;"><a href="#" style="text-decoration:none;"><div style="width:220px;background-color:#b7291d;border-radius: 35px 35px 35px 35px;-moz-border-radius: 35px 35px 35px 35px;-webkit-border-radius: 35px 35px 35px 35px;border:0px solid #000000;color:#fff;font-size:14px;font-weight:bold;font-family:Arial, Helvetica, sans-serif;padding:7px;text-align:center;">Click here to view details</div></a></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#333;line-height:16px;">For further information on projects, you can get in touch with us<br />
        through email, phone or visit us online </td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;padding:10px;color:#333;line-height:16px;font-weight:600;">Phone: +91-8882-770-770 &nbsp;|&nbsp; Email: <a href="#">ceo@urbanavenues.in</a> &nbsp;|&nbsp; Website: <a href="#">urbanavenues.in</a></td>           </tr>
        </table>
        </body>
        </html>'; 
       // $projectDetail = $this->getProjectDetail($id);
        $m = new \Zend\Mail\Message();
        $m->addFrom('noreply@aadinath.co,', '')
          ->addTo('ally@me.com', 'Ally Joe')
          ->setSubject('Test');

        $bodyPart = new \Zend\Mime\Message();

        $bodyMessage = new \Zend\Mime\Part($html);
        $bodyMessage->type = 'text/html';

        $bodyPart->setParts(array($bodyMessage));

        $m->setBody($bodyPart);
        $m->setEncoding('UTF-8');
        
        $transport = new \Mail\Transport\Sendmail();
        $transport->send($m);
        
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
            if(in_array('upto9month', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+9 months", strtotime($currntDate))); 
            elseif(in_array('upto6month', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+6 months", strtotime($currntDate)));
            elseif(in_array('upto3month', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+3 months", strtotime($currntDate)));
            elseif(in_array('readyToMoveIn', $possessionArr))
              $maxPossessionDate = date('Y-m-d', strtotime("+2 months", strtotime($currntDate)));
            
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
            $bedroomFilterStr = ' and '.$tempStr;
        }
        if($minprice!='' && $maxprice!=''){
            $where .= "  AND prj.search_max_price between $minprice and $maxprice ";
        }
        if($builderId!=''){
            $where .= "  AND prj.builder= $builderId";
        }
        
		$sql="select prj.*,ct.*,pt.*,pc.*,bld.*,prj.id as project_id from projects prj
        join cities ct on ct.id=prj.city and ct.is_active=1 and ct.is_delete=0 
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
        
		$sql="select prj.*,ct.*,pt.*,pc.*,bld.*,prj.id as project_id from projects prj
        join cities ct on ct.id=prj.city and ct.is_active=1
        join property_type pt on pt.id=prj.property_type_id and pt.is_active=1
        join property_category pc on pc.id=pt.property_category_id and pc.is_active=1
        join builders bld on prj.builder=bld.id and bld.is_active=1
        where prj.is_active=1 and prj.is_delete=0 and prj.id=$id";
        
//     echo $sql;exit;
		$result =$db->query($sql)->execute()->current();
		return $result;
        
    }
    
    public function searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr,$builderId=''){
        
        $searchResult = $this->searchProjects($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr,$builderId='');
        
        $searchResultArr = array();
        $count = 0;
        $budget         = (isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '';
        if($budget!=''){
            $budgetArr = explode(',',$budget);
            $maxprice = max($budgetArr);
//            echo $maxprice;exit;
        }
        foreach($searchResult as $search){
            $project_id = $search['project_id'];
            $floor_plans = $this->getProjectFloorPlan($project_id,$minprice,$maxprice);
            if(count($floor_plans)){
                $search['floor_plans'] = $floor_plans;
                $search['max_floor_plan_price'] = $this->max_floor_plan_price($project_id,$minprice,$maxprice);
                $search['min_floor_plan_price'] = $this->min_floor_plan_price($project_id,$minprice,$maxprice);
                $searchResultArr[$count] = $search;
                $count++;
            }
        }  
        return $searchResultArr;
    }
    
    public function getCityName($city_id){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $table = new TableGateway('cities',$db);
        $data= $table->select(array('id'=>$city_id))->toArray();
        
        $cityName = (count($data)) ? $data[0]['city_name']:'';
//        echo '<pre>';print_r($data);exit;
        
//        echo  $cityName;exit;
	
		return $cityName;
	}
    public function max_floor_plan_price($project_id,$minprice,$maxprice){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $between='';
        if($minprice!='' && $maxprice!='')
           $between = ' between '.$minprice.' and '.$maxprice.' ';
		$sql="select concat(pfp.price,' ',pfp.price_unit) as maxPrice from project_floor_plan pfp where pfp.project_id=$project_id and pfp.search_price  $between order by pfp.search_price desc limit 1";
        
        
      //  echo $sql;exit;
		$result =$db->query($sql)->execute()->current();
		return $result['maxPrice'];
	}
    public function min_floor_plan_price($project_id,$minprice,$maxprice){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $between='';
        if($minprice!='' && $maxprice!='')
           $between = ' between '.$minprice.' and '.$maxprice.' ';
		$sql="select concat(pfp.price,' ',pfp.price_unit) as minPrice from project_floor_plan pfp where pfp.project_id=$project_id and pfp.search_price $between order by pfp.search_price limit 1";
		$result =$db->query($sql)->execute()->current();
		return $result['minPrice'];
	}
    public function getProjectFloorPlan($project_id,$minprice='',$maxprice=''){
        $table = new TableGateway('project_floor_plan',$this->getAdapter());
        $floor_plans = $table->select(function($select) use ($project_id,$minprice,$maxprice){
            $select->order('size ASC');
            $select->where->equalTo('project_id',$project_id);
            if($minprice!='' && $maxprice!='')
            $select->where->between('search_price',$minprice,$maxprice);
        })->toArray();
        return $floor_plans;
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
        ->join(array('prj'=>'projects'), 'prj.id = bnl.project_id', array('project_title'))
        ->where(array('banner_type'=>$banner_type,'bnl.is_active'=>1,'bnl.is_delete'=>0,'prj.is_delete'=> '0','prj.is_active'=> '1'));
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
        $select->columns(array('id','builder_image'))
            ->where(array('is_active'=>1,'is_delete'=>0));
        })->toArray();
        shuffle($selectData);
//         echo '<pre>';print_r($selectData);exit;
        
        return $selectData;
    }
    public function getCityList(){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
        ->columns(array(new \Zend\Db\Sql\Expression('DISTINCT(city_name) as city'),'id as cityId'))
		->from(array('ct'=>'cities'))
        ->join(array('st'=>'states'),'st.id=ct.state_id')
        ->where(array('ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0))
        ->limit(7);
            
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
    }
    public function projectByCategory($property_type){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
        ->columns(array('id as prjId','project_title'))
		->from(array('prj'=>'projects'))
        ->join(array('pptId'=>'property_type'), 'pptId.id=prj.property_type_id')
        ->join(array('pptCatId'=>'property_category'), 'pptCatId.id=pptId.property_category_id')
        ->where(array('prj.is_active'=>1,'prj.is_delete'=>0,'pptId.is_active'=>1,'pptId.is_delete'=>0,'pptId.property_category_id'=>$property_type))
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
	
	
	
    
}