<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = '';
?>
<div class="config-update">
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">Ubah Konfigurasi</h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  </div>
  </div>

</div>
