<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DipaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dipa';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
Modal::begin([
    'header' => '<h4>Update Model</h4>',
    'id' => 'update-modal',
    'size' => 'modal-lg'
]);

echo "<div id='updateModalContent'></div>";

Modal::end();
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-3">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class = "glyphicon glyphicon-search"></i> <h4 class="box-title"> Pencarian</h4> 
                </div>
                <div class="box-body">
                    <div id="Pencarian">
                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'showPageSummary' => $pageSummary,
                        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
                        'hover' => true,
//                        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
//            'heading' => '<i class="glyphicon glyphicon-book"></i>  ' . $tekscari
//                        ],
//                        'beforeHeader' => [
//                                [
//                                'columns' => [
//                                        ['content' => 'Kode', 'options' => ['colspan' => 3, 'class' => 'text-center info']],
//                                        ['content' => ' ', 'options' => ['colspan' => 2, 'class' => 'text-center info']],
//                                ],
////                    'options' => ['class' => 'skip-export'] // remove this row from export
//                            ]
//                        ],
                        'toolbar' => [
                                ['content' =>
                                Html::a('<i class = "glyphicon glyphicon-repeat"></i>', Url::toRoute([]), ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                            ],
//                '{export}',
                            '{toggleData}',
                        ],
//            'toolbar' => [''],
                        'containerOptions' => ['style' => 'overflow: auto', 'style' => 'font-size:12px;'], // only set when $responsive = false
                        'headerRowOptions' => ['class' => 'text-center info', 'style' => 'font-size:12px;'],
                        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                        'persistResize' => false,
                        'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
//                'id',
//                'baris',
//                'kode',
//            'program',
//            'kegiatan',
//            'output',
//                'suboutput',
//            'komponen',
//            'subkomp',
                            'akun',
                                [
                                'attribute' => 'uraian',
                                'value' => 'uraian',
                                'contentOptions' => ['style' => 'font-size:10px;'],
                            ],
//                'uraian',
//            'vol',
//            'sat',
//                [
//                'attribute' => 'hargasat',
//                'value' => function($data) {
//                    return 'Rp ' . number_format($data->hargasat, 0);
//                },
//                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;'],
//                'filter' => false,
//            ],
                            [
                                'attribute' => 'jumlah',
                                'value' => function($data) {
                                    return 'Rp ' . number_format($data->jumlah, 0);
                                },
                                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;'],
                                'filter' => false,
                            ],
                                [
                                'header' => 'Sisa',
                                'format' => 'html',
                                'value' => function($data) {
                                    $realis = (new \yii\db\Query())
                                            ->select(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])
                                            ->from('dipabulanan')
                                            ->where([
                                                'program' => $data->program,
                                                'kegiatan' => $data->kegiatan,
                                                'output' => $data->output,
                                                'suboutput' => $data->suboutput,
                                                'komponen' => $data->komponen,
                                                'subkomp' => $data->subkomp,
                                                'uraian' => $data->uraian,
                                            ])
                                            ->all();
                                    $jum = (new \yii\db\Query())
                                            ->select(['jumlah'])
                                            ->from('dipa')
                                            ->where([
                                                'program' => $data->program,
                                                'kegiatan' => $data->kegiatan,
                                                'output' => $data->output,
                                                'suboutput' => $data->suboutput,
                                                'komponen' => $data->komponen,
                                                'subkomp' => $data->subkomp,
                                                'uraian' => $data->uraian,
                                            ])
                                            ->sum('jumlah');
                                    if (array_sum($realis[0]) == true) {
                                        $uang = array_sum($realis[0]);
                                        if ($jum - $uang < 0) {
                                            return "<font color='red'>Rp " . number_format($jum - $uang, 0).'</font>';
                                        } else {
                                            return 'Rp ' . number_format($jum - $uang, 0);
                                        }
                                    } else {
                                        return 'Rp ' . number_format($data->jumlah, 0);
                                    }
                                },
                                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;
        '],
                                'filter' => false,
                            ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'options' => ['class' => 'action-column'],
//                'template' => '{update}',
//                'buttons' => [
//                    'update' => function($url, $model) {
//                        $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
//                                    'value' => Url::toRoute(['/diparealisasi/update?program=' . $model->program . '&&kegiatan=' . $model->kegiatan . '&&output=' . $model->output .
//                                                '&&suboutput=' . $model->suboutput . '&&komponen=' . $model->komponen .
//                                                '&&subkomp=' . $model->subkomp . '&&akun=' . $model->akun . '&&uraian=' . $model->uraian]), //<---- here is where you define the action that handles the ajax request
//                                    'class' => 'update-modal-click grid-action',
//                                    'data-toggle' => 'tooltip',
//                                    'data-placement' => 'bottom',
//                                    'title' => 'Update'
//                        ]);
//                        return $btn;
//                    }
//                ]
//            ],z
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '',
//                'id' => 'modalButton',
                                'headerOptions' => ['style' => 'color:#337ab7'],
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        if ($model->hargasat == '0') {
                                            return '';
                                        } else {
                                            return Html::a('<span class="glyphicon glyphicon-pencil" id = "modalButton"></span>', Url::toRoute(['/diparealisasi/update?program=' . $model->program . '&&kegiatan=' . $model->kegiatan . '&&output=' . $model->output .
                                                                '&&suboutput=' . $model->suboutput . '&&komponen=' . $model->komponen .
                                                                '&&subkomp=' . $model->subkomp . '&&akun=' . $model->akun . '&&uraian=' . $model->uraian. '&&urll='.$_SERVER['REQUEST_URI']]), [
                                                        'title' => Yii::t('app', 'update realisasi'), 'id' => 'modalButton',
//                                                                    'target' => '_blank'
                                            ]);
                                        }
                                    },
                                ],
//                'urlCreator' => function ($action, $model) {
//                    if ($action === 'update') {
//                        $url = Url::toRoute(['/diparealisasi/update?program=' . $model->program . '&&kegiatan=' . $model->kegiatan . '&&output=' . $model->output .
//                                    '&&suboutput=' . $model->suboutput . '&&komponen=' . $model->komponen .
//                                    '&&subkomp=' . $model->subkomp . '&&akun=' . $model->akun . '&&uraian=' . $model->uraian]);
//                        return $url;
//                    }
//                }
                            ],
                        ],
                    ]);
                    ?>



                </div>
            </div>
        </div>
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
        $("body").on("hidden.bs.modal", ".modal", function () {
    $(this).removeData("bs.modal");
})
'
    );
    ?>
