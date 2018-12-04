<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Diparealisasi */

$this->title = 'Create Diparealisasi';
$this->params['breadcrumbs'][] = ['label' => 'Diparealisasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diparealisasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
