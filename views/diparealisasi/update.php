<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diparealisasi */

$this->title = 'Update Diparealisasi: ' . $model->uraian;
$this->params['breadcrumbs'][] = ['label' => 'Diparealisasis', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diparealisasi-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?=
//    print_r($dataProvider);
//    die();
    $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
    ])
    ?>

</div>
