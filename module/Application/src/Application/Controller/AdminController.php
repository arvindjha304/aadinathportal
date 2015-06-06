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
	public function getbaseUrl(){
		$baseUrl = $this->getRequest()->getbaseUrl();
		
	}
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
	    		if($state!=''){
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
				    		'state_name'	=> 	ucfirst($state),
				    		'date_created'	=> 	date('Y-m-d H:i:s'),
			    		);
			    		$adminModel->insertanywhere('states',$data);
			    		$msg = 'State Added Successfully.';
		    		}
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
    	 
    	 
    	$stateList = $stateTable->select()->toArray();
    	$view->setVariable('stateList', $stateList);
    	 
    	 
    	//     	echo '<pre>';print_r($rowset);exit;
    	 
    	 
    
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    
    		$state 		= $this->params()->fromPost('state');
    		$city_id  	= $this->params()->fromPost('city');
    		$location  	= $this->params()->fromPost('location');
    		
//     echo $location;exit;		
    		
    		
    		if(isset($id)){
    
    			$data = array(
    				'location_name'	=> 	$location,
    				'city_id'		=> 	$city_id,
    				'state_id'		=> 	$state,
    			);
    			$where = array(
    					'id'	=> 	$id,
    			);
    			$adminModel->updateanywhere('locations',$data,$where);
    			$msg = 'Location Edited Successfully.';
    		}else{
    
    			$data = array(
    				'location_name'	=> 	$location,
    				'city_id'		=> 	$city_id,
    				'state_id'		=> 	$state,
    				'date_created'	=>	date('Y-m-d H:i:s'),
    			);
    			$adminModel->insertanywhere('locations',$data);
    			$msg = 'Location Added Successfully.';
    		}
    	}
    	if(isset($id)){
    		 
    		$stateTable = new TableGateway('locations', $adapter);
    		$locationDetail = $stateTable->select(array('id' => $id))->toArray();
    		$city_id 	= $locationDetail[0]['city_id'];
    		$state_id 	= $locationDetail[0]['state_id'];  
    		$citiesTable = new TableGateway('cities', $adapter);
    		$cityOptions = $citiesTable->select(array('state_id' => $state_id))->toArray();
    		$view->setVariable('cityOptions', $cityOptions);
    		$view->setVariable('locationDetail', $locationDetail);
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
    
    public function locationlistAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	return $view;
    }

    public function locationlistdataAction()
    {
    	
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	 
    	 
    	//     	echo '<pre>';print_r($rowset);exit;
    	
    	 
    	$locationList = $adminModel->getAllLocation();
    	$dataArray = array();
    	$baseUrl = $this->getRequest()->getbaseUrl();
    	foreach($locationList as $val1)
    	{
    		$temp_arr = array();
    		$location_name	=	$val1['location_name'];
    		$city_name		=	$val1['city_name'];
    		$state_name		=	$val1['state_name'];
    		$status			=	($val1['is_active']==1) ? 'Active' :	'Inactive';
    		$action			=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
    		$delete 		=	'<a href="'.$baseUrl.'/admin/addeditlocation?id='.$val1['id'].'" ><button >Edit</button></a><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
    		$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$location_name,$city_name,$state_name,$status,$delete.$action));
    	}
    	
    	$json = json_encode($dataArray);
    	$jsonData = '{rows:'.$json.'}';
    	exit('{rows:'.$json.'}');
    }
    

    public function updatelocationstatusAction()
    {
    	$action 		= $this->params()->fromPost('action');
    	$id 			= $this->params()->fromPost('id');
    	$selectedIds 	= $this->params()->fromPost('selectedIds');
    
    	if(isset($selectedIds)){
    
    		$idArr = explode(',',$selectedIds);
    		foreach($idArr as $id)
    			$this->statusUpdate('locations',$action,$id);
    	}else{
    
    		$this->statusUpdate('locations',$action,$id);
    	}
    	exit('1');
    }
    
    
    public function addeditpropertytypeAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	$id = $this->params()->fromQuery('id');
    	$view->setVariable('heading',(isset($id)) ? 'Edit Property Type' : 'Add Property Type');
    	
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$stateTable = new TableGateway('property_category', $adapter);
    	$propertyCategoryList = $stateTable->select()->toArray();
    	$view->setVariable('propertyCategoryList', $propertyCategoryList);
    
    	//     	echo '<pre>';print_r($rowset);exit;
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    
    		$propertyCategory		= $this->params()->fromPost('propertyCategory');
    		$propertyType  			= $this->params()->fromPost('propertyType');
    
    		if(isset($id)){
    
    			$data = array(
    				'property_type'			=> 	$propertyType,
    				'property_category_id'	=> 	$propertyCategory,
    			);
    			$where = array(
    					'id'	=> 	$id,
    			);
    			$adminModel->updateanywhere('property_type',$data,$where);
    			$msg = 'Property Type Edited Successfully.';
    		}else{
    			$data = array(
    				'property_type'			=> 	$propertyType,
    				'property_category_id'	=> 	$propertyCategory,
    			);
    			$adminModel->insertanywhere('property_type',$data);
    			$msg = 'Property Type Added Successfully.';
    		}
    	}
    	if(isset($id)){
    		 
    		$stateTable = new TableGateway('property_type', $adapter);
    		$propertyTypeDetail = $stateTable->select(array('id' => $id))->toArray();
    		$view->setVariable('propertyTypeDetail', $propertyTypeDetail);
    	}
    	$view->setVariable('msg', $msg);
    	return $view;
    }
    

    public function propertytypelistAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	return $view;
    }

    public function propertytypelistdataAction()
    {
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$statelist = $adminModel->getPropertyTypes();
    	$dataArray = array();
    	$baseUrl = $this->getRequest()->getbaseUrl();
    	foreach($statelist as $val1)
    	{
    		$temp_arr = array();
    		$property_type		=	$val1['property_type'];
    		$category_name		=	$val1['category_name'];
    		$status			=	($val1['is_active']==1) ? 'Active' :	'Inactive';
    		$action			=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
    		$delete 		=	'<a href="'.$baseUrl.'/admin/addeditpropertytype?id='.$val1['id'].'" ><button >Edit</button></a><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
    		$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$property_type,$category_name,$status,$delete.$action));
    	}
    	$json = json_encode($dataArray);
    	$jsonData = '{rows:'.$json.'}';
    	exit('{rows:'.$json.'}');
    }
    
    public function updatepropertypestatusAction()
    {
    	$action 		= $this->params()->fromPost('action');
    	$id 			= $this->params()->fromPost('id');
    	$selectedIds 	= $this->params()->fromPost('selectedIds');
    
    	if(isset($selectedIds)){
    		$idArr = explode(',',$selectedIds);
    		foreach($idArr as $id)
    			$this->statusUpdate('property_type',$action,$id);
    	}else{
    		$this->statusUpdate('property_type',$action,$id);
    	}
    	exit('1');
    }
    
  

    public function addeditamentiesAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	$id = $this->params()->fromQuery('id');
    	$view->setVariable('heading',(isset($id)) ? 'Edit Amenities' : 'Add Amenities');
    	 
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	
    	
    	$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$amenityTypeTable = new TableGateway('amenity_type_list', $adapter);
    	$amenityTypeList = $amenityTypeTable->select()->toArray();
    	$view->setVariable('amenityTypeList', $amenityTypeList);
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    
    		$amenityType		= $this->params()->fromPost('amenityType');
    		$lastDivId			= $this->params()->fromPost('lastDivId');
	    		if(isset($id)){
		    			$imagename  		= $this->params()->fromPost('imagename_1');
		    			$amenityName  		= $this->params()->fromPost('amenityName_1');
		    			if($amenityName!='') {	
			    			$data = array(
			    				'amenity_type_id'		=> 	$amenityType,
			    				'amenity_name'			=> 	$amenityName,
			    				'amenity_image'			=> 	$imagename,
			    			);
			    			$where = array(
			    					'id'	=> 	$id,
			    			);
			    			$adminModel->updateanywhere('amenities',$data,$where);
			    			$msg = 'Amenitiy Edited Successfully.';
		    			}
	    		}else{
	    			for($i=1;$i<$lastDivId+1;$i++)
	    			{
	    				$imagename  	= $this->params()->fromPost('imagename_'.$i);
	    				$amenityName  	= $this->params()->fromPost('amenityName_'.$i);
	    				if($amenityName!='') {	
			    			$data = array(
			    				'amenity_type_id'		=> 	$amenityType,
			    				'amenity_name'			=> 	$amenityName,
			    				'amenity_image'			=> 	$imagename,
			    			);
			    			$adminModel->insertanywhere('amenities',$data);
		    			}
		    		}
	    			$msg = 'Amenitiy Added Successfully.';
	    		}
    	}
    	if(isset($id)){
    		$stateTable = new TableGateway('amenities', $adapter);
    		$amenityDetail = $stateTable->select(array('id' => $id))->toArray();
    		$view->setVariable('amenityDetail', $amenityDetail);
    	}
    	$view->setVariable('msg', $msg);
    	return $view;
    }
    
    public function amentieslistAction()
    {
    	$view = new ViewModel();
    	$this->layout('layout/layoutadmin');
    	return $view;
    }
    
    public function amentieslistdataAction()
    {
    	$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$stateTable = new TableGateway('amenities', $adapter);
    	$arrList = $stateTable->select()->toArray();
    	$dataArray = array();
    	$baseUrl = $this->getRequest()->getbaseUrl();
    	foreach($arrList as $val1)
    	{
    		$temp_arr = array();
    		$amenity_name		=	$val1['amenity_name'];
    		$status				=	($val1['is_active']==1) ? 'Active' :	'Inactive';
    		$action				=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
    		$delete 			=	'<a href="'.$baseUrl.'/admin/addeditamenties?id='.$val1['id'].'" ><button >Edit</button></a><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
    		$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$amenity_name,$status,$delete.$action));
    	}
    	$json = json_encode($dataArray);
    	$jsonData = '{rows:'.$json.'}';
    	exit('{rows:'.$json.'}');
    }
    
    public function amentiesstatusAction()
    {
    	$action 		= $this->params()->fromPost('action');
    	$id 			= $this->params()->fromPost('id');
    	$selectedIds 	= $this->params()->fromPost('selectedIds');
    
    	if(isset($selectedIds)){
    		$idArr = explode(',',$selectedIds);
    		foreach($idArr as $id)
    			$this->statusUpdate('amenities',$action,$id);
    	}else{
    		$this->statusUpdate('amenities',$action,$id);
    	}
    	exit('1');
    }
    
	public function uploadAction() {
		$baseurl = $this->getRequest()->getbaseUrl();
		$random  = rand(101,999);
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].$baseurl.'/public/uploadfiles/';
		$file = $uploaddir.$random.'_'.basename($_FILES['uploadfile']['name']);
		$realfilename = $random.'_'.basename($_FILES['uploadfile']['name']);
		if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
			echo $realfilename;
		} else {
			echo "";
		}
		exit;
	}
	
	
	public function addeditbuildersAction()
	{
		$view = new ViewModel();
		$this->layout('layout/layoutadmin');
		$id = $this->params()->fromQuery('id');
		$view->setVariable('heading',(isset($id)) ? 'Edit Builder' : 'Add Builder');
		$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
		$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

		//     	echo '<pre>';print_r($rowset);exit;
		$msg = '';
		$request = $this->getRequest();
		if ($request->isPost()) {
	
			$data = array(
				'builder_name'		=> 	$this->params()->fromPost('builder_name'),
				'about_builder'		=> 	$this->params()->fromPost('about_builder'),
				'meta_tag'			=> 	$this->params()->fromPost('meta_tag'),
				'keyword'			=> 	$this->params()->fromPost('keyword'),
				'description'		=> 	$this->params()->fromPost('description'),
				'priority'			=> 	$this->params()->fromPost('priority'),
				'builder_image'		=> 	$this->params()->fromPost('imagename'),
			);
			
			if(isset($id)){
				$where = array(
					'id'	=> 	$id,
				);
				$adminModel->updateanywhere('builders',$data,$where);
				$msg = 'Builder Edited Successfully.';
			}else{
				$data['date_created'] = date('Y-m-d H:i:s');
				$adminModel->insertanywhere('builders',$data);
				$msg = 'Builder Added Successfully.';
			}
		}
		if(isset($id)){
			 
			$stateTable = new TableGateway('builders', $adapter);
			$builderDetail = $stateTable->select(array('id' => $id))->toArray();
			$view->setVariable('builderDetail', $builderDetail);
		}
		$view->setVariable('msg', $msg);
		return $view;
	}
	
	public function builderlistAction()
	{
		$view = new ViewModel();
		$this->layout('layout/layoutadmin');
		return $view;
	}
	
	public function builderlistdataAction()
	{
		$adapter =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$artistTable = new TableGateway('builders', $adapter);
		
		$select = $artistTable->select(function($select){
			$select->order('priority ASC');
		})->toArray();
		
		$dataArray = array();
		$baseUrl = $this->getRequest()->getbaseUrl();
		foreach($select as $val1)
		{
			$temp_arr = array();
			$builder_name	=	$val1['builder_name'];
			$priority		=	$val1['priority'];
			$status			=	($val1['is_active']==1) ? 'Active' :	'Inactive';
			$action			=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
			$delete 		=	'<a href="'.$baseUrl.'/admin/addeditbuilders?id='.$val1['id'].'" ><button >Edit</button></a><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
			$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$builder_name,$priority,$status,$delete.$action));
		}
		$json = json_encode($dataArray);
		//$jsonData = '{rows:'.$json.'}';
		exit('{rows:'.$json.'}');
	}
	
	public function updatebuilderstatusAction()
	{
		$action 		= $this->params()->fromPost('action');
		$id 			= $this->params()->fromPost('id');
		$selectedIds 	= $this->params()->fromPost('selectedIds');
	
		if(isset($selectedIds)){
			$idArr = explode(',',$selectedIds);
			foreach($idArr as $id)
				$this->statusUpdate('builders',$action,$id);
		}else{
			$this->statusUpdate('builders',$action,$id);
		}
		exit('1');
	}
	
	
	
}
