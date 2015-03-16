<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Список доступных заданий';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    function CheckTask(task_id,startdate,city_id){
        document.getElementById('task_id').value = task_id;
        document.getElementById('startdate').value = startdate;
        document.getElementById('city_id').value = city_id;
        document.forms["checktask-form"].submit();
        return false;
    }
    
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
<?php if (Yii::$app->session->hasFlash('checkTaskSubmitted')): ?>
    <div class="alert alert-success">
        Задание выбрано, список выбранных заданий в разделе "Мои задания".
    </div>
<?php else: ?>   

<?php endif; ?>    
    
<?php $form = ActiveForm::begin(['id' => 'checktask-form']); ?>
  
    <input type="hidden" name='task_id' id='task_id' value='0'/>
    <input type="hidden" name="startdate" id='startdate' value='' />
    <input type="hidden" name="city_id" id='city_id' value='0' />
<?php ActiveForm::end(); ?>

    <table class="table table table-hover table-condensed">
        <thead>
            <tr>
                <th>Задание</th>
                <th>Сроки</th>
                <th>Оплата</th>
                <th>Город</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach ($data as $row): ?>
                <tr>
                    <td ><a href="#" OnClick="showId('#task_<?php echo $row->task_id; ?>')"><?php echo $row->subject; ?></a></td>
                    <td ><?php echo date_format(date_create($row->startdate), "d/m"); ?> 
                        - <?php echo date_format(date_create($row->finishdate), "d/m/Y"); ?></td>
                    <td ><?php echo $row->cost; ?></td>
                    <td ><?php echo $row->cityname; ?></td>
                    <!--td>
                    <?php echo Html::a(NULL, array('site/update', 'task_id' => $row->task_id), array('class' => 'icon icon-edit')); ?>
                    <?php echo Html::a(NULL, array('site/delete', 'task_id' => $row->task_id), array('class' => 'icon icon-trash')); ?>
                    </td-->

                    <td >
                        <div class="col-lg-offset-1 col-lg-11">
                            <?php if ($row->user_id != ""): ?>
                                <i>&nbsp;<?= $row->statusname ?></i>
                            <?php else: ?>   
                                <?= Html::Button('В работу', ['class' => 'btn btn-primary', 'name' => 'check-button', 'OnClick' => 'CheckTask(\'' . $row->task_id . '\',\'' . $row->startdate . '\',\'' . $row->city_id . '\')']) ?>
                            <?php endif; ?>
                        </div>
                    </td>
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

</div>
