<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Diparealisasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diparealisasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'user_id')->textInput() ?>

    <?php // $form->field($model, 'program')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'kegiatan')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'output')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'suboutput')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'komponen')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'subkomp')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'realisasi')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'bulan_id')->dropDownList(
            ['1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus'
        , '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'], ['prompt' => 'Pilih Bulan']
    );
    ?>
    <?php // $form->field($model, 'bulan_id')->textInput() ?>
    <?php
    if (Yii::$app->session->hasFlash('error')) {
        echo Yii::$app->session->getFlash('ero');
    }
    ?>

    <?php $form->field($model, 'timestamp')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => $pageSummary,
//        'toggleDataOptions' => ['minCount' => 30],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-book"></i>  '
        ],
        'toolbar' => [
            [
            ],
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'default'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'program',
            'kegiatan',
            'output',
//            'suboutput',
            'komponen',
            'subkomp',
            'akun',
            'uraian',
                [
                'attribute' => 'realisasi',
                'value' => function($data) {
                    return 'Rp ' . number_format($data->realisasi, 0);
                },
                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;'],
                'filter' => false,
            ],
            'bulan_id',
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
//                'id' => 'modalButton',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $data) {
                        return Html::a('<span class="glyphicon glyphicon-trash" id = "modalButton"></span>', Url::toRoute(['/diparealisasi/deletee?program=' . $data->program . '&&kegiatan=' . $data->kegiatan . '&&output=' . $data->output .
                                            '&&suboutput=' . $data->suboutput . '&&komponen=' . $data->komponen .
                                            '&&subkomp=' . $data->subkomp . '&&akun=' . $data->akun . '&&uraian=' . $data->uraian . '&&bulan=' . $data->bulan_id . '&&realisasi=' . $data->realisasi . '&&id=' . $data->id]), [
                                    'title' => Yii::t('app', 'update realisasi'), 'id' => 'modalButton',
                        ]);
                    },
                ],
            ],
        ],
    ]);
    ?>

</div>
