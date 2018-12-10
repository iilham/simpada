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

   

    <?php $form = ActiveForm::begin();
    ?>

    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i>Silahkan upload file RKAKL di sini!</div>
        <div class="panel-body">
            <?= $form->field($model2, 'file')->fileInput() ?>
            <div class="form-group">
            <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']); ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>