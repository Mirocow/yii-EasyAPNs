<?php

/**
 * This is the model class for table "{{apns_devices}}".
 *
 * The followings are the available columns in table '{{apns_devices}}':
 * @property string $pid
 * @property string $appname
 * @property string $appversion
 * @property string $deviceuid
 * @property string $devicetoken
 * @property string $devicename
 * @property string $devicemodel
 * @property string $deviceversion
 * @property string $pushbadge
 * @property string $pushalert
 * @property string $pushsound
 * @property string $development
 * @property string $status
 * @property string $created
 * @property string $modified
 */
class ApnsDevices extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ApnsDevices the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{apns_devices}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('appname, deviceuid, devicetoken, devicename, devicemodel, deviceversion, created', 'required'),
            array('appname, devicename', 'length', 'max'=>255),
            array('appversion, deviceversion', 'length', 'max'=>25),
            array('deviceuid', 'length', 'max'=>40),
            array('devicetoken', 'length', 'max'=>64),
            array('devicemodel', 'length', 'max'=>100),
            array('pushbadge, pushalert, pushsound', 'length', 'max'=>8),
            array('development', 'length', 'max'=>10),
            array('status', 'length', 'max'=>11),
            array('modified', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('pid, appname, appversion, deviceuid, devicetoken, devicename, devicemodel, deviceversion, pushbadge, pushalert, pushsound, development, status, created, modified', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'pid' => 'Pid',
            'appname' => 'Appname',
            'appversion' => 'Appversion',
            'deviceuid' => 'Deviceuid',
            'devicetoken' => 'Devicetoken',
            'devicename' => 'Devicename',
            'devicemodel' => 'Devicemodel',
            'deviceversion' => 'Deviceversion',
            'pushbadge' => 'Pushbadge',
            'pushalert' => 'Pushalert',
            'pushsound' => 'Pushsound',
            'development' => 'Development',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('pid',$this->pid,true);
        $criteria->compare('appname',$this->appname,true);
        $criteria->compare('appversion',$this->appversion,true);
        $criteria->compare('deviceuid',$this->deviceuid,true);
        $criteria->compare('devicetoken',$this->devicetoken,true);
        $criteria->compare('devicename',$this->devicename,true);
        $criteria->compare('devicemodel',$this->devicemodel,true);
        $criteria->compare('deviceversion',$this->deviceversion,true);
        $criteria->compare('pushbadge',$this->pushbadge,true);
        $criteria->compare('pushalert',$this->pushalert,true);
        $criteria->compare('pushsound',$this->pushsound,true);
        $criteria->compare('development',$this->development,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('modified',$this->modified,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}