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

	public function getAllStates(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('st'=>'states'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
	
	}

	public function getAllCities(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('ct'=>'cities'))
		->join(array('st'=>'states'),'ct.state_id=st.id');
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
		
	}
	public function getAllProjects(){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('proj'=>'projects'))
		->join(array('pfp'=>'project_floor_plan'),'pfp.project_id=proj.id')
		->where('pfp.is_delete= 0');
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
        join amenity_type_list amtl on amt.amenity_type_id=amtl.id";
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
		$sql="select lc.id,lc.location_name,lc.is_active,ct.city_name,st.state_name 
		from locations lc
		join cities ct on ct.id=lc.city_id 
		join states st on st.id=lc.state_id ";
		$result =$db->query($sql)->execute();
		return $result;
	
	}

	public function getPropertyTypes($propertype=''){
	
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql="select pt.id,pt.property_type,pt.is_active,pc.category_name 
		from property_type pt
		join property_category pc on pc.id=pt.property_category_id";
		if($propertype=='active'){
			$sql.=" where pc.is_active=1 and pt.is_active=1";
		}
		$result =$db->query($sql)->execute();
		return $result;
	}
	
	public function checkName($name,$field){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		if($field == 'states'){
			$name = trim(strtolower($name));
			$sql="select state_name from $field st where TRIM(LOWER(st.state_name))='$name'";
		}elseif($field == 'cities'){
			$name = trim(strtolower($name));
			$sql="select city_name from $field st where TRIM(LOWER(st.city_name))='$name'";
		}elseif($field == 'locations'){
			$name = trim(strtolower($name));
			$sql="select location_name from $field st where TRIM(LOWER(st.location_name))='$name'";
		}elseif($field == 'property_type'){
			$name = trim(strtolower($name));
			$sql="select property_type from $field st where TRIM(LOWER(st.property_type))='$name'";
		}
		
		$result =$db->query($sql)->execute()->current();
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