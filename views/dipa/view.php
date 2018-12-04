<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dipa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dipas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dipa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'baris',
            'kode',
            'program',
            'kegiatan',
            'output',
            'suboutput',
            'komponen',
            'subkomp',
            'uraian',
            'vol',
            'sat',
            'hargasat',
            'jumlah',
            'dipamaster_id',
        ],
    ]) ?>

</div>
