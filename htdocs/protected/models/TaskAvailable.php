<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;
use yii\base\db;
/**
 * ContactForm is the model behind the contact form.
 */
class TaskAvailable extends \yii\db\ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name'], 'required'],
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
        return 'task_available';
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
            'task_id'=>'ID',
            'subject'=> 'Тема задания',
            'description'=> 'Описание',
            'startdate'=> 'Дата начала',
            'finishdate'=> 'Дата завершения',
            'city_id' => 'Код города',
            'cityname'=> 'Город', 
            'cost'=>'Оплата',
            'statusname'=>'Статус'
        );
    }
    
    public function checkTask($task_id,$city_id,$startdate_str){
        $newstatus = 1;
        $description = "Начато выполнение";
        $startdate  = /*date_create*/($startdate_str);
        $user_id = Yii::$app->user->id;    
        $command = Yii::$app->db->createCommand('call do_new_task(:v_task_id,:v_city_id,:v_startdate,:v_user_id,:v_newstatus,:v_description)',
             ['v_task_id'=>$task_id,'v_city_id'=>$city_id,'v_startdate'=>$startdate,'v_user_id'=>$user_id,'v_newstatus'=>$newstatus,'v_description'=>$description  ]);
        $command->execute();        
            
        return true; 
    }
    
    public function getTask(){
        $user_id = Yii::$app->user->id;
        $sql = "
        SELECT 
            ta.task_id,       ta.subject,
            ta.description,   ta.startdate,
            ta.finishdate,    ta.cost,
            ta.city_id,       ta.cityname,
            st.user_id,       st.status_id,
            s.name as statusname,         ta.taskusers,
            ta.taskmaxuser
        FROM task_available ta
            left join task_status st ON st.task_id = ta.task_id
                and st.city_id = COALESCE(ta.city_id,0)
                and st.startdate = ta.startdate
			and st.user_id = " . $user_id . "
            left join status s ON s.status_id = st.status_id
        WHERE ta.taskmaxuser > coalesce(ta.taskusers, 0)";
        
        return $this->findBySql($sql)->all();
    }
    
}
