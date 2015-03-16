<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use app\models\City;

/* @var $this yii\web\View */
$this->title = 'Расписание задачи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
    <div class="page-header">
        <h3><?= Html::encode($this->title) ?>: <?= $task->subject; ?></h3>
    </div>
    <div>
    <?php
        foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
        }
    ?>    

   
    <table class="table table table-hover table-condensed">
        <thead>
            <tr>
                <th colspan="2">Даты</th>
                <th>Стоимость</th>
                <th>Исполнителей</th>
                <th>Полная стоимость</th>
                <th>Комментарий</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo Html::a(NULL, array('site/updatetaskschedule', 'task_id'=>$row->task_id,'startdate'=>$row->startdate), array('class'=>'glyphicon glyphicon-edit')); ?></td>
                    <td >
                           <?php echo date_format(date_create($row->startdate), "d/m/Y"); ?> 
                         - <?php echo date_format(date_create($row->finishdate), "d/m/Y"); ?> 
                    </td>
                    <td ><?php echo $row->cost; ?></td>
                    <td ><?php echo $row->maxuser; ?></td>
                    <td ><?php echo (int)$row->cost*(int)$row->maxuser; ?></td>
                    <td ><?php echo $row->description; ?></td>


                </tr>
        <?php endforeach; ?>
        </tbody>
    </table>    
<p>
    <?php echo Html::a('Добавить', array('site/updatetaskschedule','task_id'=>$row->task_id), array('class' => 'btn btn-primary pull-right')); ?>
</p>
    
    
</div>
