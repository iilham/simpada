<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\spinner\Spinner;

/* @var $this yii\web\View */
/* @var $model app\models\Dipa */

$this->title = 'Upload RKAKL';
$this->params['breadcrumbs'][] = ['label' => 'Dipa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$sql = 'SELECT `keterangan` FROM `diparealisasi`';
$s = \Yii::$app->db->createCommand($sql)->queryScalar();
if ($s == 1) {
    ?>
    <div class="dipa-create">
        <?php $form = ActiveForm::begin(); ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i>Silahkan upload file RKAKL di sini!</div>
            <div class="panel-body">
                <?= $form->field($model2, 'file')->fileInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']); ?>
                </div>
            </div>
        </div>
        <?php
        ActiveForm::end();
    } else {
        ?>
        <br>
        <br>
        <div class="well">
        <?= Html::a('Process', ['/diparealisasi/synchron'], ['class'=>'btn btn-primary btn-lg btn-block']) ?>
           
        </div>
<?php } ?>

</div>