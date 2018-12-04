<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dipa */

$this->title = 'Upload RKAKL';
$this->params['breadcrumbs'][] = ['label' => 'Dipa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dipa-create">

<!--     <h1><?= Html::encode($this->title) ?></h1>
 -->
    <?php $form = ActiveForm::begin();
	?>
	
 <div class="panel panel-default">
     <div class="panel-heading">Silahkan upload file RKAKL di sini!</div>
     <div class="panel-body">
         <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
         <?= $form->field($model1, 'file')->fileInput() ?>
         <div class="form-group">
             <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']); ?>
         </div>
     </div>
 </div>
    <?php ActiveForm::end(); ?>
</div>