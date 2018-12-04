<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = 'Ubah Data Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="pegawai-update">
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title"><?= $model->nama ?></h3>
    </div>
    <div class="box-body">
      <?= $this->render('_form', [
        'model' => $model,
        ]) ?>
    </div>
  </div>
</div>
