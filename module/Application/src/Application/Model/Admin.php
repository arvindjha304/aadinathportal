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
	public function getStateNameById($id){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
		$select = $sql->select()
		->from(array('st'=>'states'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
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
		$table->delete($where); 
	}

		
	public function insertanywhere($mytable, array $data) {

		$db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		
		//echo '2222';exit;
		$table = new TableGateway($mytable, $db);
		$results = $table->insert($data);
	}
	
	
	
	
}