<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DiparealisasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Realisasi Anggaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dipa-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'hover' => $hover,
        'showPageSummary' => $pageSummary,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class = "glyphicon glyphicon-book"></i> '
        ],
        'containerOptions' => ['style' => 'overflow: auto; font-size:12px;'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'text-center info'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
//            'persistResize' => true,
        'beforeHeader' => [
                [
                'columns' => [
                        ['content' => 'PROGRAM/KEGIATAN/OUTPUT/SUBOUTPUT/<br>KOMPONEN/SUBKOMP/AKUN/DETIL', 'options' => ['colspan' => 2, 'class' => 'text-center info']],
                        ['content' => 'PERHITUNGAN TAHUN 2018', 'options' => ['colspan' => 4, 'class' => 'text-center info']],
                        ['content' => 'SERAPAN ANGGARAN', 'options' => ['colspan' => 14, 'class' => 'text-center info']],
                        ['content' => ' ', 'options' => ['colspan' => 1, 'class' => 'text-center info']],
                ],
//                    'options' => ['class' => 'skip-export'] // remove this row from export
            ]
        ],
        'columns' => [
            'kode',
                [
                'attribute' => 'uraian',
                'value' => 'uraian',
                'contentOptions' => ['style' => 'font-size:10px;'],
            ],
                [
                'attribute' => 'vol',
                'value' => function($data) {
                    return $data->dipa->vol;
                }
            ],
                [
                'attribute' => 'sat',
                'value' => function($data) {
                    return $data->dipa->sat;
                }
            ],
                [
                'attribute' => 'hargasat',
                'value' => function($data) {
                    return number_format($data->dipa->hargasat, 0);
                }
            ],
                [
                'attribute' => 'jumlah',
                'value' => function($data) {
                    return number_format($data->dipa->jumlah, 0);
                }
            ],
//                'sat',
            [
                'attribute' => 'januari',
                'format' => 'html',
                'value' => function($data) {
                    if ($data->januari !== null) {
                        if ($data->januari < 0) {
                            return "<font color='red'>" . number_format($data->januari, 0) . '</font>';
                        }
                        return number_format($data->januari, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'februari',
                'value' => function($data) {
                    if ($data->februari !== null) {
                        return number_format($data->februari, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'maret',
                'value' => function($data) {
                    if ($data->maret !== null) {
                        return number_format($data->maret, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'april',
                'value' => function($data) {
                    if ($data->april !== null) {
                        return number_format($data->april, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'mei',
                'value' => function($data) {
                    if ($data->mei !== null) {
                        return number_format($data->mei, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'juni',
                'value' => function($data) {
                    if ($data->juni !== null) {
                        return number_format($data->juni, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'juli',
                'value' => function($data) {
                    if ($data->juli !== null) {
                        return number_format($data->juli, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'agustus',
                'value' => function($data) {
                    if ($data->agustus !== null) {
                        return number_format($data->agustus, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'september',
                'value' => function($data) {
                    if ($data->september !== null) {
                        return number_format($data->september, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'oktober',
                'value' => function($data) {
                    if ($data->oktober !== null) {
                        return number_format($data->oktober, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'november',
                'value' => function($data) {
                    if ($data->november !== null) {
                        return number_format($data->november, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'attribute' => 'desember',
                'value' => function($data) {
                    if ($data->desember !== null) {
                        return number_format($data->desember, 0);
                    } else {
                        return '';
                    }
                }
            ],
                [
                'header' => 'Total',
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
                    if (array_sum($realis[0]) == true) {
                        $uang = array_sum($realis[0]);
                        return 'Rp. ' . number_format($uang, 0);
                    } else {
                        return '';
                    }
                },
                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;
        '],
                'filter' => false,
            ],
                [
                'header' => 'Persentase',
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
//                            for ($jumlah = 0; $jumlah < count($realis); $jumlah++) {
//                                $a[$jumlah] = $realis[$jumlah][realisasi];
//                            };
                        $uang = array_sum($realis[0]);
                        print_r($realis[0]);
                        die();
                        if ($uang / $jum * 100 > 100) {
                            return "<font color='red'>" . round($uang / $jum * 100, 2) . ' %</font>';
                        } else {
                            return round($uang / $jum * 100, 2) . ' %';
                        }
                    } else {
                        return '';
                    }
                },
                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;
        '],
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
                            return "<font color='red'>" . number_format($jum - $uang, 0) . '</font>';
                        } else {
                            return 'Rp. ' . number_format($jum - $uang, 0);
                        }
                    } else {
                        return 'Rp. ' . number_format($data->dipa->jumlah, 0);
                    }
                },
                'contentOptions' => ['class' => 'col-lg-1', 'style' => 'text-align: left;
        '],
                'filter' => false,
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'exportConfig' => [
//            GridView::CSV => ['label' => 'Export as CSV', 'filename' => 'File_Name-' . date('d-M-Y')],
//            GridView::HTML => ['label' => 'Export as HTML', 'filename' => 'File_Name -' . date('d-M-Y')],
//            GridView::PDF => ['label' => 'Export as PDF', 'filename' => 'File_Name -' . date('d-M-Y')],
            GridView::EXCEL => ['label' => 'Export as EXCEL', 'filename' => 'Realisasi Anggaran -' . date('d-M-Y')],
//            GridView::TEXT => ['label' => 'Export as TEXT', 'filename' => 'File_Name -' . date('d-M-Y')],
        ],
        'export' => [
            'fontAwesome' => true
        ],
    ]);
    ?>
</div>

<?php
$this->registerJs('
        $("#inputcari").on("input", function(e){
        if($(this).data("lastval") != $(this).val()){
        $(this).data("lastval", $(this).val());
        //change action
        $("#buttoncari").attr("data-params", "{\"cari\":\""+$(this).val()+"\"}");
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

<div class="diparealisasi-index">


</div>
