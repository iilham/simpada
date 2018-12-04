<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatan */

$this->title = $model->jabatan;
$this->params['breadcrumbs'][] = ['label' => 'Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-view">
    <div class="box box-solid box-info">
      <div class="box-header">
        <h3 class="box-title">Jabatan</h3>
      </div>
      <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                  'attribute'=>'Jabatan',
                  'value'=>$model->jabatan,
                ],[
                  'attribute'=>'Kode Seksi',
                  'value'=>$model->kode_seksi,
                ]
            ],
        ]) ?>
        <br>
        <p>
            <?= Html::a('<span class="fa fa-pencil"></span> Ubah Detail', ['update', 'id' => $model->id_jabatan], ['class' => 'btn btn-info']) ?>
            <?= Html::a('<span class="fa fa-trash"></span> Hapus', ['delete', 'id' => $model->id_jabatan], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Apakah anda yakin akan menghapus tugas ini?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

      </div>
  </div>
</div>
