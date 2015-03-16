<?php

namespace app\models;
use app\models\RegisterForm;
use yii\db\ActiveRecord;
use yii\base\Security;
        
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
  
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
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'status' => 0]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {      
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {     
        return static::findOne(['login' => $username]);
        //(RegisterForm::find()->andWhere('login=:login',[':login'=>$username])->one()){
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
       return $this->getPrimaryKey();
    }

    public function getUsername()
    {
       return $this->login;
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return md5($password)===$this->token;
/*    
        if (RegisterForm::find()->andWhere('token=:token',[':token'=>md5($password)])->one())
        {
            return true;
        }
        return false;
        //return $this->password === $password;
 * 
 */
    }
    
    public static function  isUser(){
        return true;
    }
           
}
