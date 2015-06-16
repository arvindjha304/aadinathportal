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
         $view->setVariable('aboutUsData', $indexModel->getAboutUs());
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
            //echo '<pre>';print_r($this->params()->fromPost());exit;
           $city_id         = $this->params()->fromPost('cities');
           $propcategory_id = $this->params()->fromPost('propcategory');
           $minprice        = $this->params()->fromPost('minprice');
           $maxprice        = $this->params()->fromPost('maxprice');
           
            $container = new Container('searchSessionFields');
            
            $container->cities          = $city_id;
            $container->propcategory    = $propcategory_id;
            $container->minprice        = $minprice;
            $container->maxprice        = $maxprice;
            return $this->redirect()->toUrl('project-list');
           
           
           
        }
        return $view;
    }
    public function projectListAction()
    {
        $view = new ViewModel();
        $this->layout('layout/innersearchlayout');
        $request = $this->getRequest();
        $container = new Container('searchSessionFields');
        $city_id         = $container->cities;
        $propcategory_id = $container->propcategory;
        $minprice        = $container->minprice;
        $maxprice        = $container->maxprice;
        $model = $this->getModel();
        $searchResult = $model->searchProjects($city_id,$propcategory_id,$minprice,$maxprice);
        $searchResultArr = array();
        $count = 0;
        foreach($searchResult as $search){
            $project_id = $search['project_id'];
            $table = new TableGateway('project_floor_plan',$this->getAdapter());
//            $floor_plans = $table->select(array('project_id'=>$project_id))->toArray();
            
            $floor_plans = $table->select(function($select) use ($project_id){
                $select->order('size ASC');
                $select->where->equalTo('project_id',$project_id);
            })->toArray();
            
//        if(count($floor_plans)){
            $search['floor_plans'] = $floor_plans;
            $searchResultArr[$count] = $search;
            $count++;
//         }
        }

        $view->setVariable('searchResultArr', $searchResultArr);
        //           echo '<pre>';print_r($searchResultArr);
        //           exit;
        
        return $view;
    }
    public function projectGridAction()
    {
        
//        echo '11111';exit;
         $view = new ViewModel();
         $this->layout('layout/innersearchlayout');
//         $indexModel = $this->getServiceLocator()->get('Application\Model\Index');
//         $view->setVariable('aboutUsData', $indexModel->getAboutUs());
         return $view;
    }
}
