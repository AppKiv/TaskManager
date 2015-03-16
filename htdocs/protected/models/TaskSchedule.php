<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskSchedule extends \yii\db\ActiveRecord
{
    public $citylist = array();
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['task_id','startdate','finishdate','cost','description','maxuser'], 'required'],
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
        return 'task_schedule';
    }
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('task_id','startdate');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'task_id' => '',
            'startdate'=>'Дата начала',
            'finishdate'=>'Дата завершения',
            'cost'=>'Цена',
            'description' => 'Описание',
            'maxuser' => 'Исполнителей',
            'citylist'=>'Города',
        );
    }
}
