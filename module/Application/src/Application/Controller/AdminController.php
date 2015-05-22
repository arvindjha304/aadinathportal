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
    	$msg = '';
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		
    		$state = $this->params()->fromPost('state');
    		$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    		if(isset($id)){
    			
    			$data = array(
    				'state_name'	=> 	$state,
    			);
    			$where = array(
    				'id'	=> 	$id,
    			);
    			$adminModel->updateanywhere('states',$data,$where);
    			$msg = 'State Added Successfully.';
    		}else{
    			
	    		$data = array(
		    		'state_name'	=> 	$state,
		    		'date_created'	=> 	date('Y-m-d H:i:s'),
	    		);
	    		$adminModel->insertanywhere('states',$data);
	    		$msg = 'State Edited Successfully.';
    		}
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
    	foreach($statelist as $val1)
    	{
    		$temp_arr = array();
    		$state_name		=	$val1['state_name'];
    		$status			=	($val1['is_active']==1) ? 'Active' :	'Inactive';
    		$action			=	($val1['is_active']==1) ? '<button onclick=inActiveStatus('.$val1["id"].')>Inactive</button>' :'<button onclick=activeStatus('.$val1["id"].')>Active</button>';
    		$delete 		=	'<button>Edit</button><button onclick=deleteRow('.$val1["id"].') >Delete</button>';
    		$dataArray[] = array("id"=>$val1['id'],"data"=>array(0,$state_name,$status,$delete.$action));
    	}
    	$json = json_encode($dataArray);
    	$jsonData = '{rows:'.$json.'}';
		exit('{rows:'.$json.'}');
    }
    
    public function checknameAction()
    {
    	$request = $this->getRequst();
    	if($request->isXmlHttpRequest()){
    		$name = $this->params()->fromPost('name');   
    		$field = $this->params()->fromPost('field');
    		if($field=='state'){
    			
    			
    		}
    	}
    	
    }

    public function updatestatusAction()
    {
    	$adminModel = $this->getServiceLocator()->get('Application\Model\Admin');
    	$action = $this->params()->fromPost('action');
    	$id = $this->params()->fromPost('id');
    	
    	$data = array(
    		'is_active'	=> 	($action=='active') ? 1 : 0,
    	);
    	$where = array(
    		'id'	=> 	$id,
    	);
    	
    	if($action=='delete')
    		$adminModel->deleteanywhere('states',$where);
    	else
    		$adminModel->updateanywhere('states',$data,$where);
    	
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
}
