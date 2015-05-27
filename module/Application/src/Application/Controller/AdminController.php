<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;

class AdminController extends AbstractActionController
{
    public function indexAction()
    {
         $view = new ViewModel();
         $this->layout('layout/layoutadmin');
         $indexModel = $this->getServiceLocator()->get('Application\Model\Index');
         $view->setVariable('aboutUsData', $indexModel->getAboutUs());
         return $view;
    }
    
    public function addeditstateAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	$id = $this->params()->fromQuery('id');
    	$view->setVariable('heading',(isset($id)) ? 'Edit State' : 'Add State' );
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		
    		$state = $this->params()->fromPost('state');
    		if(isset($id)){
    			
    			$data = array(
    				'state_name'	=> 	$state,
    			);
    			$where = array(
    				'id'	=> 	$id,
    			);
    			$adminModel->updateanywhere('states',$data,$where);
    			$msg = 'State Edited Successfully.';
    		}else{
    			
	    		$data = array(
		    		'state_name'	=> 	$state,
		    		'date_created'	=> 	date('Y-m-d H:i:s'),
	    		);
	    		$adminModel->insertanywhere('states',$data);
	    		$msg = 'State Added Successfully.';
    		}
    	}
    	if(isset($id)){
    	
    		$artistTable = new TableGateway('states', $adapter);
    		$rowset = $artistTable->select(array('id' => $id))->toArray();
    		$view->setVariable('stateDetail', $rowset);
    	}
    	$view->setVariable('msg', $msg);
    	return $view;
    }

    public function statelistAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	return $view;
    }

    
    public function statelistdataAction()
    {
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$statelist = $adminModel->getAllStates();
    	$dataArray = array();
    	$baseUrl = $this->getRequest()->getbaseUrl();
    	foreach($statelist as $val1)
    	{
    		$temp_arr = array();
    		$state_name		=	$val1['state_name'];
    		$status			=	($val1['is_active']==1) ? 'Active' :	'Inactive';
    		$action			=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
    		$delete 		=	'<a href="'.$baseUrl.'/admin/addeditstate?id='.$val1['id'].'" ><button >Edit</button></a><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
    		
    		
    		
    		
    		$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$state_name,$status,$delete.$action));
    	}
    	$json = json_encode($dataArray);
    	$jsonData = '{rows:'.$json.'}';
		exit('{rows:'.$json.'}');
    }
    
    public function checknameAction()
    {
    	if($this->getRequest()->isXmlHttpRequest()){
    		$name = $this->params()->fromPost('name');   
    		$field = $this->params()->fromPost('field');
    		$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    		if($name!=''){
				$statelist = $adminModel->checkName($name,$field);
				if($statelist!='')
					exit('1');
    		}
    		exit('0');
    	}
    }

    public function updatestatusAction()
    {
    	$action 		= $this->params()->fromPost('action');
    	$id 			= $this->params()->fromPost('id');
    	$selectedIds 	= $this->params()->fromPost('selectedIds');
    	
    	if(isset($selectedIds)){
    		
    		$idArr = explode(',',$selectedIds);
    		foreach($idArr as $id)
    			$this->statusUpdate('states',$action,$id);
    	}else{
    		
    		$this->statusUpdate('states',$action,$id);
    	}
    	exit('1');
    }
    
    
    public function locationAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
//     	$indexModel = $this->getServiceLocator()->get('Application\Model\Admin');
//     	$view->setVariable('aboutUsData', $indexModel->getAboutUs());
    	return $view;
    }
    
    
    public function addeditcityAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	$id = $this->params()->fromQuery('id');
    	$view->setVariable('heading',(isset($id)) ? 'Edit City' : 'Add City' );
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$stateTable = new TableGateway('states', $adapter);
    	
    	
    	$rowset = $stateTable->select()->toArray();
    	$view->setVariable('stateList', $rowset);
    	
    	
//     	echo '<pre>';print_r($rowset);exit;
    	
    	
    	 
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    
    		$state = $this->params()->fromPost('state');
    		$city  = $this->params()->fromPost('city');
    		if(isset($id)){
    			 
    			$data = array(
    					'city_name'	=> 	$city,
    					'state_id'	=> 	$state,
    			);
    			$where = array(
    					'id'	=> 	$id,
    			);
    			$adminModel->updateanywhere('cities',$data,$where);
    			$msg = 'City Edited Successfully.';
    		}else{
    			 
    			$data = array(
    					'city_name'		=> 	$city,
    					'state_id'		=> 	$state,
    					'date_created'	=> 	date('Y-m-d H:i:s'),
    			);
    			$adminModel->insertanywhere('cities',$data);
    			$msg = 'City Added Successfully.';
    		}
    	}
    	if(isset($id)){
    		 
    		$stateTable = new TableGateway('cities', $adapter);
    		$rowset = $stateTable->select(array('id' => $id))->toArray();
    		$view->setVariable('cityDetail', $rowset);
    	}
    	$view->setVariable('msg', $msg);
    	return $view;
    }
    
    public function citylistAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	return $view;
    }
    
    
    public function citylistdataAction()
    {
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	
    	
//     	echo '<pre>';print_r($rowset);exit;
    	
    	
    	$statelist = $adminModel->getAllCities();
    	$dataArray = array();
    	$baseUrl = $this->getRequest()->getbaseUrl();
    	foreach($statelist as $val1)
    	{
    		$temp_arr = array();
    		$city_name		=	$val1['city_name'];
    		$state_name		=	$val1['state_name'];
    		$status			=	($val1['is_active']==1) ? 'Active' :	'Inactive';
    		$action			=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
    		$delete 		=	'<a href="'.$baseUrl.'/admin/addeditcity?id='.$val1['id'].'" ><button >Edit</button></a><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
    		$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$city_name,$state_name,$status,$delete.$action));
    	}
    	$json = json_encode($dataArray);
    	$jsonData = '{rows:'.$json.'}';
    	exit('{rows:'.$json.'}');
    }
    

    public function updatecitystatusAction()
    {
    	$action 		= $this->params()->fromPost('action');
    	$id 			= $this->params()->fromPost('id');
    	$selectedIds 	= $this->params()->fromPost('selectedIds');
    	 
    	if(isset($selectedIds)){
    
    		$idArr = explode(',',$selectedIds);
    		foreach($idArr as $id)
    			$this->statusUpdate('cities',$action,$id);
    	}else{
    		
    		$this->statusUpdate('cities',$action,$id);
    	}
    	exit('1');
    }

    public function statusUpdate($table,$action,$id){
    
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$data = array(
    		'is_active'	=> 	($action=='active') ? 1 : 0,
    	);
    	$where = array(
    		'id'	=> 	$id,
    	);
    	 
//     	echo '<pre>';print_r($id);exit;
    	
//     	echo '1111';exit;
    	
    	
    	if($action=='delete'){
    		$adminModel->deleteanywhere($table,$where);
    	}else{
    		$adminModel->updateanywhere($table,$data,$where);
    	}
    }
    

    public function addeditlocationAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	$id = $this->params()->fromQuery('id');
    	$view->setVariable('heading',(isset($id)) ? 'Edit Location' : 'Add Location');
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$stateTable = new TableGateway('states', $adapter);
    	 
    	 
    	$rowset = $stateTable->select()->toArray();
    	$view->setVariable('stateList', $rowset);
    	 
    	 
    	//     	echo '<pre>';print_r($rowset);exit;
    	 
    	 
    
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    
    		$state = $this->params()->fromPost('state');
    		$city  = $this->params()->fromPost('city');
    		if(isset($id)){
    
    			$data = array(
    					'city_name'	=> 	$city,
    					'state_id'	=> 	$state,
    			);
    			$where = array(
    					'id'	=> 	$id,
    			);
    			$adminModel->updateanywhere('cities',$data,$where);
    			$msg = 'City Edited Successfully.';
    		}else{
    
    			$data = array(
    					'city_name'		=> 	$city,
    					'state_id'		=> 	$state,
    					'date_created'	=> 	date('Y-m-d H:i:s'),
    			);
    			$adminModel->insertanywhere('cities',$data);
    			$msg = 'City Added Successfully.';
    		}
    	}
    	if(isset($id)){
    		 
    		$stateTable = new TableGateway('cities', $adapter);
    		$rowset = $stateTable->select(array('id' => $id))->toArray();
    		$view->setVariable('cityDetail', $rowset);
    	}
    	$view->setVariable('msg', $msg);
    	return $view;
    }
    
    public function getcitiesAction()
    {
    	if($this->getRequest()->isXmlHttpRequest()){
    		$adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    		$stateId = $this->params()->fromPost('stateId');
    		$stateTable = new TableGateway('cities', $adapter);
    		$rowset = $stateTable->select(array('state_id' => $stateId))->toArray();
    		$str = '';
    		if(count($rowset)){
    			foreach ($rowset as $row) {
    				$str .= '<option value='.$row["id"].' > '.$row["city_name"].'</option>';
    			}
    		}
    		exit($str);
    	}
    }
    
}
