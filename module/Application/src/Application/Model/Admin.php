<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
 class Admin extends AbstractTableGateway implements ServiceLocatorAwareInterface {

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
		
// 		echo '<pre>';print_r($result);exit;
		return $result;
		
	}
	
	

    public function getallproject()
	{
		$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		// $sql = new Sql($db);
		// $select = $sql->select()
		// ->from(array('ct'=>'cities'))
		// ->join(array('st'=>'states'),'ct.state_id=st.id');
		// $result = $sql->prepareStatementForSqlObject($select)->execute();'
	
		$table = new TableGateway('projects',$adapter);
		//$result = $table->select
		
		 $result = $table->select(function ($select)  {
            $select
                ->columns(array(
					'id',
                    'project_title',
                    'property_type_id',
                    'project_plan',
                    'builder',
					'builtup_area',
					'longitude',
					'order',
					'is_active'
                ))
                ->join('property_type', 'property_type.id = projects.property_type_id', array(
                    'property_type'
                    
                ),'left')
                ->join('builders', 'builders.id = projects.builder', array(
                    'builder_name'
                ),'left')
				->where->equalTo('projects.is_delete','0');
                
        });
	
		return $result->toArray();
		
		
	}
	public function getAllStates(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('st'=>'states'))
		->where(array('st.is_delete'=> '0'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
	
	}
    
	public function getAllCities(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
        ->columns(array('id','city_name','is_active'))
		->from(array('ct'=>'cities'))
		->join(array('st'=>'states'),'ct.state_id=st.id',array('state_name'))
        ->where(array('ct.is_delete'=> '0','st.is_delete'=> '0'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
	}
	public function getAllProjects(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('proj'=>'projects'))
		->join(array('pfp'=>'project_floor_plan'),'pfp.project_id=proj.id')
		->where('pfp.is_delete= 0')->order('proj.project_title ASC,pfp.bhk_type ASC');
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
		
	}
	public function getStateNameById($id){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('st'=>'states'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;	
	}
	public function getAminityList(){
	   $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select amt.id,amt.amenity_name,amt.is_active,amtl.amenity_type,amtl.id as aminity_type_id from amenities amt 
        join amenity_type_list amtl on amt.amenity_type_id=amtl.id
		where amt.is_delete = '0'";
// 		if($propertype=='active'){
			//$sql.=" where pc.is_active=1 and pt.is_active=1";
// 		}
		$result =$db->query($sql)->execute();
		
		
		return $result;
	    
	    
	    
	}
	public function getAllLocation(){
		/* $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('lc'=>'locations'))
		->columns(array('lc.location_name','ct.city_name','st.state_name'))
		->join(array('ct'=>'cities'),'ct.id=lc.city_id')
		->join(array('st'=>'states'),'st.id=ct.state_id');
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		foreach ($result as $res){
			
			echo '<pre>';print_r($res);
			
		}
		exit; */
		
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select lc.id,lc.location_name,lc.is_active,ct.city_name,st.state_name ,st.is_delete
		from locations lc
		join cities ct on ct.id=lc.city_id and ct.is_delete = '0' and ct.is_active=1
		join states st on st.id=lc.state_id and st.is_delete = '0' and st.is_active=1 
		where lc.is_delete = '0' ";
		$result =$db->query($sql)->execute();
		return $result;
	
	}
    public function getAllUser(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select * from userlist where is_delete=0 ";
		$result =$db->query($sql)->execute();
		return $result;
	
	}

	public function getPropertyTypes(){
	
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select pt.id,pt.property_type,pt.is_active,pc.category_name 
		from property_type pt
		join property_category pc on pc.id=pt.property_category_id
		where pt.is_delete=0 ";
		$result =$db->query($sql)->execute();
		return $result;
	}
    
    
    public function getPropertyTypesForListing(){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('property_category', $db);
        $propertyCategoryList = $tbl->select(array('is_active'=> '1'))->toArray();
        $resultArr = array();
        foreach($propertyCategoryList as $propertyCategory){
            $tempArr = array();
            $tempArr['category_name'] = $propertyCategory['category_name'];
            $propertyCategoryId         = $propertyCategory['id'];
            $tbl1 = new TableGateway('property_type', $db);
            $propertyTypeList = $tbl1->select(array('property_category_id'=> $propertyCategoryId,'is_active'=>1,'is_delete'=>0))->toArray();
            $tempArr['propertyTypeList'] = $propertyTypeList;
            $resultArr[] =  $tempArr;  
        }
		return $resultArr;
    }
	
	  
    public function getfloorTypesForListing(){
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('property_type', $db);
        $propertyCategoryList = $tbl->select(array('is_active'=> '1'))->toArray();
        $resultArr = array();
        foreach($propertyCategoryList as $propertyCategory){
            $tempArr = array();
            $tempArr['property_type'] = $propertyCategory['property_type'];
            $propertyCategoryId         = $propertyCategory['id'];
            $tbl1 = new TableGateway('projects', $db);
            $propertyTypeList = $tbl1->select(array('property_type_id'=> $propertyCategoryId,'is_active'=>1,'is_delete'=>0))->toArray();
            $tempArr['propertyTypeList'] = $propertyTypeList;
            $resultArr[] =  $tempArr;  
        }
		return $resultArr;
    }
	
	public function getPropertycategory($propercat=''){
	
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select proj.id,proj.project_title,proj.is_active,pt.property_type
		from projects proj
		join property_type pt on pt.id=proj.property_type_id";
		if($propertype=='active'){
			$sql.=" where pt.is_active=1 and proj.is_active=1";
		}
		$result =$db->query($sql)->execute();
		return $result;
	}
	
	public function checkName($name,$field){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		if($field == 'states'){
			$name = trim(strtolower($name));
			$sql="select state_name from $field st where TRIM(LOWER(st.state_name))='$name' and is_active=1 and is_delete=0";
		}elseif($field == 'cities'){
			$name = trim(strtolower($name));
			$sql="select city_name from $field st where TRIM(LOWER(st.city_name))='$name' and is_active=1 and is_delete=0";
		}elseif($field == 'locations'){
			$name = trim(strtolower($name));
			$sql="select location_name from $field st where TRIM(LOWER(st.location_name))='$name' and is_active=1 and is_delete=0";
		}elseif($field == 'property_type'){
			$name = trim(strtolower($name));
			$sql="select property_type from $field st where TRIM(LOWER(st.property_type))='$name' and is_active=1 and is_delete=0";
		}elseif($field == 'builders'){
			$name = trim(strtolower($name));
			$sql="select builder_name from $field st where TRIM(LOWER(st.builder_name))='$name' and is_active=1 and is_delete=0";
		}
		$result =$db->query($sql)->execute()->current();
		return $result;
	}
    
    public function getBannerList()
	{ 
		$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql = new Sql($adapter);
        $select = $sql->select()
        ->columns(array('id','banner_image','is_active'))
        ->from(array('bnr'=>'bannerlist'))
        ->join(array('btl'=>'banner_type_list'), 'btl.id = bnr.banner_type', array('banner_type'))
        ->join(array('prj'=>'projects'), 'prj.id = bnr.project_id', array('project_title'))
		->where(array('bnr.is_delete'=> '0','prj.is_delete'=> '0',));
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
		$data = array(
		    'is_delete'	=> 	 1 ,
		);
		$results = $table->update($data, $where);
		//$table->delete($where); 
		return 1;
	}

		
	public function insertanywhere($mytable, array $data) {

		$db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		
		//echo '2222';exit;
		$table = new TableGateway($mytable, $db);
		$results = $table->insert($data);
	}
	
	
	
	
}