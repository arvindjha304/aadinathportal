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
	
    
    
    public function searchProjects($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr){
        
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
        
		$sql="select prj.*,ct.*,pt.*,pc.*,bld.*,prj.id as project_id from projects prj
        join cities ct on ct.id=prj.city and ct.is_active=1
        join property_type pt on pt.id=prj.property_type_id and pt.is_active=1
        join property_category pc on pc.id=pt.property_category_id and pc.is_active=1
        join builders bld on prj.builder=bld.id and bld.is_active=1
        where prj.is_active=1 and prj.is_delete=0 $where AND prj.search_max_price between $minprice and $maxprice $bedroomFilterStr";
        
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
        foreach($searchResult as $search){
            $project_id = $search['project_id'];
            $floor_plans = $this->getProjectFloorPlan($project_id);
            if(count($floor_plans)){
                $search['floor_plans'] = $floor_plans;
                $searchResultArr[$count] = $search;
                $count++;
            }
        }
        return $searchResultArr;
    }
    public function getProjectFloorPlan($project_id){
        $table = new TableGateway('project_floor_plan',$this->getAdapter());
        $floor_plans = $table->select(function($select) use ($project_id){
            $select->order('size ASC');
            $select->where->equalTo('project_id',$project_id);
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