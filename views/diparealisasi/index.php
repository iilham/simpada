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
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <?php
    $sql = 'SELECT `keterangan` FROM `diparealisasi`';
    $s = \Yii::$app->db->createCommand($sql)->queryScalar();
    if ($s == 0) {
        $sel = 'SELECT `bulan_id`, `program`, `kegiatan`, `output`, `suboutput`, `komponen`, `subkomp`, `akun`, `uraian`, `realisasi` FROM `diparealisasi`';
        $ambil = \Yii::$app->db->createCommand($sel)->queryAll();
        for ($i = 0; $i <= count($ambil); $i++) {
//            print_r($ambil[$i]['bulan_id']);
            $bulan = $ambil[$i]['bulan_id'];
            switch ($bulan) {
                case "1":
                    $program1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('januari');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('januari');
                    $output1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('januari');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('januari');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('januari');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('januari');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "2":
                    $program1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('februari');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('februari');
                    $output1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('februari');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('februari');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('februari');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('februari');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "3":
                    $program1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('maret');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('maret');
                    $output1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('maret');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('maret');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('maret');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('maret');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "4":
                    $program1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('april');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('april');
                    $output1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('april');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('april');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('april');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('april');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "5":
                    $program1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('mei');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('mei');
                    $output1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('mei');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('mei');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('mei');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('mei');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "6":
                    $program1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('juni');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('juni');
                    $output1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('juni');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('juni');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('juni');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('juni');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "7":
                    $program1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('juli');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('juli');
                    $output1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('juli');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('juli');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('juli');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('juli');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "8":
                    $program1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('agustus');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('agustus');
                    $output1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('agustus');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('agustus');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('agustus');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('agustus');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "9":
                    $program1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('september');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('september');
                    $output1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('september');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('september');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('september');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('september');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "10":
                    $program1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('oktober');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('oktober');
                    $output1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('oktober');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('oktober');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('oktober');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('oktober');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "11":
                    $program1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('november');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('november');
                    $output1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('november');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('november');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('november');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('november');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "12":
                    $program1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('desember');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null])->sum('desember');
                    $output1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null])->sum('desember');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->sum('desember');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('desember');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('desember');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
            }
            $updt = 'UPDATE `diparealisasi` SET `keterangan`= 1 WHERE 1';
            \Yii::$app->db->createCommand($updt)->execute();
        }
    } else {
        echo'';
    }
    ?>

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
