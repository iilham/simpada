<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DipaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dipa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dipa-index">
    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">Cari <?= $cari ?></h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-11">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Kata Kunci" id="inputcari" value="<?= $cari ?>">
                        <span class="input-group-btn">
                            <?=
                            Html::a('Cari', ['/dipa/searchdipa'], [
                                'id' => 'buttoncari',
                                'class' => 'btn btn-primary',
                                'data-method' => 'GET',
                                'data-params' => [
                                    'cari' => $cari,
                                ],
                            ])
                            ?>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-1">
                    <?= Html::a('Clear', ['/dipa/listdipa'], ['class' => 'btn btn-warning']) ?>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div>
        <?php
        $tekscari = '';
        if (strlen($cari) > 0) {
            $tekscari = "Hasil Pencarian Untuk Kata Kunci " . $cari;
        }
        ?>
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'hover' => true,
            'panel' => [
//                'type' => GridView::TYPE_PRIMARY,
                'heading' => '<i class="glyphicon glyphicon-book"></i>  ' . $tekscari
            ],
            'beforeHeader' => [
                    [
                    'columns' => [
                            ['content' => 'Header Before 1', 'options' => ['colspan' => 2, 'class' => 'text-center warning']],
                            ['content' => 'Header Before 2', 'options' => ['colspan' => 4, 'class' => 'text-center box-primary']],
                            ['content' => 'Header Before 3', 'options' => ['colspan' => 3, 'class' => 'text-center primary']],
                    ],
//                    'options' => ['class' => 'skip-export'] // remove this row from export
                ]
            ],
            'toolbar' => [
                '{export}',
                '{toggleData}'
            ],
//            'toolbar' => [''],
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'default'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'persistResize' => false,
            'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
//                'id',
//                'baris',
//                'kode',
                'program',
                'kegiatan',
                'output',
                'suboutput',
                'komponen',
                'subkomp',
                'uraian',
//                'vol',
//                'sat',
//                'hargasat',
                [
//                    'format' => ['decimal',0],
                    'format' => ['Currency', 'Rp.'],
                    'attribute' => 'hargasat',
                    'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: right;'],
                ],
//                'jumlah',
//                    [
//                    'format' => 'Currency',
//                    'attribute' => 'jumlah',
//                    'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: right;'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '',
                    'headerOptions' => ['style' => 'color:#337ab7'],
                    'template' => '{update}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('app', 'lead-update'),
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') {
                            $url = '../diparealisasi/update?program=' . $model->program.'&&kegiatan='. $model->kegiatan.'&&output='. $model->output.
                                    '&&suboutput='. $model->suboutput.'&&komponen='. $model->komponen.
                                    '&&subkomp='. $model->subkomp.'&&uraian='. $model->uraian;
                            return $url;
                        }
                    }
                ],
            ],
        ]);
        ?>
    </div>

    <?php
//echo Yii::$app->formatter->asCurrency(9912321.00, 'EUR',[\NumberFormatter::MAX_SIGNIFICANT_DIGITS=>100]);
    $this->registerJs('
$("#inputcari").on("input",function(e){
  if($(this).data("lastval")!= $(this).val()){
    $(this).data("lastval",$(this).val());
    //change action
    $("#buttoncari").attr("data-params","{\"cari\":\""+$(this).val()+"\"}");
  };
});
$("#inputcari").keypress(function (e) {
 var key = e.which;
 if(key == 13)
  {
    $("#buttoncari").click();
    return false;
  }
});
'
    )
    ?>

</div>