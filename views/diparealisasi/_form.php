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
    <?= $form->field($model, 'realisasi')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'bulan_id')->dropDownList(
            ['1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus'
        , '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'], ['prompt' => 'Pilih Bulan']
    );
    ?>
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
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => $pageSummary,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-book"></i>  '
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'default'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
            'program',
//            'kegiatan',
            'output',
//            'suboutput',
//            'komponen',
//            'subkomp',
            'akun',
            'uraian',
                [
                'attribute' => 'realisasi',
                'value' => function($data) {
                    return 'Rp ' . number_format($data->realisasi, 0);
                },
                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left; width:13%'],
                'filter' => false,
            ],
            'bulan_id',
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
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
