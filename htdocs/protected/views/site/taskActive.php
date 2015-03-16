<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Мои задания';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    function DoTask(task_id,startdate,city_id,newstatus){
        document.getElementById('task_id').value = task_id;
        document.getElementById('startdate').value = startdate;
        document.getElementById('city_id').value = city_id;
        document.getElementById('newstatus').value = newstatus;

        $.blockUI({ message: $('#CommentTaskForm') }); 
        //setTimeout($.unblockUI, 2000); 
        
        //document.forms["checktask-form"].submit();
        return false;
    }
    function SendForm(){
        document.getElementById('description').value = document.getElementById('TaskComment').value;
        if (document.getElementById('description').value!==""){
            $.unblockUI();           
            document.forms["dotask-form"].submit();
        }
    }
    function CancelForm(){
        $.unblockUI();
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

<?php if (Yii::$app->session->hasFlash('doTaskSubmitted')): ?>
    <div class="alert alert-success">
        Данные сохранены.
    </div>
<?php else: ?>   

<?php endif; ?>    
    
<?php $form = ActiveForm::begin(['id' => 'dotask-form']); ?>
  
    <input type="hidden" name='task_id' id='task_id' value='0'/>
    <input type="hidden" name="startdate" id='startdate' value='' />
    <input type="hidden" name="city_id" id='city_id' value='0' />
    <input type="hidden" name="description" id='description'  />
    <input type="hidden" name="newstatus" id='newstatus' value='' />
<?php ActiveForm::end(); ?>

    <div id="CommentTaskForm" style="display:none" class="form-group">
    <table class="table table-hover table-condensed" >
        <tr>
            <td><b>Краткое пояснение, комментарий по заданию</b>:</p></td>
        <tr>
            <td><textarea id="TaskComment" class="form-control" rows="12" ></textarea></td>
        </tr>
        <tr>
            <td>
                <button type="button" class="btn btn-primary" onclick="SendForm()" >Сохранить</button>
                <button type="button" class="btn btn-primary" onclick="CancelForm()" >Отмена</button>
            </td>
        </tr>
    </table>
</div>    
    
<table class="table table-hover table-condensed" >
    <thead>
    <tr>
        <th>Задание</th>
        <th>Сроки</th>
        <th>Оплата</th>
        <th>Город</th>
        <th>Статус</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row): ?>
        <tr>
            <td ><a href="#" OnClick="showId('#task_<?php echo $row->task_id; ?>')"><?php echo $row->tasksubject; ?></a></td>
            <td><?php echo date_format(date_create($row->startdate),"d.m"); ?> 
                / <?php echo date_format(date_create($row->finishdate),"d.m.Y"); ?></td>
            <td><?php echo $row->cost; ?></td>
            <td><?php echo $row->cityname; ?></td>
            <td><?php echo $row->statusname; ?></td>
            <td>
                <div class="col-lg-offset-1 col-lg-11">
                <?php if (($row->status_id=="1") || ($row->status_id=="6")): ?>
                    <?= Html::Button('Выполнено', ['title'=>'Подтвердить выполенение задания, ввести отчет и отправить на проверку.', 'class' => 'btn btn-primary', 'name' => 'check-button', 'OnClick'=>'DoTask(\''.$row->task_id.'\',\''.$row->startdate.'\',\''.$row->city_id.'\',5)']) ?>
                    <?= Html::Button('Отказаться', ['title'=>'Отказаться от вполнения задания, ввести причину и отправить руководителю.','class' => 'btn btn-primary', 'name' => 'check-button', 'OnClick'=>'DoTask(\''.$row->task_id.'\',\''.$row->startdate.'\',\''.$row->city_id.'\',0)']) ?>
                <?php else: ?>   

                <?php endif; ?>
                </div>
            </td>
        </tr>
            <div id="task_<?php echo $row->task_id; ?>" style="display:none;text-align:left;padding-left: 15px;padding-right: 15px;" class="form-horizontal" >
                <div class="row-fluid">
                    <div class="page-header">
                        <h3><?php echo $row->tasksubject; ?></h3>
                    </div>
                    <p class="small"><?php echo $row->taskdescription; ?></p>

                    <hr>    
                    <div class="row-fluid">
                        <p class="small" style="font-style: italic">
                         <?php echo $row->description; ?><br>
                         <?php echo date_format(date_create($row->statusdate),"d.m.Y H:i:s"); ?><br>
                    </p>
                </div>
                </div>
            </div>
        
    <?php endforeach; ?>
    </tbody>
</table>    
    
</div>
