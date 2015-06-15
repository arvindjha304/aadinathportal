<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
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
	
    public function searchProjects($city_id,$propcategory_id,$minprice,$maxprice){
        
        $db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $where = '';
        if($city_id!='')
            $where .= " and prj.city=$city_id ";
        if($propcategory_id!='')
            $where .= "  and pt.property_category_id=$propcategory_id ";
       
        
		$sql="select prj.*,ct.*,pt.*,pc.*,bld.*,prj.id as project_id from projects prj
        join cities ct on ct.id=prj.city and ct.is_active=1
        join property_type pt on pt.id=prj.property_type_id and pt.is_active=1
        join property_category pc on pc.id=pt.property_category_id and pc.is_active=1
        join builders bld on prj.builder=bld.id and bld.is_active=1
        where prj.is_active=1 and prj.is_delete=0 $where AND prj.search_max_price between $minprice and $maxprice";
        
//      echo $sql;exit;
		$result =$db->query($sql)->execute();
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