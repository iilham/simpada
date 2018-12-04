<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
  $pegawai=ArrayHelper::map(\app\models\Pegawai::find()->all(), 'id', 'nama');
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'satker')->textarea(['rows' => 2])->label('Satuan Kerja') ?>

    <?= $form->field($model, 'kodesatker')->textInput()->label('Kode Satuan Kerja') ?>

    <?= $form->field($model, 'alamat')->textInput()->label('Ibukota Kecamatan/Kelurahan') ?>

    <?= $form->field($model, 'kabupaten')->textInput()->label('Kabupaten/Kota') ?>

    <?= $form->field($model, 'provinsi')->textInput()->label('Provinsi') ?>

    <?= $form->field($model, 'alamatlengkap')->textarea(['rows' => 2])->label('Alamat Lengkap') ?>

    

    <div class="form-group"  style="float:right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Ubah Konfigurasi', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
