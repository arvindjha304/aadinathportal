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
use Zend\Mail;



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
        $residentialPrjcts = $indexModel->projectByCategory(1);
        $view->setVariable('residentialPrjcts', $residentialPrjcts);
        $commercialPrjcts = $indexModel->projectByCategory(2);
        $view->setVariable('commercialPrjcts', $commercialPrjcts);
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
            $container->propcategory    = $this->params()->fromPost('propcategory');
            $container->minprice        = $this->params()->fromPost('minprice');
            $container->maxprice        = $this->params()->fromPost('maxprice');
            $container->viewType        = 'list';
            $container->projectBanner   = $this->getModel()->projectBanner(2);
            return $this->redirect()->toUrl('project-list');
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
        $container->propcategory    = '';
        $container->minprice        = '';
        $container->maxprice        = '';
        $container->viewType        = 'list';
        $container->projectBanner   = $this->getModel()->projectBanner(2);
        return $this->redirect()->toUrl('project-list');
    }
    public function projectListAction()
    {
        $view = new ViewModel();
        $model = $this->getModel();
        $this->layout('layout/innersearchlayout');
        $container = new Container('searchSessionFields');
        $city_id         = $container->cities;
        $propcategory_id = $container->propcategory;
        $minprice        = $container->minprice;
        $maxprice        = $container->maxprice;
        $refineSearchArr = $this->params()->fromQuery();
//        print_r($refineSearchArr);exit;
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
//       echo '<pre>';print_r($searchResultArr);exit;        
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
        
        $max_floor_plan = $this->getModel()->max_floor_plan_price($projectDetail['project_id']);
        $min_floor_plan = $this->getModel()->min_floor_plan_price($projectDetail['project_id']);                
        $view->setVariable('max_floor_plan', $max_floor_plan);       
        $view->setVariable('min_floor_plan', $min_floor_plan);
                
        $amenitiesArr = $model->getProjectAmenities($projectDetail['amenities']);
        $view->setVariable('amenitiesArr', $amenitiesArr);
        $countProjects = $this->getModel()->countProjects($projectDetail['bldId']);
        $view->setVariable('totalProject', $countProjects['totalProject']);
        $view->setVariable('ongoingProject', $countProjects['ongoingProject']);
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
    
    
    public function htmlmailAction(){
        $to_email='arvindjha304@gmail.com';
        $to_name='Arvind Jha';
        $subject='Test mail 24 July';
        $body='This id a dummy text.';
        $htmltext = '<b>heii, <i>sorry</i>, i\'m going late</b>';
        $this->getModel()->sendmail($to_email,$to_name,$subject,$body);
        
        
//        exit;
        
        $this->getModel()->sendmailHTML($to_email,$to_name,$subject,$htmltext);
        
        exit;
        
    //    $_SERVER[HTTP_HOST] => localhost
        
        
    //    echo '<PRE>';PRINT_R($_SERVER);exit;
        
//        $message = new \Zend\Mail\Message();
//        $message->addTo('arvindjha304@gmail.com')
//            ->addFrom('arvindjha304@gmail.com')
//            ->setSubject('Test send mail using ZF2');
//
//        // Setup SMTP transport using LOGIN authentication
//        $transport = new \Zend\Mail\Transport\Smtp();
//        $options   = new \Zend\Mail\Transport\SmtpOptions(array(
//            'host'              => 'smtp.gmail.com',
//            'connection_class'  => 'login',
//            'connection_config' => array(
//                'ssl'       => 'tls',
//                'username' => 'test00455@gmail.com',
//                'password' => 'Test@1423'
//            ),
//            'port' => 587,
//        ));
//
//        $html = new \Zend\Mime\Part('<b>heii, <i>sorry</i>, i\'m going late</b>');
//        $html->type = "text/html";
//
//        $body = new \Zend\Mime\Message();
//        $body->addPart($html);
//
//        $message->setBody($body);
//
//        $transport->setOptions($options);
//        $transport->send($message);
//
//        exit;


//        $message = new \Zend\Mail\Message();
//
//        $message->setBody('This is the body');
//        $message->setFrom('enjoylife304@gmail.com');
//        $message->addTo('arvindjha304@gmail.com');
//        $message->setSubject('Test subject');
//
//        $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
//
//        $smtpOptions->setHost('smtp.gmail.com')
//                    ->setConnectionClass('login')
//                    ->setName('smtp.gmail.com')
//                    ->setConnectionConfig(array(
//                            'username' => 'test00455@gmail.com',
//                            'password' => 'Test@1423',
//                            'ssl' => 'tls',
//                        )
//                    );
//
//        $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
//        $transport->send($message);
//
//
//
//
//        exit;

//        $mail = new \Zend\Mail\Message();
//        $mail->setBody('This is the text of the email.');
//        $mail->setFrom('admin@aadinathindia.com', 'Admin');
//        $mail->addTo('arvindjha304@gmail.com', 'Arvind Jha');
//        $mail->setSubject('TestSubject');
//
//        $transport = new \Zend\Mail\Transport\Sendmail();
//        
//        $transport->send($mail);
//        
//        exit;
        
//        $to = "arvindjha304@gmail.com";
//        $subject = "My subject";
//        $txt = "Hello world!";
//        $headers = "From: webmaster@example.com" . "\r\n" .
//        "CC: somebodyelse@example.com";
//
//        mail($to,$subject,$txt,$headers);
//
//        exit;
        
        
//        $userid='1';
//        $name='Arvind Jha';
//        $create_date=date("Y-m-d H:i:s");
//        $useremail='arvind@gmail.com';
//        $contact='2314568970';
//        $project='1';
//        $mes='messagemessagemessage';
//        $subject ="Amaatra Homes";
//        $source = '9';
//        $adminemail ="arvindjha304@gmail.com";
//        $message = "<table width='50%' border='0' cellspacing='8' cellpadding='4' align='center' style='border:#00CCFF solid 3px; color:#333333;'>
//         <tr>
//           <td><div>
//
//               <div>&nbsp;</div>
//
//               <div><b>Name : ".$name."</b></div>
//
//               <div>&nbsp;</div>
//         <div><b>Email : ".$useremail."</b></div>
//         <div>&nbsp;</div>
//         <div><b>Phone Number : ".$contact."</b></div>
//         <div>&nbsp;</div>
//         <div><b>Message : ".$mes."</b></div>
//         <div>&nbsp;</div>
//         <div><b>Subject : ".$subject."</b></div>
//         <div>&nbsp;</div>
//
//
//       </div></td>
//         </tr>
//       </table>";
//          
//            $headers  = 'MIME-Version: 1.0' . "\r\n";
//         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//         $headers  = 'MIME-Version: 1.0' . "\r\n";
//         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//         $headers .= 'From:Admin'. "\r";
//         $headers .= 'otp@drproperty.in'. "\r\n";
//
//echo 'AAAABBBB';exit;
//           if(mail($adminemail, $subject, $message, $headers)){
//               echo 'Your mail has been sent successfully.';
//           } else{
//               echo 'Unable to send email. Please try again.';
//           }
//       exit;
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
//               $htmlBody = '<b>Hello World</b>';
//               $textBody = 'mail';
//               $subject = 'Test Mail';
//               $from = 'arvind@idi.com';
//               $to  = 'arvindjha304@gmail.com';
//                
//                $this->getModel()->sendMail($htmlBody, $textBody, $subject, $from, $to);
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
    public function mapsearchAction()
    {
        $view = new ViewModel();
        $this->layout('layout/searchmaplayout');
        return $view;
    }
    public function projectSearchAction()
    {
        $searchStr = $this->params()->fromPost('searchStr');
        $result=$this->getModel()->projectSearchData($searchStr);
        $str = json_encode($result);
        exit($str);  
    }
    
}
