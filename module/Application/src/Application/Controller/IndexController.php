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
        return $view;
    }
    public function buyAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $table= new TableGateway('cities',$this->getAdapter());
        $result = $table->select(array('is_active'=>1))->toArray();
        $view->setVariable('cities', $result);
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
            $container->propcategory    = $this->params()->fromPost('propcategory');
            $container->minprice        = $this->params()->fromPost('minprice');
            $container->maxprice        = $this->params()->fromPost('maxprice');
            $container->viewType        = 'list';
            $container->projectBanner   = $this->getModel()->projectBanner(2);
            return $this->redirect()->toUrl('project-list');
        }
        return $view;
    }
    public function projectListAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innersearchlayout');
        $container = new Container('searchSessionFields');
        $city_id         = $container->cities;
        $propcategory_id = $container->propcategory;
        $minprice        = $container->minprice;
        $maxprice        = $container->maxprice;
        $refineSearchArr = $this->params()->fromQuery();
//        print_r($refineSearchArr);exit;
        $view->setVariable('viewType',$container->viewType);
        $view->setVariable('possession',(isset($refineSearchArr['possession'])) ? $refineSearchArr['possession'] : '');
        $view->setVariable('propertyType',(isset($refineSearchArr['propertyType'])) ? $refineSearchArr['propertyType'] : '');
        $view->setVariable('budget',(isset($refineSearchArr['budget'])) ? $refineSearchArr['budget'] : '');
        $view->setVariable('bedroom',(isset($refineSearchArr['bedroom'])) ? $refineSearchArr['bedroom'] : '');
       // echo '<pre>';print_r($refineSearchArr);exit;
        $model = $this->getModel();
        $table = new TableGateway('property_type',$this->getAdapter());
        $propertyTypeArr = $table->select(array('property_category_id'=>$propcategory_id,'is_active'=>1))->toArray(); 
        $view->setVariable('propertyTypeArr', $propertyTypeArr);
        $searchResultArr = $model->searchResultData($city_id,$propcategory_id,$minprice,$maxprice,$refineSearchArr);
        $view->setVariable('searchResultArr', $searchResultArr);
//        echo '<pre>';print_r($searchResultArr);exit;
        
        return $view;
    }
//    public function projectGridAction()
//    {
//        $view = new ViewModel();
//        $this->layout('layout/innersearchlayout');
//        $container = new Container('searchSessionFields');
//        $city_id         = $container->cities;
//        $propcategory_id = $container->propcategory;
//        $minprice        = $container->minprice;
//        $maxprice        = $container->maxprice;
//      
//        $model = $this->getModel();
//        $searchResultArr = $model->searchResultData($city_id,$propcategory_id,$minprice,$maxprice,'');
//        $view->setVariable('searchResultArr', $searchResultArr);
//        return $view;
//    }
    
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
        $id = $this->params()->fromQuery('id');
        $model = $this->getModel();
        $projectDetail = $model->getProjectDetail($id);
        $view->setVariable('projectDetail', $projectDetail);
        $floor_plans = $model->getProjectFloorPlan($id);
        $view->setVariable('floor_plans', $floor_plans);
        $amenitiesArr = $model->getProjectAmenities($projectDetail['amenities']);
        $view->setVariable('amenitiesArr', $amenitiesArr);
        
//         echo '<pre>';print_r($floor_plans);exit;
        
        $floorSizeArr = $floorPriceArr = array();
        foreach($floor_plans as $floor_plan){
            $floorSizeArr[] = $floor_plan['size'];
            $floorPriceArr[] = $floor_plan['price'];
        }
        $view->setVariable('floorSizeArr', $floorSizeArr);
        $view->setVariable('floorPriceArr', $floorPriceArr);
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
        $id=$this->params()->fromQuery('id');
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
    
}
