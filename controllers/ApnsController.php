<?php

class ApnsController extends Controller
{
    public $defaultAction='task';
    private $_apns;
  
    public function init()
    {    
      global $config;
      parent::init();
      $config_path = dirname($config);
      if(is_file("$config_path/apns.pem"))
        $production_sertificate = "$config_path/apns.pem"; 
      if(is_file("$config_path/apns-dev.pem"))
        $sandbox_certificate = "$config_path/apns-dev.pem";        
      $this->_apns  = new APNS($production_sertificate,$sandbox_certificate);
    }    
    
    public function actionTask($task = ''){
      switch($task){
        case "register":
          return $this->_apns->registerDevice(
            isset($_GET['appname'])?  $_GET['appname']: null,
            isset($_GET['appversion'])? $_GET['appversion']: null,
            isset($_GET['deviceuid'])?  $_GET['deviceuid']: null,
            isset($_GET['devicetoken'])?  $_GET['devicetoken']: null,
            isset($_GET['devicename'])? $_GET['devicename']: null,
            isset($_GET['devicemodel'])?  $_GET['devicemodel']: null,
            isset($_GET['deviceversion'])?  $_GET['deviceversion']: null,
            isset($_GET['pushbadge'])?  $_GET['pushbadge']: null,
            isset($_GET['pushalert'])?  $_GET['pushalert']: null,
            isset($_GET['pushsound'])?  $_GET['pushsound']: null,
            isset($_GET['clientid'])?  $_GET['clientid']:  null
          );
          break;

        case "fetch":
          return $this->_apns->fetchMessages();
          break;

        case "flush":
          return $this->_apns->flushMessages();
          break;

        default:
          echo "No APNS Task Provided...\n";
          break;
      }      
    }
    
    public function actionMessage($id = 0){
      $timestamp = time();
      $clientid = null;
      $this->_apns->newMessage($id, $timestamp, $clientid); // $timestamp = '2010-01-01 00:00:00'
      $this->_apns->addMessageAlert('You got your emails.');
      $this->_apns->addMessageBadge(9);
      $this->_apns->addMessageSound('bingbong.aiff');
      $this->_apns->addMessageCustom('acme1', 'bar');
      $this->_apns->addMessageCustom('acme2', 42);
      $this->_apns->addMessageCustom('acme3', array(5, 8));
      $this->_apns->queueMessage();
      $this->_apns->processQueue();      
    }
    
    public function actionError()
    {
      $this->layout = 'application.views.layouts.debug';
      if($error=Yii::app()->errorHandler->error)
      {
        if(Yii::app()->request->isAjaxRequest)
          echo $error['message'];
        else
            $this->render('error', $error);
      }
    }            
    
}