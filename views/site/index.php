<?php

use app\models\DipaMaster;
use yii\helpers\Html;
$helper=Yii::$app->myHelper;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);


$this->title = 'Monitoring';
$this->params['breadcrumbs'][] = ['label' => 'Dipa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$tahun = date("Y");

$realis = (new \yii\db\Query())
        ->select(['realisasi', 'bulan_id'])
        ->from('diparealisasi')
        ->all();
$jan = [0];
$feb = [0];
$mar = [0];
$apr = [0];
$meii = [0];
$jun = [0];
$jul = [0];
$ags = [0];
$sep = [0];
$okt = [0];
$nov = [0];
$des = [0];
for ($jumlah = 0; $jumlah < count($realis); $jumlah++) {
    $a[$jumlah] = $realis[$jumlah]["realisasi"];
    if ($realis[$jumlah]["bulan_id"] == 1) {
        $jan[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 2) {
        $feb[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 3) {
        $mar[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 4) {
        $apr[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 5) {
        $meii[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 6) {
        $jun[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 7) {
        $jul[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 8) {
        $ags[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 9) {
        $sep[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 10) {
        $okt[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 11) {
        $nov[$jumlah] = $realis[$jumlah]["realisasi"];
    }
    if ($realis[$jumlah]["bulan_id"] == 12) {
        $des[$jumlah] = $realis[$jumlah]["realisasi"];
    }
};
$januari = array_sum($jan);
$februari = array_sum($feb);
$maret = array_sum($mar);
$april = array_sum($apr);
$mei = array_sum($meii);
$juni = array_sum($jun);
$juli = array_sum($jul);
$agustus = array_sum($ags);
$september = array_sum($sep);
$oktober = array_sum($okt);
$november = array_sum($nov);
$desember = array_sum($des);
$kab = $helper->pengaturan()->kabupaten;
//sementara gini dulu yaaa

echo Highcharts::widget([
    'options' => [
        'scripts' => array(
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            'modules/exporting', // adds Exporting button/menu to chart
            'themes/grid'        // applies global 'grid' theme to all charts
        ),
        'title' => ['text' => "Penyerapan Anggaran <br> $kab Tahun $tahun "],
        'xAxis' => [
            'title' => ['text' => 'Bulan'],
            'categories' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
        ],
        'yAxis' => [
            'title' => ['text' => 'Realisasi']
        ],
        'plotOptions'=>[
          'line' =>[
              'dataLabels'=> [ 'enabled'=>TRUE
          ]]  
        ],
        'tooltip' => array(
            'formatter' => 'js:function(){ return this.series.name; }'
        ),
        'series' => [
            // ['name' => 'Jane', 'data' => [1, 0, 4]],
                ['name' => 'Rupiah', 'data' => [$januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember]]
        ],
    ]
]);
?>

