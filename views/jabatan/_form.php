<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\Jabatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jabatan')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'kode_seksi')->textarea(['rows' => 1]) ?>

    <div class="form-group" style="float:right">
        <?= Html::submitButton($model->isNewRecord ? 'Buat Jabatan' : 'Ubah Detail Jabatan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-info','id' => 'okbutton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(
    "
      $(('#jabatan-jabatan')).focus();
      $('#jabatan-jabatan').on('keydown', function (e) {
      if (e.which == 13) {
          $('#okbutton').trigger('click');
          return false;
       }
      });
    ",
    View::POS_READY
  );
 ?>
