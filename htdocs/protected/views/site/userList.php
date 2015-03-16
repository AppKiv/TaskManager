<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Список пользователей системы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">
    <div class="page-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

   

<?php echo Html::a('Create New', array('site/register'), array('class' => 'btn btn-primary pull-right')); ?>
<div class="clearfix"></div>
<hr />
<table class="table table-striped table-hover">
    <tr>
        <td>#</td>
        <td>Title</td>
        <td>Created</td>
        <td>Updated</td>
        <td>Options</td>
    </tr>
    <?php foreach ($data as $post): ?>
        <tr>
            <td>
                <?php echo Html::a($post->user_id, array('site/read', 'user_id'=>$post->user_id)); ?>
            </td>
            <td><?php echo Html::a($post->first_name, array('site/read', 'user_id'=>$post->user_id)); ?></td>
            <td><?php echo $post->last_name; ?></td>
            <td><?php echo $post->phone; ?></td>
            <td>
                <?php echo Html::a(NULL, array('site/update', 'user_id'=>$post->user_id), array('class'=>'icon icon-edit')); ?>
                <?php echo Html::a(NULL, array('site/delete', 'user_id'=>$post->user_id), array('class'=>'icon icon-trash')); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>    
    
    <code><?= __FILE__ ?></code>
</div>
