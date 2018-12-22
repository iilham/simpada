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
                        'toolbar' => [
                            ['content' =>
                                Html::a('<i class = "glyphicon glyphicon-repeat"></i>', Url::toRoute([]), ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                            ],
                            '{toggleData}',
                        ],
                        'containerOptions' => ['style' => 'overflow: auto', 'style' => 'font-size:12px;'], // only set when $responsive = false
                        'headerRowOptions' => ['class' => 'text-center info', 'style' => 'font-size:12px;'],
                        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                        'persistResize' => false,
                        'columns' => [
                            [
                                'attribute' => 'akun',
                                'value' => 'akun',
                                'contentOptions' => ['style' => 'width:6%'],
                            ],
                            [
                                'attribute' => 'uraian',
                                'value' => 'uraian',
                                'contentOptions' => ['style' => 'font-size:11px;'],
                            ],
                            [
                                'attribute' => 'jumlah',
                                'value' => function($data) {
                                    return 'Rp ' . number_format($data->jumlah, 0);
                                },
                                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left; width:13%'],
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
                                            return "<font color='red'>Rp " . number_format($jum - $uang, 0) . '</font>';
                                        } else {
                                            return 'Rp ' . number_format($jum - $uang, 0);
                                        }
                                    } else {
                                        return 'Rp ' . number_format($data->jumlah, 0);
                                    }
                                },
                                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;width:13%'],
                                'filter' => false,
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '',
                                'headerOptions' => ['style' => 'color:#337ab7'],
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        if ($model->hargasat == '0') {
                                            return '';
                                        } else {
                                            return Html::a('<span class="glyphicon glyphicon-pencil" id = "modalButton"></span>', Url::toRoute(['/diparealisasi/update?program=' . $model->program . '&&kegiatan=' . $model->kegiatan . '&&output=' . $model->output .
                                                                '&&suboutput=' . $model->suboutput . '&&komponen=' . $model->komponen .
                                                                '&&subkomp=' . $model->subkomp . '&&akun=' . $model->akun . '&&uraian=' . $model->uraian]), [
                                                        'title' => Yii::t('app', 'update realisasi'), 'id' => 'modalButton', 'data-toggle'=>"modal", 'data-target'=>"#myModal", 'data-title'=>"Entry Data",
//                                                                    'target' => '_blank'
                                            ]);
                                        }
                                    },
                                ],
                            ],
                        ],
                    ]);
                    ?>



                </div>
            </div>
        </div>
    </div>
</div>
<?=
    $this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
?>
<?php
Modal::begin([
    'id' => 'myModal',
    'size' => 'modal-lg',
    'header' => '<h5 class="modal-title">...</h5>',
]);
 
echo '...';
 
Modal::end();
?>