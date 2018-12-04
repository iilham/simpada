<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DipaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Dipa';
$this->params['breadcrumbs'][] = $this->title;
$model = new app\models\DipaMaster;
?>

<h2>Silahkan upload file DIPA di sini!</h2>
<br>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<br>

<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>


<!-- <button>Submit</button>
 -->
<?php ActiveForm::end() ?>
	
