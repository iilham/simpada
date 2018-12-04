<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pegawai-index">
  <div class="box box-solid box-primary">
    <div class="box-header with-border">
      <h4 class="box-title">Cari <?= $cari?></h4>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-lg-11">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Kata Kunci" id="inputcari" value="<?=$cari?>">
            <span class="input-group-btn">
              <?= Html::a('Cari', ['/pegawai/searchpegawai'],
              [
                'id'=>'buttoncari',
                'class'=>'btn btn-success',
                'data-method'=>'GET',
                'data-params'=>[
                  'cari'=>$cari,
                ],
              ]) ?>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-1">
          <?= Html::a('Clear', ['/pegawai/index'], ['class'=>'btn btn-warning']) ?>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
  </div>
  <?php
    $tekscari='';
    if(strlen($cari)>0){$tekscari="Hasil Pencarian Untuk Kata Kunci ".$cari;}
  ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_SUCCESS,
            'heading'=>'<i class="glyphicon glyphicon-book"></i>  '.$tekscari
        ],
        'toolbar' => [''],
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'default'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nip:ntext',
            [
              'label'=>'Pegawai',
              'format'=>'raw',
              'attribute' => 'nama',
              'value' => function($dataProvider){
                return Html::a($dataProvider->nama, ['view', 'id' => $dataProvider->id]);
              }
            ],
            [
              'attribute' => 'jabatan',
              'value' => 'idJabatan.jabatan'
            ],
            'pangkat:ntext',
            'golongan:ntext',
            ['class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                  'view' => function ($model, $key, $index) {
                      return false;
                   },
                  'update' => function ($model, $key, $index) {
                    if(Yii::$app->user->id!=1)
                    {
                      return ($model->id === Yii::$app->user->id||Yii::$app->user->identity->id_jabatan =='3'||Yii::$app->user->identity->id_jabatan =='21') ? true : false;
                    }
                    else {
                      return true;
                    }
                  },
                  'delete' => function ($model, $key, $index) {
                    if(Yii::$app->user->id!=1)
                    {
                      return (Yii::$app->user->identity->id_jabatan =='3'||Yii::$app->user->identity->id_jabatan =='21') ? true : false;
                    }
                    else {
                      return true;
                    }
                  },
              ]
          ],
        ],
    ]); ?>
</div>
<?php
$this->registerJs('
$("#inputcari").on("input",function(e){
  if($(this).data("lastval")!= $(this).val()){
    $(this).data("lastval",$(this).val());
    //change action
    $("#buttoncari").attr("data-params","{\"cari\":\""+$(this).val()+"\"}");
  };
});
$("#inputcari").keypress(function (e) {
 var key = e.which;
 if(key == 13)
  {
    $("#buttoncari").click();
    return false;
  }
});
'
)
?>
