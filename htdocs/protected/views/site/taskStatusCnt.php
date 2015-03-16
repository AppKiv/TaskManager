<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
    <div class="page-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>  

    <?php foreach ($data as $row): ?>
      <style>
    a { 
      color: #2D7BB2; 
      text-decoration: none; 
      font-weight: bold; 
    }
    a:hover { 
      color: #333; 
    }          
          
      </style>         
   <!-- 
   http://designformasters.info/posts/accessible-data-visualization/ 
   -->
    <ul class="chartlist">
      <li>
        <a href="#">Выполнено</a>
        <span class="count"><?php echo $row->TaskFinish ?></span>
        <span class="index" style="width: <?php echo $row->TaskFinishPercent() ?>%;">(<?php echo $row->TaskFinishPercent() ?>%)</span>
      </li>
      <li>
        <a href="#">На проверке</a>
        <span class="count"><?php echo $row->TaskSend ?></span>
        <span class="index" style="width: <?php echo $row->TaskSendPercent() ?>%;">(<?php echo $row->TaskSendPercent() ?>%)</span>
      </li>
      <li>
        <a href="#">Возвращено</a>
        <span class="count"><?php echo $row->TaskReturn ?></span>
        <span class="index" style="width: <?php echo $row->TaskReturnPercent() ?>%;">(<?php echo $row->TaskReturnPercent() ?>%)</span>
      </li>
      <li>
        <a href="#">В работе</a>
        <span class="count"><?php echo $row->TaskStart ?></span>
        <span class="index" style="width: <?php echo $row->TaskStartPercent() ?>%;">(<?php echo $row->TaskStartPercent() ?>%)</span>
      </li>
      <li>
        <a href="#">Провалено</a>
        <span class="count"><?php echo $row->TaskFail ?></span>
        <span class="index" style="width: <?php echo $row->TaskFailPercent() ?>%;">(<?php echo $row->TaskFailPercent() ?>%)</span>
      </li>
    </ul>
    <?php endforeach; ?>
    
  
    


</div>
