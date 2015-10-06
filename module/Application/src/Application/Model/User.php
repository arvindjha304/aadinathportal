<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Session\Container;



 class User extends AbstractTableGateway implements ServiceLocatorAwareInterface {

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
	public function lastInsertId($mytable, array $data) {
		$db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$table = new TableGateway($mytable, $db);
		$table->insert($data);
        $id = $table->lastInsertValue;
        return $id;
	}
    public function forgotPasswordMail($userId,$user_email){
        $baseUrl = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface')->basePath();
        $indexModel = $this->getServiceLocator()->get('Application\Model\Index');
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Reset Password</title>
        </head>
        <body style="margin:0; padding:0;">
        <table width="640" border="0" cellpadding="0" cellspacing="0"  bgcolor="#fff" style="margin:auto; border:3px solid #02753e;">
        <tr>
        <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold;padding:10px;color:#fff;background-color:#02753e;"><a href="http://aadinathindia.com/front-end/user/reset-password?user='.base64_encode($userId).'">Click</a> this to reset your password.</td>
        </tr>
        </table>
        </body>
        </html>'; 
        $subject = 'Reset Password Link';
       $indexModel->sendmailHTML($user_email,'',$subject,$html);
       return 1;
    }
    public function verifyMailLink($userId,$user_email){	
		$baseUrl = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface')->basePath();
        $indexModel = $this->getServiceLocator()->get('Application\Model\Index');
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Reset Password</title>
        </head>
        <body style="margin:0; padding:0;">
        <pre>
        Hello User
        
        Welocme to Aadinath India. To activate your account and verify your email, please click <a href="http://aadinathindia.com/front-end/user/email-verification?user='.base64_encode($userId).'">this</a> link.
           
        Thanks
        Aadinath India Team
        </pre>
        </body>
        </html>'; 
        $subject = 'Aadinath India Email Verification';
       $indexModel->sendmailHTML($user_email,'',$subject,$html);
       return 1;
	}
    public function checkIfEmailExist($email){
        $table = new TableGateway('userlist',$this->getAdapter());
        $userData = $table->select(['useremail'=>$email,'is_active'=>1,'is_delete'=>0])->toArray();
        return $userData;
    }
    
    public function getRecentlyViewed($userId){
        $indexModel = $this->getServiceLocator()->get('Application\Model\Index');
        $table = new TableGateway('recently_viewed_project',$this->getAdapter());
        $result = $table->select(function($select) use($userId){
            $select->join(['prj'=>'projects'],'recently_viewed_project.project_id=prj.id',['project_title','projectSlug'])
                ->join(['ct'=>'cities'],'ct.id=prj.city',['id','city_name'])
                ->join(['lc'=>'locations'],'lc.id=prj.location',['id','location_name']);
            $select->where(array('recently_viewed_project.user_id'=>$userId));    
        })->toArray();
        $prjArr = [];
        if(count($result)){
            foreach ($result as $res){
                $project_id = $res['project_id'];
                $res['max_floor_plan_price'] = $indexModel->max_floor_plan_price($project_id,'','');
                $res['min_floor_plan_price'] = $indexModel->min_floor_plan_price($project_id,'','');
//              echo '<pre>';print_r($floorPlanMainArr);exit;
                $maxMinFloorSize = $indexModel->maxMinFloorSize($project_id,'','');
                $res['max_floor_plan_size']   = $maxMinFloorSize['maxFloorSize'];
                $res['min_floor_plan_size']   = $maxMinFloorSize['minFloorSize'];
                $prjArr[] = $res;
                
            }
        }
        return $prjArr;
    }
    public function getEnquiredProperties($userId){
        $indexModel = $this->getServiceLocator()->get('Application\Model\Index');
        $table = new TableGateway('enquired_projects',$this->getAdapter());
        $result = $table->select(function($select) use($userId){
            $select->join(['prj'=>'projects'],'enquired_projects.project_id=prj.id',['project_title','projectSlug'])
                ->join(['ct'=>'cities'],'ct.id=prj.city',['id','city_name'])
                ->join(['lc'=>'locations'],'lc.id=prj.location',['id','location_name']);
            $select->where(array('enquired_projects.user_id'=>$userId));    
        })->toArray();
        $prjArr = [];
        if(count($result)){
            foreach ($result as $res){
                $project_id = $res['project_id'];
                $res['max_floor_plan_price'] = $indexModel->max_floor_plan_price($project_id,'','');
                $res['min_floor_plan_price'] = $indexModel->min_floor_plan_price($project_id,'','');
//              echo '<pre>';print_r($floorPlanMainArr);exit;
                $maxMinFloorSize = $indexModel->maxMinFloorSize($project_id,'','');
                $res['max_floor_plan_size']   = $maxMinFloorSize['maxFloorSize'];
                $res['min_floor_plan_size']   = $maxMinFloorSize['minFloorSize'];
                $prjArr[] = $res;
                
            }
        }
        return $prjArr;
    }
	
    public function getCities($searchStr){
		$db =$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$sql = new Sql($db);
        $where = new Where();
		$select = $sql->select()
        ->columns(array('id','city_name','is_active'))
		->from(array('ct'=>'cities'))
		->join(array('st'=>'states'),'ct.state_id=st.id',array('state_name'));
        $where->like('ct.city_name','%'.$searchStr.'%');
        $select->where($where);
        $select->where(array('ct.is_delete'=> '0','st.is_delete'=> '0','ct.is_active'=> '1','st.is_active'=> '1'));
		$result = $sql->prepareStatementForSqlObject($select)->execute();
		return $result;
	}
    
    public function searchProject($searchStr,$cityId){
        //echo $cityId;exit;
        $db = $this->getAdapter(); 
        $where = new Where();
        $sql = new Sql($db);
        $select= $sql->select()
        ->columns(['id as prjId','project_title','projectSlug','city'])
		->from(['prj'=>'projects'])
        ->join(['ct'=>'cities'],'ct.id=prj.city',[])
        ->join(['st'=>'states'],'st.id=ct.state_id',[])
        ->join(['pptId'=>'property_type'], 'pptId.id=prj.property_type_id',[])
        ->join(['pptCatId'=>'property_category'], 'pptCatId.id=pptId.property_category_id',[])
        ->join(['bld'=>'builders'],'prj.builder=bld.id',[]); 
        $where->like('prj.project_title','%'.$searchStr.'%');
        $select->where($where);
        $select->where(array('prj.is_active'=>1,'prj.is_delete'=>0,'ct.is_active'=>1,'ct.is_delete'=>0,'st.is_active'=>1,'st.is_delete'=>0,'pptId.is_active'=>1,'pptId.is_delete'=>0,'pptCatId.is_active'=>1,'bld.is_active'=>1,'bld.is_delete'=>0,'prj.city'=>$cityId));
        $prjList = $sql->prepareStatementForSqlObject($select)->execute();
        $projectArr = [];
        foreach($prjList as $res){
            if(count($res))
                $projectArr[] = ['prj_id'=>$res['prjId'],'city_id'=>$res['city'],'project_title'=>trim($res['project_title'])];
        }  
//      echo '<pre>';print_r($projectArr);exit;
        return $projectArr;
    }
    
    public function getFloorPlans($project_id,$floor_plan_id=''){
        $table = new TableGateway('project_floor_plan',$this->getAdapter());
        $floor_plans = $table->select(function($select) use ($project_id,$floor_plan_id){
            $select->where->equalTo('project_id',$project_id);
            $select->where(array('is_active'=>1,'is_delete'=>0));
//            if($minprice!='' && $maxprice!='')
//            $select->where->between('search_price',$minprice,$maxprice);
            $select->order(array('bhk_type ASC', 'size ASC'));
        })->toArray();
        return $floor_plans;
    }
    
    public function getProjectDetails($prjId){
        $db = $this->getAdapter(); 
        $where = new Where();
        $sql = new Sql($db);
        $select= $sql->select()
        ->columns(['id as prjId','project_title','projectSlug','city'])
		->from(['prj'=>'projects'])
        ->join(['ct'=>'cities'],'ct.id=prj.city',['city_name']) 
        ->join(['lc'=>'locations'],'lc.id=prj.location',['location_name'])
        ->where(array('prj.is_active'=>1,'prj.is_delete'=>0,'ct.is_active'=>1,'ct.is_delete'=>0,'lc.is_active'=>1,'lc.is_delete'=>0,'prj.id'=>$prjId));
        $prjList = $sql->prepareStatementForSqlObject($select)->execute();
        $projectArr = [];
        foreach($prjList as $res){
            if(count($res))
                $projectArr[] = ['prj_id'=>$res['prjId'],'project_title'=>trim($res['project_title']),'city_name'=>$res['city_name'],'location'=>$res['location_name']];
        }  
        //echo '<pre>';print_r($projectArr);exit;
      return $projectArr;
    }
    
    
    
    
}