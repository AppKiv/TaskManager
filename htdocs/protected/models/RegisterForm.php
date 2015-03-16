<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends \yii\db\ActiveRecord
{
    public $verifyCode;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['login','token','first_name', 'last_name', 'phone','email','city_id'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
            //['verifyCode', 'captcha', 'captchaAction'],
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
        return 'user';
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
            'user_id' => '',
            'login'=> 'Логин',
            'token'=>'Новый пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'date_born' => 'Дата рождения',
            'email'=>'E-mail',
            'phone' => 'Телефон',
            'city_id' => 'Город',
            'verifyCode' => 'Код с картинки',
        );
    }

}
