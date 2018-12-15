<?php

namespace app\controllers;

use Yii;
use app\models\Diparealisasi;
use app\models\DiparealisasiSearch;
use app\models\DipabulananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiparealisasiController implements the CRUD actions for Diparealisasi model.
 */
class DiparealisasiController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSynchron() {
        $sel = 'SELECT `bulan_id`, `program`, `kegiatan`, `output`, `suboutput`, `komponen`, `subkomp`, `akun`, `uraian`, `realisasi` FROM `diparealisasi`';
        $ambil = \Yii::$app->db->createCommand($sel)->queryAll();
        for ($i = 0; $i <= count($ambil); $i++) {
            $bulan = $ambil[$i]['bulan_id'];
            switch ($bulan) {
                case "1":
                    $program1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "2":
                    $program1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "3":
                    $program1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "4":
                    $program1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "5":
                    $program1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "6":
                    $program1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "7":
                    $program1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "8":
                    $program1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "9":
                    $program1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "10":
                    $program1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "11":
                    $program1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
                case "12":
                    $program1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $program1], ['program' => $ambil[$i]['program'], 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $kegiatan1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $output1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $output1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $komponen1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => null, 'akun' => null])->execute();
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $subkomp1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => null])->execute();
                    $akun1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $akun1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'vol' => 0, 'sat' => ''])->execute();
                    $detil1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output'], 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $ambil[$i]['realisasi'] + $detil1], ['program' => $ambil[$i]['program'], 'kegiatan' => $ambil[$i]['kegiatan'], 'output' => $ambil[$i]['output']
                                , 'komponen' => $ambil[$i]['komponen'], 'subkomp' => $ambil[$i]['subkomp'], 'akun' => $ambil[$i]['akun'], 'uraian' => $ambil[$i]['uraian']])->execute();
                    break;
            }
            $updt = 'UPDATE `diparealisasi` SET `keterangan`= 1 WHERE 1';
            \Yii::$app->db->createCommand($updt)->execute();
        }
    }
    public function actionIndex() {
        $searchModel = new DipabulananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Diparealisasi();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($program, $kegiatan, $output, $suboutput, $komponen, $subkomp, $akun, $uraian, $urll) {
        $model = new Diparealisasi();
        $model->user_id = Yii::$app->user->id;
        $model->program = $program;
        $model->kegiatan = $kegiatan;
        $model->output = $output;
        $model->komponen = $komponen;
        $model->subkomp = $subkomp;
        $model->akun = $akun;
        $model->uraian = $uraian;
        if ($model->load(Yii::$app->request->post())) {
            $searchModel = new DiparealisasiSearch();
            $dataProvider = $searchModel->search1(Yii::$app->request->queryParams, $program, $kegiatan, $output, $suboutput, $komponen, $subkomp, $akun, $uraian);
            $pos_variable = Yii::$app->request->post('Diparealisasi');
            $bulan = $pos_variable['bulan_id'];
            $realisasi = $pos_variable['realisasi'];
            switch ($bulan) {
                case "1":
                    $program1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                    $output1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('januari');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('januari');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('januari');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['januari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('januari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['januari' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "2":
                    $program1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                    $output1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('februari');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('februari');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('februari');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['februari'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('februari');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['februari' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "3":
                    $program1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                    $output1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('maret');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('maret');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('maret');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['maret'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('maret');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['maret' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "4":
                    $program1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                    $output1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('april');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('april');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('april');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['april'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('april');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['april' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "5":
                    $program1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                    $output1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('mei');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('mei');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('mei');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['mei'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('mei');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['mei' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "6":
                    $program1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                    $output1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('juni');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('juni');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('juni');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['juni'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('juni');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juni' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "7":
                    $program1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                    $output1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('juli');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('juli');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('juli');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['juli'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('juli');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['juli' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "8":
                    $program1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    $output1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('agustus');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('agustus');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('agustus');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['agustus'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('agustus');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['agustus' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "9":
                    $program1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                    $output1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('september');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('september');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('september');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['september'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('september');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['september' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "10":
                    $program1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    $output1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('oktober');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('oktober');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('oktober');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['oktober'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('oktober');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['oktober' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "11":
                    $program1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                    $output1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('november');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('november');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('november');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['november'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('november');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['november' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
                case "12":
                    $program1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                    $kegiatan1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                    $output1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                    $komponen1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->sum('desember');
                    $subkomp1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->sum('desember');
                    $akun1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->sum('desember');
                    $detil1 = (new \yii\db\Query())
                                    ->select(['desember'])->from('dipabulanan')
                                    ->where(['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output, 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->sum('desember');
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $program1], ['program' => $model->program, 'kegiatan' => null, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $kegiatan1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => null
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $output1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $komponen1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => null, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $subkomp1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => null])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $akun1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'vol' => 0, 'sat' => ''])->execute();
                    Yii::$app->db->createCommand()
                            ->update('dipabulanan', ['desember' => $realisasi + $detil1], ['program' => $model->program, 'kegiatan' => $model->kegiatan, 'output' => $model->output
                                , 'komponen' => $model->komponen, 'subkomp' => $model->subkomp, 'akun' => $model->akun, 'uraian' => $model->uraian])->execute();
                    break;
            }
            $model->save();
            return $this->redirect(['dipa/',
            ]);
        }
        $searchModel = new DiparealisasiSearch();
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams, $program, $kegiatan, $output, $suboutput, $komponen, $subkomp, $akun, $uraian);

        return $this->render('update', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletee($program, $kegiatan, $output, $suboutput, $komponen, $subkomp, $akun, $uraian, $bulan, $realisasi, $id) {

        switch ($bulan) {
            case "1":
                $program1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                $output1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('januari');
                $komponen1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('januari');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('januari');
                $akun1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('januari');
                $detil1 = (new \yii\db\Query())
                                ->select(['januari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('januari');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['januari' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "2":
                $program1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                $output1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('februari');
                $komponen1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('februari');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('februari');
                $akun1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('februari');
                $detil1 = (new \yii\db\Query())
                                ->select(['februari'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('februari');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['februari' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "3":
                $program1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                $output1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('maret');
                $komponen1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('maret');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('maret');
                $akun1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('maret');
                $detil1 = (new \yii\db\Query())
                                ->select(['maret'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('maret');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['maret' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "4":
                $program1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                $output1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('april');
                $komponen1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('april');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('april');
                $akun1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('april');
                $detil1 = (new \yii\db\Query())
                                ->select(['april'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('april');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['april' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "5":
                $program1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                $output1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('mei');
                $komponen1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('mei');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('mei');
                $akun1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('mei');
                $detil1 = (new \yii\db\Query())
                                ->select(['mei'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('mei');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['mei' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "6":
                $program1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                $output1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juni');
                $komponen1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('juni');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('juni');
                $akun1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('juni');
                $detil1 = (new \yii\db\Query())
                                ->select(['juni'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('juni');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juni' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "7":
                $program1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                $output1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('juli');
                $komponen1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('juli');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('juli');
                $akun1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('juli');
                $detil1 = (new \yii\db\Query())
                                ->select(['juli'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('juli');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['juli' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "8":
                $program1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                $output1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('agustus');
                $komponen1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('agustus');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('agustus');
                $akun1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('agustus');
                $detil1 = (new \yii\db\Query())
                                ->select(['agustus'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('agustus');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['agustus' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "9":
                $program1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                $output1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('september');
                $komponen1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('september');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('september');
                $akun1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('september');
                $detil1 = (new \yii\db\Query())
                                ->select(['september'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('september');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['september' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "10":
                $program1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                $output1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('oktober');
                $komponen1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('oktober');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('oktober');
                $akun1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('oktober');
                $detil1 = (new \yii\db\Query())
                                ->select(['oktober'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('oktober');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['oktober' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "11":
                $program1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                $output1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('november');
                $komponen1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('november');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('november');
                $akun1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('november');
                $detil1 = (new \yii\db\Query())
                                ->select(['november'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('november');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['november' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
            case "12":
                $program1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => null, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                $kegiatan1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => null, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                $output1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => null, 'subkomp' => null, 'akun' => null])->sum('desember');
                $komponen1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->sum('desember');
                $subkomp1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->sum('desember');
                $akun1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->sum('desember');
                $detil1 = (new \yii\db\Query())
                                ->select(['desember'])->from('dipabulanan')
                                ->where(['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output, 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->sum('desember');
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $program1 - $realisasi], ['program' => $program, 'kegiatan' => null, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $kegiatan1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => null
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $output1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => null, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $komponen1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => null, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $subkomp1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => null])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $akun1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'vol' => 0, 'sat' => ''])->execute();
                Yii::$app->db->createCommand()
                        ->update('dipabulanan', ['desember' => $detil1 - $realisasi], ['program' => $program, 'kegiatan' => $kegiatan, 'output' => $output
                            , 'komponen' => $komponen, 'subkomp' => $subkomp, 'akun' => $akun, 'uraian' => $uraian])->execute();
                $dell = "DELETE FROM `diparealisasi` WHERE `id`= $id";
                \Yii::$app->db->createCommand($dell)->execute();
                break;
        }

        return $this->redirect(['dipa/index']);
    }

    protected function findModel($id) {
        if (($model = Diparealisasi::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
