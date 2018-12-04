<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DiparealisasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diparealisasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'bulan_id') ?>

    <?= $form->field($model, 'program') ?>

    <?= $form->field($model, 'kegiatan') ?>

    <?php // echo $form->field($model, 'output') ?>

    <?php // echo $form->field($model, 'suboutput') ?>

    <?php // echo $form->field($model, 'komponen') ?>

    <?php // echo $form->field($model, 'subkomp') ?>

    <?php // echo $form->field($model, 'uraian') ?>

    <?php // echo $form->field($model, 'realisasi') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
