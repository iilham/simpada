<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\spinner\Spinner;

/* @var $this yii\web\View */
/* @var $model app\models\Dipa */
$sql = 'SELECT `keterangan` FROM `diparealisasi`';
$s = \Yii::$app->db->createCommand($sql)->queryScalar();
$this->title = 'Upload RKAKL';

if ($s == 1) {
$this->params['breadcrumbs'][] = ['label' => 'Dipa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
        <div>
        <br>
        <br>
        <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <span class="label label-default">
            untuk menggenerate file tekan tombol dibawah
            </span>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
         <?= Html::a('Process', ['/diparealisasi/synchron'], ['class'=>'btn btn-primary btn-lg btn-block', 'onclick'=> 'myFunction()']) ?>
        </div><!-- /.box-body -->
        <div id="loading"><br/><br/></div>
      </div><!-- /.box -->
        <?php } ?>
</div>


<script>
function myFunction() {
    var d1 = document.getElementById('loading');
   d1.insertAdjacentHTML('afterend', '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  }
</script>