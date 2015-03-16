<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use app\models\City;

/* @var $this yii\web\View */
$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">
    <div class="page-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <?php
        foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
        }
    ?>    
 
    <?php $form = ActiveForm::begin([
            'id' => 'register-form', 
            'options' => ['class'=>'form-horizontal'],
            'fieldConfig' =>[ 'template' => '{label}<div class="col-sm-10">{input}</div><div class="col-sm-10">{error}</div>',
                              'labelOptions' => ['class' => 'col-sm-2 control-label'],]
            ]
            ); ?>
            <?= $form->field($model, 'user_id')->hiddenInput() ?>
            <?= $form->field($model, 'login') ?>
            <?= $form->field($model, 'token')->passwordInput() ?> 
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'city_id', 'name'),['prompt' => '---- Выберите город ----']) ?>
          
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="form-group"><div class="col-sm-10">{image}</div><div class="col-sm-10">{input}</div></div>',
                ]) ?>
    <div class="col-sm-10"> 
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
    </div>    
    <?php ActiveForm::end(); ?>

</div>
