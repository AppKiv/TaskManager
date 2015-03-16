<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskScheduleCity extends \yii\db\ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['task_id','startdate','city_id'], 'required'],
        ];
    }

   /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'task_schedule_city';
    }
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('task_id','startdate','city_id');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'task_id' => '',
            'startdate' => '',
            'city_id' => 'код города',
        );
    }
    
    public function SaveCity($task_id,$startdate,$city_id ){
        $command = Yii::$app->db->createCommand('call task_addcity(:v_task_id,:v_startdate,:v_city_id)',
             ['v_task_id'=>$task_id,'v_startdate'=>$startdate,'v_city_id'=>$city_id ]);
        return $command->execute();        
    }
    
    public function DeleteCity($task_id,$startdate,$city_id ){
        $command = Yii::$app->db->createCommand('call task_delcity(:v_task_id,:v_startdate,:v_city_id)',
             ['v_task_id'=>$task_id,'v_startdate'=>$startdate,'v_city_id'=>$city_id ]);
        return $command->execute();        
    }
    
}
