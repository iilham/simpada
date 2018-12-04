<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dipa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dipa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'baris')->textInput() ?>

    <?php $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'program')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'kegiatan')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'output')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'suboutput')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'komponen')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'subkomp')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'vol')->textInput() ?>

    <?php $form->field($model, 'sat')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'hargasat')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'dipamaster_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
