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
        join cities ct on ct.id=prj.city and ct.is_active=1
        join property_type pt on pt.id=prj.property_type_id and pt.is_active=1
        join property_category pc on pc.id=pt.property_category_id and pc.is_active=1
        join builders bld on prj.builder=bld.id and bld.is_active=1
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
        where prj.is_active=1 and prj.is_delete=0 ";
        
//     echo $sql;exit;
		$result =$db->query($sql)->execute()->current();
		return $result;
        
    }
    
    public function searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr){
        
        $searchResult = $this->searchProjects($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr);
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
    public function max_floor_plan_price($project_id,$minprice,$maxprice){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select concat(pfp.price,' ',pfp.price_unit) as maxPrice from project_floor_plan pfp where pfp.project_id=$project_id and pfp.search_price between $minprice and $maxprice order by pfp.search_price desc limit 1";
        
        
//        echo $sql;exit;
		$result =$db->query($sql)->execute()->current();
		return $result['maxPrice'];
	}
    public function min_floor_plan_price($project_id,$minprice,$maxprice){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select concat(pfp.price,' ',pfp.price_unit) as minPrice from project_floor_plan pfp where pfp.project_id=$project_id and pfp.search_price between $minprice and $maxprice order by pfp.search_price limit 1";
		$result =$db->query($sql)->execute()->current();
		return $result['minPrice'];
	}
    public function getProjectFloorPlan($project_id,$minprice,$maxprice){
        $table = new TableGateway('project_floor_plan',$this->getAdapter());
        $floor_plans = $table->select(function($select) use ($project_id,$minprice,$maxprice){
            $select->order('size ASC');
            $select->where->equalTo('project_id',$project_id);
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
        ->where(array('banner_type'=>$banner_type,'is_active'=>1,'is_delete'=>0));
        $result = $sql->prepareStatementForSqlObject($select)->execute();
        $projectArr = array();
        foreach($result as $res) $projectArr[] = $res;  
        shuffle($projectArr);
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
		->from(array('ct'=>'cities'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
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