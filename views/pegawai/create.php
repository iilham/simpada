<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = 'Tambah Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-create">

  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">Input Data Pegawai</h3>
    </div>
    <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>
<?php
$this->registerJs(
  '
  $("document").ready(function(){
    $("input#signupform-username").val(" ");    
  });
  '
);
?>
