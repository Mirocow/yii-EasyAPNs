<?php

class EasyAPNsModule extends CWebModule
{
  
    private $_development = 'production';  
  
    private $_apns;  
  
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'easyapns.models.*',
            'easyapns.components.*',
        ));
        
        global $config;
        parent::init();
        $config_path = dirname($config);
        if(is_file("$config_path/apns.pem"))
          $production_sertificate = "$config_path/apns.pem"; 
        if(is_file("$config_path/apns-dev.pem"))
          $sandbox_certificate = "$config_path/apns-dev.pem";        
        $this->_apns  = new APNS($production_sertificate,$sandbox_certificate, $this->_development);        
        
    }
    
    public function GetApns(){
      return $this->_apns;
    }
    
    public function CreateMessage($ids = null){
      $timestamp = date('Y-m-d h:i:s', time()); // '2010-01-01 00:00:00'; 
      $this->apns->newMessageByDeviceUId($ids, $timestamp);      
    }
    
    public function AddMessage($body = ''){
      $this->apns->addMessageAlert($body, '');           
    }
    
    public function AddMessageBadge($badge = 1){
      $this->apns->addMessageBadge($badge);
    }
    
    public function AddMessageSound($sound = 'default'){
      $this->apns->addMessageSound($sound);
    }

    public function PushMessages(){
      $this->apns->queueMessage();
      $this->apns->processQueue();
    }
    
    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }
    
    public function SetDevelopment($development){
      $this->_development = $development;
    }
    
    public function GetDevelopment(){
      return $this->_development;
    }    
}