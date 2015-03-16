<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
/*http://malsup.com/jquery/block/#demos*/
$this->registerJsFile('/TaskCtrl/web/js/jquery.blockUI.js',['depends'=>['yii\web\JqueryAsset','yii\web\YiiAsset']]); 

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?r=/site/index">Планировщик заданий</a>
        </div>            
        <div id="navbar" class="navbar-collapse collapse">

        <?php $this->beginBody() ?>
        <?php
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'О проекте', 'url' => ['/site/about']],
                    ['label' => 'Помощь', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Вход', 'url' => ['/site/login']] :
                        ['label' => 'Выйти ' . Yii::$app->user->identity->username . '',
                        //['label' => 'Выйти (' . Yii::$app->user->id . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
        ?>
             
          </div><!--/.nav-collapse -->
        </div>
    </nav>

    
    <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <?php
            echo Nav::widget([
                'options' => ['class' => 'nav nav-sidebar'],
                'items' => [
                    ['label' => 'Задания', 'url' => ['/site/taskavailable']],
                    ['label' => 'Мои задания', 'url' => ['/site/taskactive']],
                    ['label' => 'Статистика', 'url' => ['/site/taskstatuscnt']],
                    ['label' => 'Архив', 'url' => ['/site/taskarchive']],
                    ['label' => 'Профиль', 'url' => ['/site/register']],
                    ['label' => 'Чат', 'url' => ['/site/contact']],
                ],
            ]);
        ?>
              
            <ul class="nav nav-sidebar">
              <li class="nav-header">Admin</li>
              <li><a href="?r=site/userlist">Список пользователей</a></li>
              <li><a href="?r=site/taskmanage">Задачи в работе</a></li>
              <li><a href="?r=site/tasklist">Все задачи</a></li>
            </ul>
      </div>
        
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <!--    <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>-->
            <?= $content ?>
        </div><!--/span-->
      </div><!--/row-->
</div>    
<hr>
    <footer >
        <p>&copy; Company 2015</p>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
