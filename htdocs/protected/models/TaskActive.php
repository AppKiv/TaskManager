<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;
use yii\base\db;
/**
 * ContactForm is the model behind the contact form.
 */
class TaskActive extends \yii\db\ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            //[['name'], 'required'],
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
        return 'task_active';
    }
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('task_id','startdate','city_id','user_id','status_id');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'task_id'=>'ID',
            'tasksubject'=> 'Задание',
            'startdate'=> 'Дата начала',
            'finishdate'=> 'Дата завершения',
            'city_id' => 'Код города',
            'cityname'=> 'Город', 
            'cost'=>'Оплата',
            'statusname'=>'Статус',
        );
    }
    
    public function doTask($task_id,$city_id,$startdate_str,$newstatus,$description){
        $startdate  = /*date_create*/($startdate_str);
        $user_id = Yii::$app->user->id;    
        $command = Yii::$app->db->createCommand('call do_new_task(:v_task_id,:v_city_id,:v_startdate,:v_user_id,:v_newstatus,:v_description)',
             ['v_task_id'=>$task_id,'v_city_id'=>$city_id,'v_startdate'=>$startdate,'v_user_id'=>$user_id,'v_newstatus'=>$newstatus,'v_description'=>$description ]);
        return $command->execute();        
            
        //return true; 
    }
    
    
  
    
}
