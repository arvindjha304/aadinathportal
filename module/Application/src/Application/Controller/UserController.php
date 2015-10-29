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
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;

class UserController extends AbstractActionController
{
	public function getbaseUrl(){
		$baseUrl = $this->getRequest()->getbaseUrl();
	}
    public function getAdapter(){
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }
    public function getModel(){
        return  $this->getServiceLocator()->get('Application\Model\User');
    }
    public function getUserDetails(){
        $auth = new AuthenticationService();
        if($auth->hasIdentity())
            return $auth->getIdentity(); 
        else
            $this->redirect()->toRoute('homepage');
    }
    public function indexAction(){
        $view = new ViewModel();
        $this->layout('layout/layoutadmin');
        return $view;
    }
    public function userLoginAction(){
        
        if($this->request->isXmlHttpRequest()){
            $useremail = $this->params()->fromPost('userLoginEmail');
            $password = $this->params()->fromPost('userLoginPassword');
            $remember_me = $this->params()->fromPost('remember_me');
            if($useremail!='' && $password!=''){
                $this->userLogin($useremail,$password,$remember_me);
                exit('Login Successfull');
            }
        }
    }
    public function userLogin($useremail,$password,$remember_me=0){
        $authAdapter 	= new AuthAdapter($this->getAdapter(), 'userlist','useremail', 'password', 'CONCAT(?,salt_key) and is_active=1 and is_delete=0  and is_verified=1');
        $authAdapter->setIdentity(trim($useremail));
        $authAdapter->setCredential(base64_encode(trim($password)));
       // $authAdapter->setCredentialTreatment('CONCAT(?,salt_key)');
        $auth = new AuthenticationService();
        $result = $authAdapter->authenticate($authAdapter);
        if ($result->isValid()) {
            if($remember_me ==1){
                setcookie('cookieEmail', $useremail, time() + (86400 * 365), "/");
                setcookie('cookiePswd', $password, time() + (86400 * 365), "/");
            }else{
                setcookie('cookieEmail', $useremail, time() - 86400, "/");
                setcookie('cookiePswd', $password, time() - 86400, "/");
            }
            $data = $authAdapter->getResultRowObject();
            $auth->getStorage()->write($data);
            $identity = $auth->getIdentity();
//            echo '<pre>';
//            print_r($identity);
//            exit;
            if($identity->is_admin==1){
                exit('AdminLogin');
//                $this->redirect()->toRoute('backend');
            }

            exit('LoginSuccessfull');
            return true;	
        }else{
            exit('LoginFailed');
        }
    }

    public function userRegisterAction(){
        if($this->request->isXmlHttpRequest()){
            $userName       = $this->params()->fromPost('userName');
            $userPassword   = $this->params()->fromPost('userPassword');
            $userEmail      = $this->params()->fromPost('userEmail');
            $userMobile     = $this->params()->fromPost('userMobile');
            if($userName!='' && $userPassword!='' && $userEmail!=''){
                $userData = $this->getModel()->checkIfEmailExist($userEmail);
//              echo '<pre>';print_r($userData);exit; 
                if(count($userData)){
                    exit('userexist');
                }else{
                    $id = $this->addUser($userName,$userPassword,$userEmail,$userMobile,0);
                    $this->getModel()->verifyMailLink($id,$userEmail);
//                    echo $id.'===';
                    exit('11');    
                }
            }   
        }
    }
    
    public function emailVerificationAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $user = $this->params()->fromQuery('user');
        if($user!=''){
            $userId = base64_decode($user);
            $id = $this->getModel()->updateanywhere('userlist',['is_verified'=>1],['id'=>$userId]);
        }
        return $view;
    }

    public function addUser($userName,$userPassword,$userEmail,$userMobile,$is_verified,$fb_login=0,$gmail_login=0){
        $salt = $this->create_salt();
        $data = [];
        $data['username']       =   trim($userName);
        $data['password']       =   base64_encode(trim($userPassword)).$salt;
        $data['useremail']      =   trim($userEmail);
        $data['mobile']         =   trim($userMobile);
        $data['salt_key']       =   $salt;
        $data['fb_login']       =   $fb_login;
        $data['gmail_login']    =   $gmail_login;
        $data['is_active']      =   1;
        $data['is_delete']      =   0;
        $data['is_verified']    =   $is_verified;
        $data['date_created']   =   date('Y-m-d H:i:s');
//          echo '<pre>';print_r($data);exit;    
        $id = $this->getModel()->lastInsertId('userlist',$data);
        return $id;
    }
    
    
    public function forgotPasswordAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $forgotEmail = $this->params()->fromPost('forgotEmail');  
            $userData = $this->getModel()->checkIfEmailExist($forgotEmail);
//             echo '<pre>';print_r($userData);exit; 
            if(count($userData)){ 
                $this->getModel()->forgotPasswordMail($userData[0]['id'],$forgotEmail);
                exit('1');    
            }else{
                exit('0');
            }
        } 
    }
    
    public function resetPasswordAction(){
        $view = new ViewModel();
        $view->setTerminal(true);
        $userId = $this->params()->fromQuery('user');
        $view->setVariable('userId', base64_decode($userId));
        if($this->getRequest()->isPost()){
            $user_id        = $this->params()->fromPost('userId');
            $pswdVal        = $this->params()->fromPost('pswdVal');
            $confPswdVal    = $this->params()->fromPost('confPswdVal');
            if($pswdVal==$confPswdVal){
                $salt = $this->create_salt();
                $data = [];
                $data['password']       =   base64_encode(trim($pswdVal)).$salt;
                $data['salt_key']       =   $salt; 
                $this->getModel()->updateanywhere('userlist',$data,['id'=>$user_id]);
                $this->redirect()->toRoute('homepage');
            }
        }
        return $view;
    }
    
    public function create_salt(){
		return base64_encode(mcrypt_create_iv(8, MCRYPT_DEV_URANDOM));
	}
    
     
    public function loginWithGmailAction(){

        $baseUrl = $this->getbaseUrl();
        if($this->request->isXmlHttpRequest()){
            $name = $this->params()->fromPost('name');
            $email = $this->params()->fromPost('email');
            $userData = $this->getModel()->checkIfEmailExist($email);
            if(count($userData)){
//                echo '<pre>';
//                print_r($userData);
//                exit;
                
                $password = str_replace($userData[0]['salt_key'], '', $userData[0]['password']);
                $this->getModel()->updateanywhere('userlist',['gmail_login'=>1],['id'=>$userData[0]['id']]);
                $this->userLogin($userData[0]['useremail'],  base64_decode($password));
            }else{
                $this->addUser($name,'password',$email,'',1,0,1);
                $this->userLogin($email,'password');
            }
        }
    }
    
    public function loginWithFbAction(){
        if($this->request->isXmlHttpRequest()){
            $name = $this->params()->fromPost('name');
            $email = $this->params()->fromPost('email');
            $userData = $this->getModel()->checkIfEmailExist($email);
            if(count($userData)){
//                echo '111';exit;
//                  echo '<pre>';
//                print_r($userData);
//                exit;
                
                $password = str_replace($userData[0]['salt_key'], '', $userData[0]['password']);
                $this->getModel()->updateanywhere('userlist',['fb_login'=>1],['id'=>$userData[0]['id']]);
                $this->userLogin($userData[0]['useremail'],  base64_decode($password));
            }else{
//                    echo '222';exit;
                $this->addUser($name,'password',$email,'',1,1,0);
                $this->userLogin($email,'password');
            }
            
        }
    }
    
    public function portfolioAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $adminModel = $this->serviceLocator->get('Application/Model/Admin');
        $cityList = $adminModel->getAllCities();
        $userDetails = $this->getUserDetails();
//        echo '<pre>'; print_r($userDetails);exit;
        
        $view->setVariable('cityList', $cityList);
        return $view;
    }
    public function accountSettingsAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $userDetails = $this->getUserDetails();
        $password = str_replace($userDetails->salt_key, '', $userDetails->password);
//        echo base64_decode($password);exit;
//        echo '<pre>'; print_r($userDetails);exit;
        if($this->getRequest()->isXmlHttpRequest()){
            $phoneNo        = $this->params()->fromPost('phoneNo');
            $pswdVal        = $this->params()->fromPost('pswdVal');
            $confPswdVal    = $this->params()->fromPost('confPswdVal');
            if($phoneNo!=''){
                $this->getModel()->updateanywhere('userlist',['mobile'=>$phoneNo],['id'=>$userDetails->id]);
                exit();
            }
            if($pswdVal!='' && $confPswdVal!='' && $pswdVal==$confPswdVal){
                $salt = $this->create_salt();
                $data = [];
                $data['password']       =   base64_encode(trim($pswdVal)).$salt;
                $data['salt_key']       =   $salt; 
                $this->getModel()->updateanywhere('userlist',$data,['id'=>$userDetails->id]);
                exit();
            }
        }
    }
    public function enquiredPropertiesAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $userDetails = $this->getUserDetails();
        $userId = $userDetails->id;
        $result = $this->getModel()->getEnquiredProperties($userId);
        $view->setVariable('enquiredProperties', $result);
       // echo '<pre>';print_r($result);exit; 
        return $view;
    }
    public function recentlyViewedAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        $userDetails = $this->getUserDetails();
        $userId = $userDetails->id;
        $result = $this->getModel()->getRecentlyViewed($userId);
        $view->setVariable('recentViewed', $result);
       // echo '<pre>';print_r($result);exit; 
        return $view;
    }
    
    public function logoutAction(){
        $auth = new AuthenticationService();
        $auth->clearIdentity();
        exit('Logged Out');
    }
    
    public function getCitiesAction(){
        if($this->request->isXmlHttpRequest()){
            $searchStr = $this->params()->fromPost('searchStr');
            $allCities = $this->getModel()->getCities($searchStr);
            $cityArr = array();
            foreach ($allCities as $cities){
                $tempArr = [];
                $tempArr['id'] = $cities['id'];
                $tempArr['city_name'] = $cities['city_name'];
                $cityArr[] = $tempArr;
               // $cityArr[$cities['id']] = $cities['city_name'];

            }
            exit(json_encode($cityArr));
        }
    }
    
    public function getProjectByCityAction(){
        if($this->request->isXmlHttpRequest()){
            $searchStr = $this->params()->fromPost('searchStr','');
            $cityId = $this->params()->fromPost('cityId');
            $prjArr = $this->getModel()->searchProject($searchStr,$cityId);
            
            exit(json_encode($prjArr));
        } 
    }
    
    public function getProjectDetailAction() {
        if($this->request->isXmlHttpRequest()){
            $prjId = $this->params()->fromPost('prjId');
            $floor_plans = $this->getModel()->getFloorPlans($prjId);
            $projectDetail  = $this->getModel()->getProjectDetails($prjId);
            exit(json_encode(['projectDetail'=>$projectDetail,'floor_plans'=>$floor_plans]));
        }
        
    } 
    public function addResaleProjectAction() {
        if($this->request->isXmlHttpRequest()){
            
            $userDetails = $this->getUserDetails();
            $userId = $userDetails->id;
            
//          echo '<pre>';print_r($this->params()->fromPost());exit; 
            $data = [];
            $data['project_id']             = $this->params()->fromPost('prjId');
            $data['user_id']                = $userId;
            $data['floor_plan_id']          = $this->params()->fromPost('form2FlrPlnId');
            $data['pruchased_for']          = $this->params()->fromPost('form2Purchasedfor');
            $form2DateofPurchase            = $this->params()->fromPost('form2DateofPurchase');
            $data['purchase_date']          = ($form2DateofPurchase!='') ? date('Y-m-d',  strtotime($form2DateofPurchase)) : '';
            $data['unit']                   = $this->params()->fromPost('form2Unit');
            $data['floor']                  = $this->params()->fromPost('form2Floor');
            $data['tower']                  = $this->params()->fromPost('form2Tower');
            $data['basic_price']            = $this->params()->fromPost('form3BasicSalePrice');
            $data['other_expenses']         = $this->params()->fromPost('form3OtherExpenses');
            $data['total_price']            = $this->params()->fromPost('form3TotalPrice');
            $data['goal_amount']            = $this->params()->fromPost('form3GoalAmount');
            $data['loan_status']            = $this->params()->fromPost('form3LoanStatus');
            $data['is_active']              = 1;
            $data['is_approved']            = 0;
            $data['is_delete']              = 0;
            $data['date_created']           = date('Y-m-d');
            
           // echo '<pre>';print_r($data);//exit; 
            
            
            $this->getModel()->insertanywhere('resale_property_list',$data);
            exit('111'); 
        }
        
    }
}
