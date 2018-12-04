<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DipaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dipa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>
    <?php // $form->field($model, 'baris') ?>
    <?php // $form->field($model, 'kode') ?>

    <?php echo $form->field($model, 'program') ?>

    <?php echo $form->field($model, 'kegiatan') ?>

    <?php echo $form->field($model, 'output') ?>

    <?php // echo $form->field($model, 'suboutput') ?>

    <?php echo $form->field($model, 'komponen') ?>

    <?php echo $form->field($model, 'subkomp') ?>
    
    <?php echo $form->field($model, 'akun') ?>

    <?php // echo $form->field($model, 'uraian') ?>

    <?php // echo $form->field($model, 'vol') ?>

    <?php // echo $form->field($model, 'sat') ?>

    <?php // echo $form->field($model, 'hargasat') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'dipamaster_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
