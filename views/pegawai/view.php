<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = 'Data Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-view">
    <div class="box box-solid box-info">
      <div class="box-header">
        <h3 class="box-title"><?= $model->nama ?></h3>
      </div>
      <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nip:ntext',
            [
              'attribute' => 'Jabatan',
              'value' => $model->idJabatan->jabatan,
            ],
            [
              'attribute' => 'Pangkat / Golongan',
              'value' => $model->pangkat .' ('.$model->golongan.')',
            ],
            [
              'attribute' => 'Motor Dinas',
              'value' => $model->is_motordinas == 1 ? 'Memiliki' : 'Tidak Memiliki',
            ],
        ],
    ]) ?>
    <br>
    <p style="float:right">
        <?php
        if(Yii::$app->user->id==1||$model->id === Yii::$app->user->id||Yii::$app->user->identity->id_jabatan =='3'||Yii::$app->user->identity->id_jabatan =='21')
        {
          echo Html::a('Ubah Data', ['update', 'id' => $model->id], ['class' => 'btn btn-info']);
        }
        ?>
        <?php
        if(Yii::$app->user->id==1||Yii::$app->user->identity->id_jabatan =='3'||Yii::$app->user->identity->id_jabatan =='21')
        {
            echo Html::a('Hapus Pegawai', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Apakah anda yakin akan menghapus data '.$model->nama,
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>
  </div>
  </div>
</div>
