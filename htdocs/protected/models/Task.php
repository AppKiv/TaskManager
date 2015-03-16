<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['subject','description','createdate'], 'required'],
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
        return 'task';
    }
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('task_id');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'task_id' => '',
            'subject' => 'Тема, краткое название',
            'description' => 'Подробное описание задачи',
            'createdate' => 'Создана',
        );
    }
}
