<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dipa */

$this->title = 'Create Dipa';
$this->params['breadcrumbs'][] = ['label' => 'Dipas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dipa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
