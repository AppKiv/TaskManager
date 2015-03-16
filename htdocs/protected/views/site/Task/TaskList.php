<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Список заданий';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    
    function showId(DivId){
        $.blockUI({ message: $(DivId),css: { width: '600px',height:'350px',cursor:'default' } }); 
        $('.blockOverlay').attr('title','Закрыть описание').click($.unblockUI); 
        return false;
    }
</script>
<div class="row-fluid">
    <div class="page-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?php
        foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
        }
    ?>    
    
    <p>
    <table class="table table table-hover table-condensed">
        <thead>
            <tr>
                <th colspan="2">Задание</th>
                <th>Описание</th>
                <th>Дата создания</th>
                <th>Расписание</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo Html::a(NULL, array('site/updatetask', 'task_id'=>$row->task_id), array('class'=>'glyphicon glyphicon-edit')); ?></td>
                    <td ><a href="#" OnClick="showId('#task_<?php echo $row->task_id; ?>')"><?php echo $row->subject; ?></a></td>
                    <td ><?php echo (mb_strlen($row->description)>64)?mb_substr($row->description,0,64)."...":$row->description; ?></td>
                    <td ><?php echo date_format(date_create($row->createdate), "d/m/Y"); ?></td>
                    <td ><?php echo Html::a(NULL, array('site/taskschedulelist', 'task_id'=>$row->task_id), array('class'=>'glyphicon glyphicon-edit')); ?></td>
                </tr>
            <div id="task_<?php echo $row->task_id; ?>" style="display:none;text-align:left;padding-left: 15px;" class="form-horizontal" >
                <div class="row-fluid">
                    <div class="page-header">
                        <h3><?php echo $row->subject; ?></h3>
                    </div>
                    <p class="small"><?php echo $row->description; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </tbody>
    </table>    
</p>
<p>
    <?php echo Html::a('Новая задача', array('site/updatetask','task_id'=>0), array('class' => 'btn btn-primary pull-right')); ?>
</p>

</div>
