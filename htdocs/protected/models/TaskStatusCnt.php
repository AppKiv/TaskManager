<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskStatusCnt extends \yii\db\ActiveRecord
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
        return 'task_status_cnt';
    }
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('user_id');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'user_id' => 'код',
            'TaskStart' => 'Выполняется',
            'TaskFinish' => 'Завершено',
            'TaskFail' => 'Провалено',
            'TaskSend' => 'На проверке',
            'TaskReturn' => 'Возвращено',
        );
    }
    public function TaskSumm(){
        return $this->TaskStart+$this->TaskFinish+$this->TaskFail+$this->TaskSend+$this->TaskReturn;
    }
    
    public function TaskFinishPercent(){
        if ($this->TaskSumm()==0) return 0;
        return $this->TaskFinish / $this->TaskSumm()*100.00;
    }
    public function TaskStartPercent(){
        if ($this->TaskSumm()==0) return 0;
        return $this->TaskStart / $this->TaskSumm()*100.00;
    }
    public function TaskFailPercent(){
        if ($this->TaskSumm()==0) return 0;
        return $this->TaskFail / $this->TaskSumm()*100.00;
    }
    public function TaskSendPercent(){
        if ($this->TaskSumm()==0) return 0;
        return $this->TaskSend / $this->TaskSumm()*100.00;
    }
    public function TaskReturnPercent(){
        if ($this->TaskSumm()==0) return 0;
        return $this->TaskReturn / $this->TaskSumm()*100.00;
    }
    
}
