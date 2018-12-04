<?php

namespace app\controllers;

use Yii;
use app\models\Dipa;
use app\models\DipaSearch;
use app\models\DipaMaster;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class DipaController extends Controller {

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

    public function actionIndex() {
        $searchModel = new DipaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex1() {
        $searchModel = new DipaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index_1', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionBaris($id) {
        $mode = static::findOne(['id' => $id]);
        $realis = (new \yii\db\Query())
                ->select(['realisasi', 'bulan_id'])
                ->from('diparealisasi')
                ->where([
                    'program' => $mode->program,
                    'kegiatan' => $mode->kegiatan,
                    'output' => $mode->output,
                    'suboutput' => $mode->suboutput,
                    'komponen' => $mode->komponen,
                    'subkomp' => $mode->subkomp,
                    'uraian' => $mode->uraian,
                    'bulan_id' => $bulan,
                ])
                ->all();
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Dipa();
        $model1 = new DipaMaster();
        if ($model1->load(Yii::$app->request->post())) {
            $sel = 'SELECT `id` FROM `dipa`';
            $acek = \Yii::$app->db->createCommand($sel)->queryAll();
            if ($acek != null) {
                $del = 'TRUNCATE TABLE `dipa`';
                \Yii::$app->db->createCommand($del)->execute();
                $del1 = 'TRUNCATE TABLE `dipabulanan`';
                \Yii::$app->db->createCommand($del1)->execute();
                $updt = 'UPDATE `diparealisasi` SET `keterangan`= 0 WHERE 1';
                \Yii::$app->db->createCommand($updt)->execute();
            }
            $model1->file = UploadedFile::getInstance($model1, 'file');
            $model1->user_id = Yii::$app->user->id;
            $model1->tahun = date("Y");
            if (Yii::$app->request->post()) {
                $model1->file = \yii\web\UploadedFile::getInstance($model1, 'file');
                if ($model1->file && $model1->validate()) {
                    $inputFileType = \PHPExcel_IOFactory::identify($model1->file->tempName);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($model1->file->tempName);
                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $sheet = $objPHPExcel->getSheet(0);
                    $baris = $sheet->getHighestRow();
                    $kolom = $sheet->getHighestColumn();
//                    $baseRow = 2;
//                    $baris = 1;
//                    while (!empty($sheetData[$baseRow]['B'])) {
                    $tmp = array();
//                    $n = array();
                    $lastkode9 = '';
                    $lastkode8 = '';
                    $lastkode6 = '';
                    $lastkode4 = '';
                    $lastkode3 = '';
                    $lastkode1 = '';
                    $k = 1;
                    $msg = '';
                    foreach ($sheetData as $key => $row) {
                        if ($key == 1)
                            continue;
                        $kode = trim($row['A']);
                        $satuan = strtolower(trim($row['D']));
                        $nkode = strlen($kode);
                        switch ($nkode) {
                            case "9":
                                $program = new Dipa;
                                $program->kode = $row['A'];
                                $program->program = $kode;
                                $program->kegiatan = null;
                                $program->output = null;
                                $program->komponen = null;
                                $program->subkomp = null;
                                $program->akun = null;
                                $program->baris = $key;
                                $program->uraian = $row['B'];
                                $program->vol = $row['C'];
                                $program->sat = $row['D'];
                                $program->hargasat = $row['E'];
                                $program->jumlah = $row['F'];
                                $program->sisa = $row['F'];
                                $program->dipamaster_id = $key;
                                $program->save();

                                $tmp[$kode]['kode'] = $kode . '-0000-00000000-000-0-000000-0';
                                $tmp[$kode]['uraian'] = $this->clean($row['B']);
                                $tmp[$kode]['vol'] = $row['C'];
                                $tmp[$kode]['satuan'] = $row['D'];
                                $tmp[$kode]['hrgsatuan'] = $row['E'];
                                $tmp[$kode]['jumlah'] = $row['F'];
                                $tmp[$kode]['kdblokir'] = $row['G'];
                                $tmp[$kode]['sdana'] = $row['H'];
                                if ($lastkode9 !== $kode)
                                    $lastkode9 = $kode;
                                $k = 1;
                                break;
                            case "4":
                                $kegiatan = new Dipa;
                                $kegiatan->kode = $row['A'];
                                $kegiatan->program = $lastkode9;
                                $kegiatan->kegiatan = $kode;
                                $kegiatan->output = null;
                                $kegiatan->komponen = null;
                                $kegiatan->subkomp = null;
                                $kegiatan->akun = null;
                                $kegiatan->baris = $key;
                                $kegiatan->uraian = $row['B'];
                                $kegiatan->vol = $row['C'];
                                $kegiatan->sat = $row['D'];
                                $kegiatan->hargasat = $row['E'];
                                $kegiatan->jumlah = $row['F'];
                                $kegiatan->sisa = $row['F'];
                                $kegiatan->dipamaster_id = $key;
                                $kegiatan->save();
                                $tmp[$lastkode9][$kode]['kode'] = $lastkode9 . '-' . $kode . '-00000000-000-0-000000-0';
                                $tmp[$lastkode9][$kode]['uraian'] = $this->clean($row['B']);
                                $tmp[$lastkode9][$kode]['vol'] = $row['C'];
                                $tmp[$lastkode9][$kode]['satuan'] = $row['D'];
                                $tmp[$lastkode9][$kode]['hrgsatuan'] = $row['E'];
                                $tmp[$lastkode9][$kode]['jumlah'] = $row['F'];
                                $tmp[$lastkode9][$kode]['kdblokir'] = $row['G'];
                                $tmp[$lastkode9][$kode]['sdana'] = $row['H'];
                                if ($lastkode4 !== $kode)
                                    $lastkode4 = $kode;
                                $k = 1;
                                break;
                            case "8":
                                $output = new Dipa;
                                $output->kode = $row['A'];
                                $output->program = $lastkode9;
                                $output->kegiatan = $lastkode4;
                                $output->output = $kode;
                                $output->komponen = null;
                                $output->subkomp = null;
                                $output->akun = null;
                                $output->baris = $key;
                                $output->uraian = $row['B'];
                                $output->vol = $row['C'];
                                $output->sat = $row['D'];
                                $output->hargasat = $row['E'];
                                $output->jumlah = $row['F'];
                                $output->sisa = $row['F'];
                                $output->dipamaster_id = $key;
                                $output->save();
                                $tmp[$lastkode9][$lastkode4][$kode]['kode'] = $lastkode9 . '-' . $lastkode4 . '-' . $kode . '-000-0-000000-0';
                                $tmp[$lastkode9][$lastkode4][$kode]['vol'] = $row['C'];
                                $tmp[$lastkode9][$lastkode4][$kode]['satuan'] = $row['D'];
                                $tmp[$lastkode9][$lastkode4][$kode]['hrgsatuan'] = $row['E'];
                                $tmp[$lastkode9][$lastkode4][$kode]['jumlah'] = $row['F'];
                                $tmp[$lastkode9][$lastkode4][$kode]['kdblokir'] = $row['G'];
                                $tmp[$lastkode9][$lastkode4][$kode]['sdana'] = $row['H'];
                                if ($lastkode8 !== $kode)
                                    $lastkode8 = $kode;
                                $k = 1;
                                break;
                            case "3":
                                $komponen = new Dipa;
                                $komponen->kode = $row['A'];
                                $komponen->program = $lastkode9;
                                $komponen->kegiatan = $lastkode4;
                                $komponen->output = $lastkode8;
                                $komponen->komponen = $kode;
                                $komponen->subkomp = null;
                                $komponen->akun = null;
                                $komponen->baris = $key;
                                $komponen->uraian = $row['B'];
                                $komponen->vol = $row['C'];
                                $komponen->sat = $row['D'];
                                $komponen->hargasat = $row['E'];
                                $komponen->jumlah = $row['F'];
                                $komponen->sisa = $row['F'];
                                $komponen->dipamaster_id = $key;
                                $komponen->save();
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['kode'] = $lastkode9 . '-' . $lastkode4 . '-' . $lastkode8 . '-' . $kode . '-0-000000-0';
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['uraian'] = $this->clean($row['B']);
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['vol'] = $row['C'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['satuan'] = $row['D'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['hrgsatuan'] = $row['E'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['jumlah'] = $row['F'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['kdblokir'] = $row['G'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$kode]['sdana'] = $row['H'];
                                if ($lastkode3 !== $kode) {
                                    $lastkode3 = $kode;
                                    $lastkode1 = '0';
                                }
                                $k = 1;
                                break;
                            case "1":
                                $subkomp = new Dipa;
                                $subkomp->kode = $row['A'];
                                $subkomp->program = $lastkode9;
                                $subkomp->kegiatan = $lastkode4;
                                $subkomp->output = $lastkode8;
                                $subkomp->komponen = $lastkode3;
                                $subkomp->subkomp = $kode;
                                $subkomp->akun = null;
                                $subkomp->baris = $key;
                                $subkomp->uraian = $row['B'];
                                $subkomp->vol = $row['C'];
                                $subkomp->sat = $row['D'];
                                $subkomp->hargasat = $row['E'];
                                $subkomp->jumlah = $row['F'];
                                $subkomp->sisa = $row['F'];
                                $subkomp->dipamaster_id = $key;
                                $subkomp->save();
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['kode'] = $lastkode9 . '-' . $lastkode4 . '-' . $lastkode8 . '-' . $lastkode3 . '-' . $kode . '-000000-0';
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['uraian'] = $this->clean($row['B']);
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['vol'] = $row['C'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['satuan'] = $row['D'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['hrgsatuan'] = $row['E'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['jumlah'] = $row['F'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['kdblokir'] = $row['G'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$kode]['sdana'] = $row['H'];
                                if ($lastkode1 !== $kode)
                                    $lastkode1 = $kode;
                                $k = 1;
                                break;
                            case "6":
                                $akun = new Dipa;
                                $akun->kode = $row['A'];
                                $akun->program = $lastkode9;
                                $akun->kegiatan = $lastkode4;
                                $akun->output = $lastkode8;
                                $akun->komponen = $lastkode3;
                                $akun->subkomp = $lastkode1;
                                $akun->akun = $kode;
                                $akun->baris = $key;
                                $akun->uraian = $row['B'];
                                $akun->vol = $row['C'];
                                $akun->sat = $row['D'];
                                $akun->hargasat = $row['E'];
                                $akun->jumlah = $row['F'];
                                $akun->sisa = $row['F'];
                                $akun->dipamaster_id = $key;
                                $akun->save();

                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['kode'] = $lastkode9 . '-' . $lastkode4 . '-' . $lastkode8 . '-' . $lastkode3 . '-' . $lastkode1 . '-' . $kode . '-0';
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['uraian'] = $this->clean($row['B']);
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['vol'] = $row['C'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['satuan'] = $row['D'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['hrgsatuan'] = $row['E'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['jumlah'] = $row['F'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['kdblokir'] = $row['G'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$kode]['sdana'] = $row['H'];
                                if ($lastkode6 !== $kode)
                                    $lastkode6 = $kode;
                                $k = 1;
                                break;
                            default:
                                $detil = new Dipa;
                                $detil->kode = $row['A'];
                                $detil->program = $lastkode9;
                                $detil->kegiatan = $lastkode4;
                                $detil->output = $lastkode8;
                                $detil->komponen = $lastkode3;
                                $detil->subkomp = $lastkode1;
                                $detil->akun = $lastkode6;
                                $detil->baris = $key;
                                $detil->uraian = $row['B'];
                                $detil->vol = $row['C'];
                                $detil->sat = $row['D'];
                                $detil->hargasat = $row['E'];
                                $detil->jumlah = $row['F'];
                                $detil->sisa = $row['F'];
                                $detil->dipamaster_id = $key;
                                $detil->save();
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['kode'] = $lastkode9 . '-' . $lastkode4 . '-' . $lastkode8 . '-' . $lastkode3 . '-' . $lastkode1 . '-' . $lastkode6 . '-' . $k;
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['uraian'] = $this->clean($row['B']);
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['vol'] = $row['C'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['satuan'] = $row['D'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['hrgsatuan'] = $row['E'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['jumlah'] = $row['F'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['kdblokir'] = $row['G'];
                                $tmp[$lastkode9][$lastkode4][$lastkode8][$lastkode3][$lastkode1][$lastkode6][$k]['sdana'] = $row['H'];
                                $k++;
                        }
                    }
                    $sql = 'INSERT INTO dipabulanan (dipa_id,kode,program,kegiatan,output,komponen,subkomp,akun, vol, sat, uraian) SELECT id,kode,program,kegiatan,output,komponen,subkomp,akun, vol, sat, uraian FROM dipa;';
                    \Yii::$app->db->createCommand($sql)->execute();
                    Yii::$app->getSession()->setFlash('success', 'Success');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Error');
                }
            }

            $model1->save(false);
            if ($model1->file) {
                $uploadPath = "uploads/";
                $succesSave = $model1->file->saveAs($uploadPath . $model1->file);
            }
            Yii::$app->session->setFlash('success', 'Upload Sukses');
        }
        return $this->render('create', [
                    'model' => $model, 'model1' => $model1,
        ]);
    }

    public function clean($string) {
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
        $string = trim($string);
        return preg_replace('/[^0-9a-zA-Z_\s]/', '', $string); // Removes special chars.
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Dipa::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
