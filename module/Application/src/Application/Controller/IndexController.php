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
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;
use Zend\Authentication\AuthenticationService;



class IndexController extends AbstractActionController
{
    public function getAdapter(){
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }
    public function getModel(){
        return  $this->getServiceLocator()->get('Application\Model\Index');
    }
    public function indexAction()
    {
        $view = new ViewModel();
        $this->layout('layout/indexlayout');
        $indexModel = $this->getModel();
        $homeBannerArr = $indexModel->homepagebanners();
        $view->setVariable('randomhomeBanner', array_rand($homeBannerArr));
        $view->setVariable('homeBannerArr', $homeBannerArr);
        $hotdealbanner = $indexModel->projectBanner(1);
        $view->setVariable('hotdealbanner', $hotdealbanner);
//        $residentialPrjcts = $indexModel->projectByCategory(1);
//        $view->setVariable('residentialPrjcts', $residentialPrjcts);
//        $commercialPrjcts = $indexModel->projectByCategory(2);
//        $view->setVariable('commercialPrjcts', $commercialPrjcts);
        
        $allTestimonials = $indexModel->allTestimonials();
        $view->setVariable('allTestimonials', $allTestimonials);
        return $view;
    }
    public function buyAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
//        $table= new TableGateway('cities',$this->getAdapter());
//        $result = $table->select(array('is_active'=>1,'is_delete'=>0))->toArray();
        $view->setVariable('cities', $this->getModel()->getCityList());
        $table= new TableGateway('property_category',$this->getAdapter());
        $result = $table->select(array('is_active'=>1))->toArray();
        $view->setVariable('propertyCategory', $result);
        $request = $this->getRequest();
        if($request->isPost()){
//           echo '<pre>';print_r($this->params()->fromPost());exit;
            $config = new StandardConfig();
            $config->setOptions(array(
                'remember_me_seconds' => 1800,
                'name'                => 'zf2',
            ));
            $manager = new SessionManager($config);
            $container = new Container('searchSessionFields',$manager);
            $container->cities          = $this->params()->fromPost('cities');
            $container->searchCityName  = $this->getModel()->getCityName($container->cities);
            $container->propcategory    = $this->params()->fromPost('propcategory');
            $container->minprice        = $this->params()->fromPost('minprice');
            $container->maxprice        = $this->params()->fromPost('maxprice');
            $container->viewType        = 'list';
            $container->projectBanner   = $this->getModel()->projectBanner(2);
            return $this->redirect()->toRoute('projects-in-'.strtolower($container->searchCityName));
        }
        return $view;
    }
    public function projectbycityAction(){
        $config = new StandardConfig();
        $config->setOptions(array(
            'remember_me_seconds' => 1800,
            'name'                => 'zf2',
        ));
        $manager = new SessionManager($config);
        $container = new Container('searchSessionFields',$manager);
        $container->cities          = $this->params()->fromQuery('cityId');
        $container->searchCityName  = ($container->cities !='' ) ? $this->getModel()->getCityName($container->cities) : '';
        $container->propcategory    = $this->params()->fromQuery('propCatId');
        $container->minprice        = '';
        $container->maxprice        = '';
        $container->viewType        = 'list';
        $container->projectBanner   = $this->getModel()->projectBanner(2);
        return $this->redirect()->toRoute('projects');
    }
    public function projectListAction()
    {
        $view = new ViewModel();
        $model = $this->getModel();
        $this->layout('layout/innersearchlayout');
        $container = new Container('searchSessionFields');
        
        if(!is_numeric($container->cities)){
            $config = new StandardConfig();
            $config->setOptions(array(
                'remember_me_seconds' => 1800,
                'name'                => 'zf2',
            ));
            $manager = new SessionManager($config);
            $container = new Container('searchSessionFields',$manager);
            $container->projectBanner   = $this->getModel()->projectBanner(2);
        }
        
        $city_id         = (is_numeric($container->cities)) ? $container->cities : '';
        $propcategory_id = (is_numeric($container->propcategory)) ? $container->propcategory : '';
        $minprice        = (is_numeric($container->minprice)) ? $container->minprice : '';
        $maxprice        = (is_numeric($container->maxprice)) ? $container->maxprice : '';
        $refineSearchArr = $this->params()->fromQuery();
//        echo '<pre>';print_r($container);exit;
        $view->setVariable('cityName',$model->getCityName($city_id));
        $view->setVariable('viewType',$container->viewType);
        $view->setVariable('possession',(isset($refineSearchArr['possession'])) ? $refineSearchArr['possession'] : '');
        $view->setVariable('propertyType',(isset($refineSearchArr['propertyType'])) ? $refineSearchArr['propertyType'] : '');
        $view->setVariable('budget',(isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '');
        $view->setVariable('bedroom',(isset($refineSearchArr['bedroom'])) ? $refineSearchArr['bedroom'] : '');
//        echo '<pre>';print_r($refineSearchArr);exit;
        
        $table = new TableGateway('property_type',$this->getAdapter());
        $propertyTypeArr = $table->select(array('property_category_id'=>$propcategory_id,'is_active'=>1))->toArray(); 
        $view->setVariable('propertyTypeArr', $propertyTypeArr);
        $searchResultArr = $model->searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr);
        $view->setVariable('searchResultArr', $searchResultArr);
//        echo '111';exit;
//       echo '<pre>';print_r($searchResultArr);exit;  
        return $view;
}

    public function changesearchviewAction(){
        
        $container = new Container('searchSessionFields');
        $container->viewType = $this->params()->fromPost('viewType');
        $city_id         = $container->cities;
        $propcategory_id = $container->propcategory;
        $minprice        = $container->minprice;
        $maxprice        = $container->maxprice;
        $refineSearchArr = array(
            'possession'    => $this->params()->fromPost('PossessionFilters'),
            'propertyType'  => $this->params()->fromPost('PropertyTypeFilters'),
            'budget'        => $this->params()->fromPost('BudgetFilters'),
            'bedroom'       => $this->params()->fromPost('BedroomFilters')
        );
        $model = $this->getModel();
        $searchResultArr = $model->searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr);
        exit(json_encode($searchResultArr));
    }
    
    public function projectDetailAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
//        $id = $this->params()->fromQuery('id');
        $slug = $this->params()->fromRoute('slug');
        $id = $this->getModel()->getIdFromSlug('projects','projectSlug',$slug);
        $model = $this->getModel();
        $projectDetail = $model->getProjectDetail($id); 
        $view->setVariable('projectDetail', $projectDetail);
        $floor_plans = $model->getProjectFloorPlan($id);
        $view->setVariable('floor_plans', $floor_plans);
        
        $this->getModel()->recently_viewed($id);
        
//        echo '<pre>';print_r($floor_plans);exit;
        
        $max_floor_plan = $this->getModel()->max_floor_plan_price($projectDetail['project_id']);
        $min_floor_plan = $this->getModel()->min_floor_plan_price($projectDetail['project_id']);                
        $view->setVariable('max_floor_plan', $max_floor_plan);       
        $view->setVariable('min_floor_plan', $min_floor_plan);
        $similarProjects = $this->getModel()->searchProjects($projectDetail['city'],'','','','');                
        $view->setVariable('similarProjects', $similarProjects);
        $amenitiesArr = $model->getProjectAmenities($projectDetail['amenities']);
        $view->setVariable('amenitiesArr', $amenitiesArr);
        $countProjects = $this->getModel()->countProjects($projectDetail['bldId']);
        $view->setVariable('totalProject', $countProjects['totalProject']);
        $view->setVariable('ongoingProject', $countProjects['ongoingProject']);
//         echo '<pre>';print_r($floor_plans);exit;
        $maxMinFloorSize = $this->getModel()->maxMinFloorSize($projectDetail['project_id'],'','');
//        $floorSizeArr = $floorPriceArr = array();
//        foreach($floor_plans as $floor_plan){
//            $floorSizeArr[] = $floor_plan['size'];
//            $floorPriceArr[] = $floor_plan['price'];
//        }
//        $view->setVariable('floorSizeArr', $floorSizeArr);
        $view->setVariable('maxMinFloorSize', $maxMinFloorSize);
        return $view;
    }
    
    public function getcallbackAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $data = array(
                'project_id'    => $this->params()->fromPost('project_id'),
                'email'         => $this->params()->fromPost('email'),
                'mobile'        => $this->params()->fromPost('mobile'),
                'date_created'  => date('Y-m-d H-i-s'),
            );
            if($data['mobile']!=''){
                $this->getModel()->insertanywhere('callback_interested_users', $data);
                $this->getModel()->sendNewsLetter($data);
                $this->getModel()->enquired_properties($data['project_id']);
            } 
            exit(1);
        }
    }
    public function buildersAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $builderTable = new TableGateway('builders',$this->getAdapter());
        $allBuilder = $builderTable->select(array('is_active'=>1,'is_delete'=>0))->toArray();
        $ii=0;$builderArr = array();
        if(count($allBuilder)){
            foreach ($allBuilder as $builder){
                $countProjects = $this->getModel()->countProjects($builder['id']);
                if($countProjects['totalProject']>0){
                    $builderArr[$ii] = $builder;
                    $builderArr[$ii]['totalProject']    = $countProjects['totalProject'];
                    $builderArr[$ii]['ongoingProject']  = $countProjects['ongoingProject'];
                    $ii++;
                }
            }
        }
        $view->setVariable('builderArr', $builderArr);
        return $view;
    }
    public function builderDetailAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innersearchlayout');
        $builderSlug = $this->params()->fromRoute('slug');
        $id = $this->getModel()->getIdFromSlug('builders','builderSlug',$builderSlug);
        if(isset($id) && $id!=''){
            
            $table = new TableGateway('builders',$this->getAdapter());
            $builderDetail = $table->select(array('id'=>$id))->toArray();
            $view->setVariable('builderDetail', $builderDetail);
            $container = new Container('searchSessionFields');
            $refineSearchArr = $this->params()->fromQuery();
//            if($container->offsetExists('viewType')){
//                $view->setVariable('viewType',$container->viewType);
//            }
            $view->setVariable('possession',(isset($refineSearchArr['possession'])) ? $refineSearchArr['possession'] : '');
            $view->setVariable('propertyType',(isset($refineSearchArr['propertyType'])) ? $refineSearchArr['propertyType'] : '');
            $view->setVariable('budget',(isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '');
            $view->setVariable('bedroom',(isset($refineSearchArr['bedroom'])) ? $refineSearchArr['bedroom'] : '');
            $builderId = $builderDetail[0]['id'];  
            $searchResultArr = $this->getModel()->searchResultData('','','','',$refineSearchArr,$builderId);
            $countProjects = $this->getModel()->countProjects($builderId);
            $view->setVariable('totalProject', $countProjects['totalProject']);
            $view->setVariable('ongoingProject', $countProjects['ongoingProject']);
         //   echo '<pre>';print_r($searchResultArr);exit;
            $view->setVariable('searchResultArr', $searchResultArr);
            $view->setVariable('viewType', 'list');
        }
        return $view;
    }
    public function mapsearchAction()
    {
        $view = new ViewModel();
        $this->layout('layout/searchmaplayout');
        $container = new Container('searchSessionFields');
        
        $city_id         = (is_numeric($container->cities)) ? $container->cities : '';
        $propcategory_id = (is_numeric($container->propcategory)) ? $container->propcategory : '';
        $minprice        = (is_numeric($container->minprice)) ? $container->minprice : '';
        $maxprice        = (is_numeric($container->maxprice)) ? $container->maxprice : '';
        $refineSearchArr = $this->params()->fromQuery();
//        echo '<pre>';print_r($container);exit;
        $view->setVariable('cityName',$this->getModel()->getCityName($city_id));
        $view->setVariable('viewType',$container->viewType);
        $view->setVariable('possession',(isset($refineSearchArr['possession'])) ? $refineSearchArr['possession'] : '');
        $view->setVariable('propertyType',(isset($refineSearchArr['propertyType'])) ? $refineSearchArr['propertyType'] : '');
        $view->setVariable('budget',(isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '');
        $view->setVariable('bedroom',(isset($refineSearchArr['bedroom'])) ? $refineSearchArr['bedroom'] : '');
//        echo '<pre>';print_r($refineSearchArr);exit;
        $table = new TableGateway('property_type',$this->getAdapter());
        $propertyTypeArr = $table->select(array('property_category_id'=>$propcategory_id,'is_active'=>1))->toArray(); 
        $view->setVariable('propertyTypeArr', $propertyTypeArr);
        $searchResultArr = $this->getModel()->searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr);
        
        
//        echo '<pre>';print_r($searchResultArr);exit;
        
        $view->setVariable('searchResultArr', $searchResultArr);
        $view->setVariable('searchResultJsonArr', json_encode($searchResultArr));
//       echo '<pre>';print_r($searchResultArr);exit;  
        return $view;
    }
    public function projectSearchAction()
    {
        $searchStr = $this->params()->fromPost('searchStr');
        $result=$this->getModel()->projectSearchData($searchStr);
        $str = json_encode($result);
        exit($str);  
    }
    public function addcompareAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $projectId       = $this->params()->fromPost('project_id');
            $container       = new Container('compareProjects');
            $container->allCompareProjects   = $this->params()->fromPost('allCompareProjects');
            $prjArr = $this->getModel()->getProjectToCompare();
            exit(json_encode($prjArr)); 
        }
    }
    
    public function getprojectinfoAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $projectId      = $this->params()->fromPost('project_id');
            $projectDetail  = $this->getModel()->getProjectDetail($projectId);
            $amenitiesArr   = $this->getModel()->getProjectAmenities($projectDetail['amenities']);
            $max_floor_plan = $this->getModel()->max_floor_plan_price($projectDetail['project_id']);
            $min_floor_plan = $this->getModel()->min_floor_plan_price($projectDetail['project_id']); 
            $min_floor_plan_price = $this->getModel()->min_floor_plan_price($projectId,'','');
            exit(json_encode(['projectDetail'=>$projectDetail,'amenitiesArr'=>$amenitiesArr,'max_floor_plan'=>$max_floor_plan,'min_floor_plan'=>$min_floor_plan,'min_floor_plan_price'=>$min_floor_plan_price,]));
        }
        
    }
    public function compareProjectAction(){
        
        $container       = new Container('compareProjects');
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $toCompareProjects = $container->allCompareProjects;
        $compPrjArr = [];
        foreach($toCompareProjects as $project_id){
            $tempArr = [];
            $projectDetail = $this->getModel()->getProjectDetail($project_id);
            $tempArr[] = $projectDetail;
            $tempArr['maxMinFloorSize'] = $this->getModel()->maxMinFloorSize($project_id);
            $tempArr['max_floor_plan_price'] = $this->getModel()->max_floor_plan_price($project_id);
            $tempArr['min_floor_plan_price'] = $this->getModel()->min_floor_plan_price($project_id);
            $tempArr['getProjectFloorPlan'] = $this->getModel()->getProjectFloorPlan($project_id);
            $compPrjArr[] = $tempArr;
        }
//         echo '<pre>';print_r($compPrjArr);exit;
        $view->setVariable('compPrjArr', $compPrjArr);
        return $view;
    }
    
    public function getFloorPlanInfoAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $project_id  = $this->params()->fromPost('project_id');
            $floorPlanId = $this->params()->fromPost('floorPlanId');
            $tempArr = [];
            if($floorPlanId==''){
                $tempArr['maxMinFloorSize'] = $this->getModel()->maxMinFloorSize($project_id);
                $tempArr['max_floor_plan_price'] = $this->getModel()->max_floor_plan_price($project_id);
                $tempArr['min_floor_plan_price'] = $this->getModel()->min_floor_plan_price($project_id);
                $allFloorPlan     = $this->getModel()->getProjectFloorPlan($project_id);
                $tempArr['countFloorPlan']     = count($allFloorPlan);
            }else{
                $table = new TableGateway('project_floor_plan',$this->getAdapter());
                $floorPlanDetail = $table->select(array('id'=>$floorPlanId))->toArray();
//                exit(json_encode($floorPlanDetail));
                $tempArr['floorPlanDetail'] = $floorPlanDetail[0];
                //echo '<pre>';print_r($tempArr['floorPlanDetail']);exit;
            }
            exit(json_encode($tempArr));
        }
    }
    
    public function vaastuTipsAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        return $view;
    } 
    public function emiAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        return $view;
    } 
    public function faqAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        return $view;
    } 
    public function homeLoanAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        return $view;
    } 
    public function nriAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        return $view;
    }
    public function aboutUsAction(){
        $view = new ViewModel();
        $this->layout('layout/indexlayout');
        return $view;
    }
    public function contactUsAction(){
        $view = new ViewModel();
        $this->layout('layout/indexlayout');
        return $view;
    }
    public function careersAction(){
        $view = new ViewModel();
        $this->layout('layout/indexlayout');
        return $view;
    }
}
