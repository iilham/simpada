<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = 'Current Configuration';
$this->params['breadcrumbs'][] = ['label' => 'Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-view">

  <div class="box box-solid box-primary">
    <div class="box-header">
    </div>
    <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'satker:ntext',
            'alamat:ntext',
            'alamatlengkap:ntext',
        ],
    ]) ?>
  </div>
  </div>
</div>
