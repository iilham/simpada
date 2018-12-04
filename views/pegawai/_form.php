<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
$jabatan=ArrayHelper::map(\app\models\Jabatan::find()->where(['!=', 'id_jabatan', 1])->all(), 'id_jabatan', 'jabatan');
$model->username='';
$model->password='';
?>

<div class="pegawai-form">


      <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>

      <?= $form->field($model, 'username') ?>

      <?= $form->field($model, 'password')->passwordInput() ?>

      <?= $form->field($model, 'nip')->textInput()->label('NIP') ?>

      <?= $form->field($model, 'nip_lama')->textInput()->label('NIP Lama (5 digit terakhir)') ?>

      <?= $form->field($model, 'nama')->textInput()->label('Nama') ?>

      <?= $form->field($model, 'id_jabatan')->dropDownList($jabatan, ['prompt' => '---- Pilih Jabatan ----'])->label('Jabatan') ?>

      <?= $form->field($model, 'pangkat')->textInput()->label('Pangkat') ?>

      <?= $form->field($model, 'golongan')->textInput()->label('Golongan') ?>

      <?php // $form->field($model, 'is_motordinas')->dropDownList(['1' => '1. Ya', '2' => '2. Tidak'],['prompt'=>'Apakah Memiliki Motor Dinas?'])->label('Motor Dinas') ?>

      <div class="form-group" style="float:right">
          <?= Html::submitButton('Signup',['class'=>'btn btn-success','name'=>'signup-button']) ?>
      </div>

      <?php ActiveForm::end(); ?>

</div>
