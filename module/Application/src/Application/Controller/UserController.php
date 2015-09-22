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
        $authAdapter 	= new AuthAdapter($this->getAdapter(), 'userlist','useremail', 'password', 'CONCAT(?,salt_key) and is_active=1 and is_delete=0');
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
            
//            print_r($identity);
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
                    $this->addUser($userName,$userPassword,$userEmail,$userMobile);
                    exit('11');    
                }
            }   
        }
    }
    
    public function addUser($userName,$userPassword,$userEmail,$userMobile,$fb_login=0,$gmail_login=0){
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
        $data['date_created']   =   date('Y-m-d H:i:s');
//          echo '<pre>';print_r($data);exit;    
        $this->getModel()->insertanywhere('userlist',$data);
        return 1;
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
                $this->addUser($name,'password',$email,'',0,1);
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
                $this->addUser($name,'password',$email,'',1,0);
                $this->userLogin($email,'password');
            }
            
        }
    }
    
    public function portfolioAction(){
        $view = new ViewModel();
        $this->layout('layout/innerlayout');
        
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
            $oldPswdVal     = $this->params()->fromPost('oldPswdVal');
            $pswdVal        = $this->params()->fromPost('pswdVal');
            $confPswdVal    = $this->params()->fromPost('confPswdVal');
            if($oldPswdVal  !=  base64_decode($password)){
                exit('wrongpassword');
            }
            if($pswdVal==$confPswdVal){
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
}
