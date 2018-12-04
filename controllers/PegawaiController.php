<?php

namespace app\controllers;

use Yii;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'search', 'create', 'update', 'delete', 'listrekap'],
                'rules' => [
                        [
                        'allow' => true,
                        'actions' => ['index', 'view', 'search', 'listrekap'],
                        'roles' => ['@'],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['update'],
                        'matchCallback' => function() {
                            $user = Yii::$app->user->identity;
                            return
                                    (
                                    (Yii::$app->myHelper->pegawaiById(Yii::$app->request->get('id'))->id == $user->id) ||
                                    $user->id_jabatan == '1' ||
                                    //kasubag dan staf TU boleh edituser
                                    $user->id_jabatan == '3' ||
                                    $user->id_jabatan == '21'
                                    );
                        }
                    ],
                        [
                        'allow' => true,
                        'actions' => ['delete'],
                        'matchCallback' => function() {
                            $id_jabatan = Yii::$app->user->identity->id_jabatan;
                            return
                                    (
                                    $id_jabatan == '1' ||
                                    //kasubag dan staf TU boleh deleteuser
                                    $id_jabatan == '3' ||
                                    $id_jabatan == '21'
                                    );
                        }
                    ],
                        [
                        'allow' => true,
                        'actions' => ['create'],
                        'matchCallback' => function() {
                            $id_jabatan = Yii::$app->user->identity->id_jabatan;
                            return
                                    (
                                    $id_jabatan == '1' ||
                                    //kasubag dan staf TU boleh deleteuser
                                    $id_jabatan == '3' ||
                                    $id_jabatan == '21'
                                    );
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('pegawai.id!=\'1\'');
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'cari' => '',
        ]);
    }

    public function actionSearchpegawai($cari) {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('
      nip like "%' . $cari . '%"
      or nama like "%' . $cari . '%"
      or jabatan.jabatan like "%' . $cari . '%"
      or pangkat like "%' . $cari . '%"
      ');
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'cari' => $cari,
        ]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    public function actionCreate() {
        $model = new \app\models\SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $getmodel = $this->findModel($id);
        $model = new \app\models\SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->edituser($id)) {
                return $this->goHome();
            }
        }
        $model->id = $id;
        $model->username = $getmodel->username;
        $model->nip = $getmodel->nip;
        $model->nip_lama = $getmodel->nip_lama;
        $model->password = '';
        $model->nama = $getmodel->nama;
        $model->id_jabatan = $getmodel->id_jabatan;
        $model->pangkat = $getmodel->pangkat;
        $model->golongan = $getmodel->golongan;
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionListrekap() {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('pegawai.id!=\'1\'');
        return $this->render('listrekap', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionLihatrekapabsen() {
        $request = Yii::$app->request;
        $id = $request->get('id_pegawai');
        $date_start = $request->get('date_start');
        $date_end = $request->get('date_end');
        $ispdf = $request->get('ispdf');
        return Yii::$app->runAction(
                        'tugas/rekapcustomdate', [
                    'id_pegawai' => $id,
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                    'autoclickprintpdf' => $ispdf
                        ]
        );
    }

    protected function findModel($id) {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
