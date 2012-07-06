<?php

// 

class ApnsController extends Controller
{
    public $defaultAction='task';   
    
    public function actionTask($task = ''){
      switch($task){
        case "register":
          $params = array();
          foreach($_GET as $name => $value)
            $params[] = "$name = $value";
          Yii::log("APNS: " . implode(',',$params), CLogger::LEVEL_TRACE, 'server.' . __CLASS__);
          return $this->module->apns->registerDevice(
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
            isset($_GET['clientid'])?  $_GET['clientid']:  0
          );
          break;

        case "fetch":
          return $this->module->apns->fetchMessages();
          break;

        case "flush":
          return $this->module->apns->flushMessages();
          break;

        default:
          echo "No APNS Task Provided...\n";
          break;
      }      
    }
    
    /**
     * put your comment there...
     * 
     * @param mixed $data
     * 
     * Actions:
     *
     * $timestamp = '2010-01-01 00:00:00'; 
     * $this->_apns->newMessage($id, $timestamp, $clientid);
     * $this->_apns->addMessageAlert('You got your emails.');
     * $this->_apns->addMessageBadge(9);
     * $this->_apns->addMessageSound('bingbong.aiff');
     * $this->_apns->addMessageCustom('acme1', 'bar');
     * $this->_apns->addMessageCustom('acme2', 42);
     * $this->_apns->addMessageCustom('acme3', array(5, 8));
     * $this->_apns->queueMessage();
     * $this->_apns->processQueue();
     */
    /*public function actionMessage($id, $body = ''){
      $timestamp = date('Y-m-d h:i:s', time()); // '2010-01-01 00:00:00'; 
      $this->module->apns->newMessage($id, $timestamp);
      $this->module->apns->addMessageAlert($body, '');
      $this->module->apns->queueMessage();
      $this->module->apns->processQueue();
    }*/
    
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