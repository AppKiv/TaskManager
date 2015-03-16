<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\base\Exception;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\TaskAvailable;
use app\models\TaskActive;
use app\models\TaskStatusCnt;
use app\models\Task;
use app\models\TaskSchedule;
use app\models\TaskScheduleCity;
use app\models\City;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUserlist()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();

        $data = $model->find()->all();
        return $this->render('userList', array(       'data' => $data  ));
       
    }    
    
    public function actionRegister()
    {
        $user_id = Yii::$app->user->id;
        $model= RegisterForm::find()->andWhere('user_id=:id',[':id'=>$user_id])->one();
        if ($model==null){
            $model = new RegisterForm();
        } 
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
            $tp =$model->token;
            $model->token = md5($tp);
            if ($model->save(TRUE)){            
                Yii::$app->session->setFlash('success', 'данные сохранены.');
                $modelLogin = new LoginForm();
                $modelLogin->username = $model->login;
                $modelLogin->password = $tp;
                if ($modelLogin->login()){
                    Yii::$app->session->setFlash('info',"вход в систему выполнен.");
                }else{
                    Yii::$app->session->setFlash('warning',"вход в систему не выполнен.");
                }
            }else{
                Yii::$app->session->setFlash('error',"не все поля заполнены.");
            }
            $model->token = $tp;
            return $this->refresh();
        } else{
            $model->token = "";
        }
        return $this->render('register', array('model' => $model ));
    }    

    public function actionTaskavailable() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new TaskAvailable();

        $task_id = (int) Yii::$app->request->post('task_id');
        $city_id = (int) Yii::$app->request->post('city_id');
        $startdate_str = Yii::$app->request->post('startdate');

        if ($task_id > 0 && $city_id >= 0 && $startdate_str != "" && $model->checkTask($task_id, $city_id, $startdate_str)) {
            Yii::$app->session->setFlash('checkTaskSubmitted');
        }
        $data = $model->getTask();
        return $this->render('taskAvailable', array('data' => $data));
    }

    public function actionTaskactive()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new TaskActive();
        $user_id = Yii::$app->user->id;
        $task_id = (int)Yii::$app->request->post('task_id');
        $city_id = (int)Yii::$app->request->post('city_id');
        $startdate_str = Yii::$app->request->post('startdate');
        $newstatus = (int)Yii::$app->request->post('newstatus');
        $newstatus_str = Yii::$app->request->post('newstatus');
        $description = Yii::$app->request->post('description');
        
        if ($task_id>0 && $city_id>=0 && $startdate_str!="" && $newstatus_str!="" && $description!=""
                  && $model->doTask($task_id,$city_id,$startdate_str,$newstatus,$description)) 
        {
            Yii::$app->session->setFlash('doTaskSubmitted');
        }

        $data = $model->find()->where('user_id=:user_id and (status_id=1 or status_id=5 or status_id=6)',['user_id'=>$user_id])->orderBy('finishdate')->all();
        return $this->render('taskActive', array(       'data' => $data  ));
    }       
    
    public function actionTaskstatuscnt(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
      
        $model = new TaskStatusCnt();
        $user_id = Yii::$app->user->id;
        $data = $model->find()->where('user_id=:user_id',['user_id'=>$user_id])->all();
        return $this->render('taskStatusCnt', array(       'data' => $data  ));
    }

    public function actionTaskmanage() {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $model = new TaskAvailable();

        $data = $model->find()->all();
        return $this->render('TaskManage', array('data' => $data));
    }

    public function actionUpdatetask($task_id) {
        if (Yii::$app->user->isGuest || $task_id == null) {
            Yii::$app->session->setFlash('error', "не выбрана задача.");
            return $this->goBack();
        }

        $model = Task::find()->andWhere('task_id=:id', [':id' => $task_id])->one();
        if ($model == null) {
            $model = new Task();
            $model->createdate = date("Y-m-d");
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', 'данные сохранены.');

            return $this->actionTasklist();
        }

        $data = Task::find()->orderBy(['task_id' => SORT_DESC])->all();

        return $this->render('Task/taskForm', array('model' => $model, 'data' => $data));
    }

    public function actionTasklist() {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', "необходима авторизация.");
            return $this->goBack();
        }
        $data = Task::find()->orderBy(['task_id' => SORT_DESC])->all();
        return $this->render('Task/taskList', array('data' => $data));
    }

    public function actionUpdatetaskschedule($task_id, $startdate = "") {
        if (Yii::$app->user->isGuest || $task_id == null) {
            Yii::$app->session->setFlash('error', "не выбрана задача.");
            return $this->goBack();
        }

        $model = TaskSchedule::find()->andWhere('task_id=:id and startdate=:date', [':id' => $task_id, ':date' => $startdate])->one();
        if ($model == null) {
            $model = new TaskSchedule();
            $model->task_id = $task_id;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            // список городов
            $list=$_POST['TaskSchedule']['citylist'];

            // старый список
            $bdList = TaskScheduleCity::find()->andWhere('task_id=:id and startdate=:date', [':id' => $task_id,':date'=>$startdate])->all();
            foreach($bdList as $row){
                if(!array_search($row->city_id, $list)){
                    TaskScheduleCity::DeleteCity($model->task_id,$model->startdate,$row->city_id);
                }
            }
            
            foreach($list as $row){
                TaskScheduleCity::SaveCity($model->task_id,$model->startdate,$row);
            }
            Yii::$app->session->setFlash('success', 'данные сохранены!' );
            return $this->actionTaskschedulelist($task_id);
        }
        $data = TaskSchedule::find()->andWhere('task_id=:id', [':id' => $task_id])->orderBy(['startdate' => SORT_DESC])->all();

        //city
        $cityListModel = City::find()->orderBy(['name'=>SORT_ASC])->all();
        $cityList = array();
        foreach($cityListModel as $row){
            $cityList[$row->city_id]=$row->name;
        }

        $chCityModel = TaskScheduleCity::find()->andWhere('task_id=:id and startdate=:date', [':id' => $task_id,':date'=>$startdate])->all();
        $chCity = array();
        foreach($chCityModel as $row){
            array_push($chCity,$row->city_id);
        }
        $model->citylist = $chCity;
        
        $taskmodel = Task::find()->andWhere('task_id=:id', [':id' => $task_id])->one();
        return $this->render('Task/taskFormSchedule', array('model' => $model,'task'=>$taskmodel,'city'=>$cityList, 'data' => $data));
    }

    public function actionTaskschedulelist($task_id) {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', "необходима авторизация.");
            return $this->goBack();
        }
        $taskmodel = Task::find()->andWhere('task_id=:id', [':id' => $task_id])->one();
        $data = TaskSchedule::find()->andWhere('task_id=:id', [':id' => $task_id])->orderBy(['startdate' => SORT_DESC])->all();
        return $this->render('Task/taskFormScheduleList', array('data' => $data,'task'=>$taskmodel));
    }

}
